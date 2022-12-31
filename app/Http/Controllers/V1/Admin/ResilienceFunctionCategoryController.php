<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceFunctionCategory;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreResilienceFunctionCategoryRequest;
use App\Http\Resources\V1\ResilienceFunctionCategoryResource;
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
        return $this->successResponse(ResilienceFunctionCategoryResource::collection(ResilienceFunctionCategory::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceFunctionCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceFunctionCategoryRequest $request)
    {
        $resilienceFunctionCategory = ResilienceFunctionCategory::create($request->all());

        return $this->successResponse(new ResilienceFunctionCategoryResource($resilienceFunctionCategory), 'Resilience function category added successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceFunctionCategory  $resilienceFunctionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceFunctionCategory $resilienceFunctionCategory)
    {
        return $this->successResponse(new ResilienceFunctionCategoryResource($resilienceFunctionCategory));
    }

    public function getRFCbyRFid(int $rfId)
    {
        if($rfId < 0){
            return $this->errorResponse(null, 'Please enter a valid Resilience Function Id', Response::HTTP_BAD_REQUEST);
        }

        $resilienceFunctionCategory = ResilienceFunctionCategory::where('rf_id', $rfId)->get();
        return $this->successResponse(ResilienceFunctionCategoryResource::collection($resilienceFunctionCategory));
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
        $resilienceFunctionCategory->update($request->all());

        return $this->successResponse(new ResilienceFunctionCategoryResource($resilienceFunctionCategory), 'Resilience function category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceFunctionCategory  $resilienceFunctionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceFunctionCategory $resilienceFunctionCategory)
    {
        $resilienceFunctionCategory->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
