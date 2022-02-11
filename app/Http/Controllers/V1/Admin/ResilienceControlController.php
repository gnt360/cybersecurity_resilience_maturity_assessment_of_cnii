<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceControl;
use App\Http\Requests\StoreResilienceControlRequest;
use App\Http\Requests\UpdateResilienceControlRequest;

class ResilienceControlController extends Controller
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
     * @param  \App\Http\Requests\StoreResilienceControlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceControlRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceControl  $resilienceControl
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceControl $resilienceControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceControlRequest  $request
     * @param  \App\Models\ResilienceControl  $resilienceControl
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceControlRequest $request, ResilienceControl $resilienceControl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceControl  $resilienceControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceControl $resilienceControl)
    {
        //
    }
}
