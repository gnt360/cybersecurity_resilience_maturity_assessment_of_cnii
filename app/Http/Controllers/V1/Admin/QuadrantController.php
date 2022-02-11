<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quadrant;
use App\Http\Requests\StoreQuadrantRequest;
use App\Http\Requests\UpdateQuadrantRequest;

class QuadrantController extends Controller
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
     * @param  \App\Http\Requests\StoreQuadrantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuadrantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quadrant  $quadrant
     * @return \Illuminate\Http\Response
     */
    public function show(Quadrant $quadrant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuadrantRequest  $request
     * @param  \App\Models\Quadrant  $quadrant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuadrantRequest $request, Quadrant $quadrant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quadrant  $quadrant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quadrant $quadrant)
    {
        //
    }
}
