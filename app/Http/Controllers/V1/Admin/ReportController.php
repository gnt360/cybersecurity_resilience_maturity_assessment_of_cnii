<?php

namespace App\Http\Controllers\V1\Admin;

use stdClass;
use App\Models\User;
use App\Models\Quadrant;
use App\Models\CniirIndex;
use App\Helpers\Computation;
use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ResilienceMeasureResponse;
use App\Models\ResilienceFunctionCategory;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    //all this method is not the best approache but because of time constraint it is woring for now
    public function identity()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 12)->pluck('name', 'id');//12 is the id of identity in rf table

        $response = collect();
        $collection_res = collect();

        foreach($rfcs as $key => $rfc){

            $res = Computation::rfcfnByOrg($key, $rfc);

            $collection_res->push($res);
        }

        for($i = 0; $i < count($collection_res[1]); $i++ ){

             $data = [
                'sector' => $collection_res[0][$i]['sector'],
                'organisation' => $collection_res[0][$i]['org'],
                'code' => strtoupper($collection_res[0][$i]['code']),
                'assets' => number_format((float)$collection_res[0][$i]['rfcfn'], 2, '.', ''),
                'governance' => number_format((float)$collection_res[1][$i]['rfcfn'], 2, '.', ''),
                'risk_management' => number_format((float)$collection_res[2][$i]['rfcfn'], 2, '.', ''),
                'business_environment' => number_format((float)$collection_res[3][$i]['rfcfn'], 2, '.', ''),
                'risk_management_strategy' => number_format((float)$collection_res[4][$i]['rfcfn'], 2, '.', '')
            ];

            $response->push($data);
        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }


    public function protect()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 13)->pluck('name', 'id');//13 is the id of protect in rf table

        $response = collect();
        $collection_res = collect();

        foreach($rfcs as $key => $rfc){

            $res = Computation::rfcfnByOrg($key, $rfc);

            $collection_res->push($res);
        }

        for($i = 0; $i < count($collection_res[1]); $i++ ){

            $data = [
                'sector' => $collection_res[0][$i]['sector'],
                'organisation' => $collection_res[0][$i]['org'],
                'code' => strtoupper($collection_res[0][$i]['code']),
                'maintenance' => number_format((float)$collection_res[0][$i]['rfcfn'], 2, '.', ''),
                'access_control' => number_format((float)$collection_res[1][$i]['rfcfn'], 2, '.', ''),
                'identity_management' => number_format((float)$collection_res[2][$i]['rfcfn'], 2, '.', ''),
                'awareness_and_training' => number_format((float)$collection_res[3][$i]['rfcfn'], 2, '.', ''),
                'protective_technology' => number_format((float)$collection_res[4][$i]['rfcfn'], 2, '.', '')
            ];

            $response->push($data);
        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }

    public function detect()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 14)->pluck('name', 'id');//14 is the id of detect in rf table

        $response = collect();
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){

            $res = Computation::rfcfnByOrg($key, $rfc);

            $collection_res->push($res);
        }

        for($i = 0; $i < count($collection_res[1]); $i++){

            $data = [
                'sector' => $collection_res[0][$i]['sector'],
                'organisation' => $collection_res[0][$i]['org'],
                'code' => strtoupper($collection_res[0][$i]['code']),
                'anomalies_and_events' => number_format((float)$collection_res[0][$i]['rfcfn'], 2, '.', ''),
                'monitoring' => number_format((float)$collection_res[1][$i]['rfcfn'], 2, '.', ''),
                'detection_process' => number_format((float)$collection_res[2][$i]['rfcfn'], 2, '.', '')
            ];

            $response->push($data);
        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }

    public function respond()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 15)->pluck('name', 'id');//15 is the id of respond in rf table

        $response = collect();
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){

            $res = Computation::rfcfnByOrg($key, $rfc);

            $collection_res->push($res);
        }

        for($i = 0; $i < count($collection_res[1]); $i++){

            $data = [
                'sector' => $collection_res[0][$i]['sector'],
                'organisation' => $collection_res[0][$i]['org'],
                'code' => strtoupper($collection_res[0][$i]['code']),
                'planning' => number_format((float)$collection_res[0][$i]['rfcfn'], 2, '.', ''),
                'analysis' => number_format((float)$collection_res[1][$i]['rfcfn'], 2, '.', ''),
                'mitigation' => number_format((float)$collection_res[2][$i]['rfcfn'], 2, '.', ''),
                'improvements' => number_format((float)$collection_res[3][$i]['rfcfn'], 2, '.', ''),
                'communication' => number_format((float)$collection_res[4][$i]['rfcfn'], 2, '.', '')
            ];

            $response->push($data);
        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }

    public function recover()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 16)->pluck('name', 'id');//16 is the id of recover in rf table

        $response = collect();
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){

            $res = Computation::rfcfnByOrg($key, $rfc);

            $collection_res->push($res);
        }

        for($i = 0; $i < count($collection_res[1]); $i++){

            $data = [
               'sector' => $collection_res[0][$i]['sector'],
                'organisation' => $collection_res[0][$i]['org'],
                'code' => strtoupper($collection_res[0][$i]['code']),
                'planning' => number_format((float)$collection_res[0][$i]['rfcfn'], 2, '.', ''),
                'improvements' => number_format((float)$collection_res[0][$i]['rfcfn'], 2, '.', ''),
                'communication' => number_format((float)$collection_res[0][$i]['rfcfn'], 2, '.', '')
            ];

            $response->push($data);
        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }

    public function organizations_per_quadrant(){

        $ciir_indicies = CniirIndex::all();

        $data = [
            'Q1'  => $ciir_indicies->where('quadrant_id', 1)->count(), //1 IS ID OF Q1 IN THE DB
            'Q2'  => $ciir_indicies->where('quadrant_id', 2)->count(), //2 IS ID OF Q2 IN THE DB
            'Q3'  => $ciir_indicies->where('quadrant_id', 3)->count(), //3 IS ID OF Q3 IN THE DB
            'Q4'  => $ciir_indicies->where('quadrant_id', 4)->count(), //4 IS ID OF Q4 IN THE DB
        ];

        return $this->successResponse($data, 'organisations per quadrant', Response::HTTP_OK);
    }

    public function sectors_per_quadrant(){

        $ciir_indicies = CniirIndex::all();

        $data = [
            'Q1'  => Organisation::whereIn('id', $ciir_indicies->where('quadrant_id', 1)->pluck('org_id'))->distinct('sector_id')->count(), //1 IS ID OF Q1 IN THE DB
            'Q2'  => Organisation::whereIn('id', $ciir_indicies->where('quadrant_id', 2)->pluck('org_id'))->distinct('sector_id')->count(), //2 IS ID OF Q2 IN THE DB
            'Q3'  => Organisation::whereIn('id', $ciir_indicies->where('quadrant_id', 3)->pluck('org_id'))->distinct('sector_id')->count(), //3 IS ID OF Q3 IN THE DB
            'Q4'  => Organisation::whereIn('id', $ciir_indicies->where('quadrant_id', 4)->pluck('org_id'))->distinct('sector_id')->count(), //4 IS ID OF Q4 IN THE DB
        ];

        return $this->successResponse($data, 'sectors per quadrant', Response::HTTP_OK);
    }
}
