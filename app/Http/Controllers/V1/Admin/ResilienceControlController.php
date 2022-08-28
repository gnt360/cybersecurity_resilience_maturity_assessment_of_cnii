<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\ResilienceControl;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreResilienceControlRequest;
use App\Http\Resources\V1\ResilienceControlResource;
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
        return $this->successResponse(ResilienceControlResource::collection(ResilienceControl::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceControlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceControlRequest $request)
    {
        $resilienceControl = ResilienceControl::create($request->all());

        return $this->successResponse(new ResilienceControlResource($resilienceControl), 'Resilience control added successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceControl  $resilienceControl
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceControl $resilienceControl)
    {
        return $this->successResponse(new ResilienceControlResource($resilienceControl));
    }

    public function getRCbyRFCid(int $rfcId)
    {
        if($rfcId < 0){
            return $this->errorResponse(null, 'Please enter a valid Resilience Function Category Id', Response::HTTP_BAD_REQUEST);
        }

        $resilienceControl = ResilienceControl::where('rfc_id', $rfcId)->get();
        return $this->successResponse(ResilienceControlResource::collection($resilienceControl));
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
        $resilienceControl->update($request->all());

        return $this->successResponse(new ResilienceControlResource($resilienceControl), 'Resilience control updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceControl  $resilienceControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceControl $resilienceControl)
    {
        $resilienceControl->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
