<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\CniirIndex;
use App\Http\Requests\StoreCniirIndexRequest;
use App\Http\Requests\UpdateCniirIndexRequest;

class CniirIndexController extends Controller
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
     * @param  \App\Http\Requests\StoreCniirIndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCniirIndexRequest $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCniirIndexRequest  $request
     * @param  \App\Models\CniirIndex  $cniirIndex
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCniirIndexRequest $request, CniirIndex $cniirIndex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CniirIndex  $cniirIndex
     * @return \Illuminate\Http\Response
     */
    public function destroy(CniirIndex $cniirIndex)
    {
        //
    }
}
