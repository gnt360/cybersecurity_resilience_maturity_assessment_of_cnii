<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceTemporalDimension;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreResilienceTemporalDimensionRequest;
use App\Http\Resources\V1\ResilienceTemporalDimensionResource;
use App\Http\Requests\UpdateResilienceTemporalDimensionRequest;

class ResilienceTemporalDimensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(ResilienceTemporalDimensionResource::collection(ResilienceTemporalDimension::paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceTemporalDimensionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceTemporalDimensionRequest $request)
    {
        $rtd = ResilienceTemporalDimension::create($request->all());

        return $this->successResponse(new ResilienceTemporalDimensionResource($rtd), 'Resilience temporal dimension added successfully',  Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceTemporalDimension  $resilienceTemporalDimension
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceTemporalDimension $resilienceTemporalDimension)
    {
        return $this->successResponse( new ResilienceTemporalDimensionResource($resilienceTemporalDimension));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceTemporalDimensionRequest  $request
     * @param  \App\Models\ResilienceTemporalDimension  $resilienceTemporalDimension
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceTemporalDimensionRequest $request, ResilienceTemporalDimension $resilienceTemporalDimension)
    {
        $resilienceTemporalDimension->update($request->all());

        return $this->successResponse(new ResilienceTemporalDimensionResource($resilienceTemporalDimension), 'Resilience temporal dimension updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceTemporalDimension  $resilienceTemporalDimension
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceTemporalDimension $resilienceTemporalDimension)
    {
        $resilienceTemporalDimension->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
