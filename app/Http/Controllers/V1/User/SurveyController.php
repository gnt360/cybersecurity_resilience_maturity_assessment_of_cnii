<?php

namespace App\Http\Controllers\V1\User;

use App\Models\User;
use App\Models\CniirIndex;
use Illuminate\Http\Request;
use App\Models\ResilienceControl;
use App\Models\ResilienceMeasure;
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

        $user_id =  Auth::id();
        if($request->user_id == null){
            $this->errorResponse( "User Id is required", 'Validation errors', Response::HTTP_BAD_REQUEST);
        }

        $count = count($questions_ids);


        DB::beginTransaction();

            for ($i=0; $i < $count; $i++) {
                $response = new ResilienceMeasureResponse();
                $response->rm_id = $questions_ids[$i];
                $response->rms_id = $responses_array[$questions_ids[$i]];
                $response->user_id = $user_id;
                $response->save();
            }

        DB::commit();

        return $this->successResponse(null, 'Responses added successfully', Response::HTTP_CREATED);
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

}
