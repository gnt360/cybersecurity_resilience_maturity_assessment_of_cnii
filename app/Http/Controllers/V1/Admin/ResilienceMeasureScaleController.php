<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceMeasureScale;
use App\Http\Requests\StoreResilienceMeasureScaleRequest;
use App\Http\Requests\UpdateResilienceMeasureScaleRequest;

class ResilienceMeasureScaleController extends Controller
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
     * @param  \App\Http\Requests\StoreResilienceMeasureScaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceMeasureScaleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceMeasureScale  $resilienceMeasureScale
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceMeasureScale $resilienceMeasureScale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceMeasureScaleRequest  $request
     * @param  \App\Models\ResilienceMeasureScale  $resilienceMeasureScale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceMeasureScaleRequest $request, ResilienceMeasureScale $resilienceMeasureScale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceMeasureScale  $resilienceMeasureScale
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceMeasureScale $resilienceMeasureScale)
    {
        //
    }
}
