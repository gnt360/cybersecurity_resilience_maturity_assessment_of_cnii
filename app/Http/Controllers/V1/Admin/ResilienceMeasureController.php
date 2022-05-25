<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\ResilienceMeasure;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreResilienceMeasureRequest;
use App\Http\Resources\V1\ResilienceMeasureResource;
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
      return $this->successResponse(ResilienceMeasureResource::collection(ResilienceMeasure::paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceMeasureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceMeasureRequest $request)
    {
        $resilienceMeasure = ResilienceMeasure::create($request->all());

        return $this->successResponse(new ResilienceMeasureResource($resilienceMeasure), 'Resilience measure added successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceMeasure  $resilienceMeasure
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceMeasure $resilienceMeasure)
    {
        return $this->successResponse(new ResilienceMeasureResource($resilienceMeasure));
    }

    public function getRMbyRCid(int $rcId)
    {
        if($rcId < 0){
            return $this->errorResponse(null, 'Please enter a valid Resilience Control Id', Response::HTTP_BAD_REQUEST);
        }

        $resilienceMeasure = ResilienceMeasure::where('rc_id', $rcId)->get();
        return $this->successResponse(ResilienceMeasureResource::collection($resilienceMeasure));
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
        $resilienceMeasure->update($request->all());

        return $this->successResponse(new ResilienceMeasureResource($resilienceMeasure), 'Resilience measure updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceMeasure  $resilienceMeasure
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceMeasure $resilienceMeasure)
    {
        $resilienceMeasure->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
