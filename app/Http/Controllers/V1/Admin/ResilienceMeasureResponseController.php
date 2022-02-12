<?php

namespace App\Http\Controllers\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResilienceMeasureResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreResilienceMeasureResponseRequest;
use App\Http\Resources\V1\ResilienceMeasureResponseResource;
use App\Http\Requests\UpdateResilienceMeasureResponseRequest;

class ResilienceMeasureResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(ResilienceMeasureResponseResource::collection(ResilienceMeasureResponse::paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResilienceMeasureResponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResilienceMeasureResponseRequest $request)
    {
        $resilienceMeasureResponse = ResilienceMeasureResponse::create($request->all());

        return $this->successResponse(new ResilienceMeasureResponseResource($resilienceMeasureResponse), 'Resilience measure response added successfully', Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResilienceMeasureResponse  $resilienceMeasureResponse
     * @return \Illuminate\Http\Response
     */
    public function show(ResilienceMeasureResponse $resilienceMeasureResponse)
    {
        return $this->successResponse(new ResilienceMeasureResponseResource($resilienceMeasureResponse));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResilienceMeasureResponseRequest  $request
     * @param  \App\Models\ResilienceMeasureResponse  $resilienceMeasureResponse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResilienceMeasureResponseRequest $request, ResilienceMeasureResponse $resilienceMeasureResponse)
    {
        $resilienceMeasureResponse->update($request->all());

        return $this->successResponse(new ResilienceMeasureResponseResource($resilienceMeasureResponse), 'Resilience measure response updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResilienceMeasureResponse  $resilienceMeasureResponse
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResilienceMeasureResponse $resilienceMeasureResponse)
    {
        $resilienceMeasureResponse->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
