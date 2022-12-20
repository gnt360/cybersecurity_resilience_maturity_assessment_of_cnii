<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\User;
use App\Models\CniirIndex;
use App\Helpers\Computation;
use App\Http\Requests\Request;
use App\Helpers\CniirIndexService;
use App\Http\Controllers\Controller;
use App\Models\ResilienceTemporalDimension;
use App\Http\Resources\V1\CniirIndexResource;
use Symfony\Component\HttpFoundation\Response;

class CniirIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(CniirIndexResource::collection(CniirIndex::all()));
    }

    public function getConsolidatedIndex(){

        $data = CniirIndexService::consolidateIndex();

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CniirIndex  $cniirIndex
     * @return \Illuminate\Http\Response
     */
    public function show(CniirIndex $cniirIndex)
    {
        //
    }


    public function cniirIndexComputation($user_id)
    {
        if($user_id == null || $user_id <= 0){
            return $this->errorResponse(null, 'Please provide a valid user id', Response::HTTP_BAD_REQUEST);
        }

        $user = User::find($user_id);
        if(!$user){
            return $this->errorResponse(null, 'User not found', Response::HTTP_BAD_REQUEST);
        }

        if(!CniirIndexService::checkIfUserHasCompletedSurvey($user_id)){
            return $this->errorResponse(null, 'No survey responses available for computation of cniir index', Response::HTTP_BAD_REQUEST);
        }

        $score = Computation::calculateCNIIRIndex($user_id);

        if($score == 0){
            return $this->errorResponse(null, 'No survey taken for computation of cniir index', Response::HTTP_BAD_REQUEST);
        }


        $quadrant_id = CniirIndexService::getQuadrantFromScore($score);

        $data = CniirIndexService::saveCniirIndex($user->org_id, $quadrant_id,  $user_id, $score);

        return $this->successResponse(new CniirIndexResource($data), 'CNIIR Index computed successfully', Response::HTTP_OK);
    }





}
