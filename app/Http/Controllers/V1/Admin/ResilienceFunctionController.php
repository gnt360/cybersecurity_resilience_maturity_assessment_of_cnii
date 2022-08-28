<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\ResilienceFunction;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreResilienceFunctionRequest;
use App\Http\Resources\V1\ResilienceFunctionResource;
use App\Http\Requests\UpdateResilienceFunctionRequest;

class ResilienceFunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(ResilienceFunctionResource::collection(ResilienceFunction::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceFunctionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceFunctionRequest $request)
    {
        $resilienceFunction = ResilienceFunction::create($request->all());

        return $this->successResponse(new ResilienceFunctionResource($resilienceFunction), 'Resilience function added successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceFunction  $resilienceFunction
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceFunction $resilienceFunction)
    {
        return $this->successResponse(new ResilienceFunctionResource($resilienceFunction));
    }

    public function getRFbyRTDid(int $rtdId)
    {

        if($rtdId < 0){
            return $this->errorResponse(null, 'Please enter a valid Resilience Measure Id', Response::HTTP_BAD_REQUEST);
        }

        $resilienceFunction = ResilienceFunction::where('rtd_id', $rtdId)->get();
        return $this->successResponse(ResilienceFunctionResource::collection($resilienceFunction));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceFunctionRequest  $request
     * @param  \App\Models\ResilienceFunction  $resilienceFunction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceFunctionRequest $request, ResilienceFunction $resilienceFunction)
    {
        $resilienceFunction->update($request->all());

        return $this->successResponse(new ResilienceFunctionResource($resilienceFunction), 'Resilience function updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceFunction  $resilienceFunction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceFunction $resilienceFunction)
    {
        $resilienceFunction->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
