<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceMeasureResponse;
use App\Http\Requests\StoreResilienceMeasureResponseRequest;
use App\Http\Requests\UpdateResilienceMeasureResponseRequest;

class ResilienceMeasureResponseController extends Controller
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
     * @param  \App\Http\Requests\StoreResilienceMeasureResponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceMeasureResponseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceMeasureResponse  $resilienceMeasureResponse
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceMeasureResponse $resilienceMeasureResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceMeasureResponseRequest  $request
     * @param  \App\Models\ResilienceMeasureResponse  $resilienceMeasureResponse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceMeasureResponseRequest $request, ResilienceMeasureResponse $resilienceMeasureResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceMeasureResponse  $resilienceMeasureResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceMeasureResponse $resilienceMeasureResponse)
    {
        //
    }
}
