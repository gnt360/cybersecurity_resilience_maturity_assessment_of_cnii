<?php

namespace App\Http\Controllers\V1\Admin;

use App\Models\Organisation;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreOrganisationRequest;
use App\Http\Resources\V1\OrganisationResourse;
use App\Http\Requests\UpdateOrganisationRequest;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->successResponse(OrganisationResourse::collection(Organisation::paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrganisationRequest  $request
     * @return \Illuminate\Http\Response
     * OrganisationObserver is called everytime to generate a unique code for organisation
     */
    public function store(StoreOrganisationRequest $request)
    {
        $organisation = Organisation::create($request->all());

        return $this->successResponse(new OrganisationResourse($organisation), 'Organisation added successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function show(Organisation $organisation)
    {
        return $this->successResponse(new OrganisationResourse($organisation));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganisationRequest  $request
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrganisationRequest $request, Organisation $organisation)
    {
        $organisation->update($request->all());

        return $this->successResponse(new OrganisationResourse($organisation), 'Organisation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organisation $organisation)
    {
        $organisation->delete();

        return response('Deleted', 204);
    }
}
