<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\Quadrant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuadrantRequest;
use App\Http\Resources\V1\QuadrantResource;
use App\Http\Requests\UpdateQuadrantRequest;
use Symfony\Component\HttpFoundation\Response;

class QuadrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(QuadrantResource::collection(Quadrant::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuadrantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuadrantRequest $request)
    {
        $quadrant = Quadrant::create($request->all());

        return $this->successResponse(new QuadrantResource($quadrant), 'Quadrant added successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quadrant  $quadrant
     * @return \Illuminate\Http\Response
     */
    public function show(Quadrant $quadrant)
    {
        return $this->successResponse( new QuadrantResource($quadrant));
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
        $quadrant->update($request->all());

        return $this->successResponse(new QuadrantResource($quadrant), 'Quadrant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quadrant  $quadrant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quadrant $quadrant)
    {
        $quadrant->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
