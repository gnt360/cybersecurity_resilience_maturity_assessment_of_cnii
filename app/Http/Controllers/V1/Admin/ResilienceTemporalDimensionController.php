<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceTemporalDimension;
use App\Http\Requests\StoreResilienceTemporalDimensionRequest;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceTemporalDimensionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceTemporalDimensionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceTemporalDimension  $resilienceTemporalDimension
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceTemporalDimension $resilienceTemporalDimension)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceTemporalDimension  $resilienceTemporalDimension
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceTemporalDimension $resilienceTemporalDimension)
    {
        //
    }
}
