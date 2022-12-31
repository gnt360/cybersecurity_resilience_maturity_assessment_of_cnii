<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\Sector;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectorRequest;
use App\Http\Resources\V1\SectorResourse;
use App\Http\Requests\UpdateSectorRequest;
use Symfony\Component\HttpFoundation\Response;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse(SectorResourse::collection(Sector::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSectorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectorRequest $request)
    {
        $sector = Sector::create($request->all());

        return $this->successResponse(new SectorResourse($sector), 'Sector added successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        return $this->successResponse( new SectorResourse($sector));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectorRequest  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        $sector->update($request->all());

        return $this->successResponse(new SectorResourse($sector), 'Sector updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        $sector->delete();

        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
