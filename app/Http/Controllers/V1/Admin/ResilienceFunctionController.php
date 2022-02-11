<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceFunction;
use App\Http\Requests\StoreResilienceFunctionRequest;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceFunctionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceFunctionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceFunction  $resilienceFunction
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceFunction $resilienceFunction)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceFunction  $resilienceFunction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceFunction $resilienceFunction)
    {
        //
    }
}
