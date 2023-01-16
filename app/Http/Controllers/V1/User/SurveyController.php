<?php

namespace App\Http\Controllers\V1\User;

use App\Models\User;
use App\Models\CniirIndex;
use App\Helpers\Computation;
use Illuminate\Http\Request;
use App\Models\ResilienceControl;
use App\Models\ResilienceMeasure;
use App\Helpers\CniirIndexService;
use App\Models\ResilienceFunction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ResilienceMeasureResponse;
use App\Models\ResilienceFunctionCategory;
use App\Http\Resources\V1\CniirIndexResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\V1\Survey\ResilienceFunctionResource;

class SurveyController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\V1\SurveyResource
     */
    public function getMeasuresWithScales(int $rf_id = 0)
    {
        if($rf_id <= 0){

            $data = ResilienceFunction::with(['resilienceFunctionCategorys',
            'resilienceFunctionCategorys.resilienceControls',
            'resilienceFunctionCategorys.resilienceControls.resilienceMeasures',
            'resilienceFunctionCategorys.resilienceControls.resilienceMeasures.resilienceMeasureScales'])
            ->get();

        }else{
            $data = ResilienceFunction::where('id', $rf_id)
            ->with(['resilienceFunctionCategorys',
             'resilienceFunctionCategorys.resilienceControls',
             'resilienceFunctionCategorys.resilienceControls.resilienceMeasures',
             'resilienceFunctionCategorys.resilienceControls.resilienceMeasures.resilienceMeasureScales'])
             ->get();

        }

        return $this->successResponse(ResilienceFunctionResource::collection($data));
    }


    public function storeResponse(Request $request)
    {
        $responses_array = $request->input();

       $questions_ids = array_keys($responses_array);

        $user =  Auth::user();

        if($request->user_id == null){
            $this->errorResponse( "User Id is required", 'Validation errors', Response::HTTP_BAD_REQUEST);
        }

        $count = count($questions_ids);


        DB::beginTransaction();

            for ($i=0; $i < $count; $i++) {
                $response = new ResilienceMeasureResponse();
                $response->rm_id = $questions_ids[$i];
                $response->rms_id = $responses_array[$questions_ids[$i]];
                $response->user_id = $user->id;
                $response->org_id = $user->org_id;
                $response->save();
            }

        DB::commit();

        $result = self::cniirIndexComputation();

        //return $this->successResponse(null, 'Responses added successfully', Response::HTTP_CREATED);
        return $this->successResponse($result, 'CNIIR Index computed successfully', Response::HTTP_OK);
    }


    public function showCniirIndex()
    {
        $user_id =  Auth::id();
        $user = User::find($user_id);

        $data = CniirIndex::where('org_id', $user->org_id)->latest()->first();

        if($data){
            return $this->successResponse(new CniirIndexResource($data));
        }
        return $this->successResponse("No record found");
    }

    private static function cniirIndexComputation()
    {
        $user_id =  Auth::id();

        if($user_id == null || $user_id <= 0){
            return 'Please provide a valid user id';
        }


        $user = User::find($user_id);
        if(!$user){
            return 'User not found';
        }

        if(!CniirIndexService::checkIfUserHasCompletedSurvey($user_id)){
            return 'No survey responses available for computation of cniir index';
        }

        $pre_event_rtd_score = Computation::calculatePRTDI($user_id);
        $during_event_rtd_score = Computation::calculateDRTDI($user_id);
        $post_event_rtd_score = Computation::calculatePORTDI($user_id);

        $score = Computation::calculateCNIIRIndex($user_id, $pre_event_rtd_score, $during_event_rtd_score, $post_event_rtd_score);

        //temporarily approach
       $identify = Computation::calculateRFfn(12, $user_id);
       $protect = Computation::calculateRFfn(13, $user_id);
       $detect = Computation::calculateRFfn(14, $user_id);
       $respond = Computation::calculateRFfn(15, $user_id);
       $recover = Computation::calculateRFfn(16, $user_id);


        if($score == 0){
            return 'No survey taken for computation of cniir index';
        }


        $quadrant_id = CniirIndexService::getQuadrantFromScore($score);

        $data = CniirIndexService::saveCniirIndex($user->org_id, $quadrant_id, $user_id, $score,
        $pre_event_rtd_score, $during_event_rtd_score, $post_event_rtd_score,
        $identify, $protect, $detect, $respond, $recover
        );

        return new CniirIndexResource($data);
    }

}
