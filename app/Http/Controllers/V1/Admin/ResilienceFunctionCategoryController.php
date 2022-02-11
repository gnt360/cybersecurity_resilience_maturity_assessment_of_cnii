<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceFunctionCategory;
use App\Http\Requests\StoreResilienceFunctionCategoryRequest;
use App\Http\Requests\UpdateResilienceFunctionCategoryRequest;

class ResilienceFunctionCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreResilienceFunctionCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceFunctionCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceFunctionCategory  $resilienceFunctionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceFunctionCategory $resilienceFunctionCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceFunctionCategoryRequest  $request
     * @param  \App\Models\ResilienceFunctionCategory  $resilienceFunctionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceFunctionCategoryRequest $request, ResilienceFunctionCategory $resilienceFunctionCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceFunctionCategory  $resilienceFunctionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceFunctionCategory $resilienceFunctionCategory)
    {
        //
    }
}
