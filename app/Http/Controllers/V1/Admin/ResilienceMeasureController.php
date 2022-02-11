<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceMeasure;
use App\Http\Requests\StoreResilienceMeasureRequest;
use App\Http\Requests\UpdateResilienceMeasureRequest;

class ResilienceMeasureController extends Controller
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
     * @param  \App\Http\Requests\StoreResilienceMeasureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceMeasureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceMeasure  $resilienceMeasure
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceMeasure $resilienceMeasure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceMeasureRequest  $request
     * @param  \App\Models\ResilienceMeasure  $resilienceMeasure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceMeasureRequest $request, ResilienceMeasure $resilienceMeasure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceMeasure  $resilienceMeasure
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceMeasure $resilienceMeasure)
    {
        //
    }
}
