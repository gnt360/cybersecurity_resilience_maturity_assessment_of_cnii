<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceMeasureScale;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreResilienceMeasureScaleRequest;
use App\Http\Requests\UpdateResilienceMeasureScaleRequest;
use App\Http\Resources\V1\ResilienceMeasureScaleResource;

class ResilienceMeasureScaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(ResilienceMeasureScaleResource::collection(ResilienceMeasureScale::paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceMeasureScaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceMeasureScaleRequest $request)
    {
        $resilienceMeasureScale = ResilienceMeasureScale::create($request->all());

        return $this->successResponse(new ResilienceMeasureScaleResource($resilienceMeasureScale), 'Resilience measure scale added successfully', Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceMeasureScale  $resilienceMeasureScale
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceMeasureScale $resilienceMeasureScale)
    {
        return $this->successResponse(new ResilienceMeasureScaleResource($resilienceMeasureScale));
    }

    public function getRMSbyRMid(int $rmId)
    {
        if($rmId < 0){
            return $this->errorResponse(null, 'Please enter a valid Resilience Measure Id', Response::HTTP_BAD_REQUEST);
        }

        $resilienceMeasureScale = ResilienceMeasureScale::where('rm_id', $rmId)->get();
        return $this->successResponse(ResilienceMeasureScaleResource::collection($resilienceMeasureScale));
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
        $resilienceMeasureScale->update($request->all());

        return $this->successResponse(new ResilienceMeasureScaleResource($resilienceMeasureScale), 'Resilience measure scale updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceMeasureScale  $resilienceMeasureScale
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceMeasureScale $resilienceMeasureScale)
    {
        $resilienceMeasureScale->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
