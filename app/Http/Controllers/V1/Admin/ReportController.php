<?php

namespace App\Http\Controllers\V1\Admin;

use stdClass;
use App\Helpers\Computation;
use App\Models\Organisation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ResilienceFunctionCategory;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    //all this method is not the best approache but because of time constraint it is woring for now
    public function identity()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 12)->pluck('name', 'id');//12 is the id of identity in rf table

        $response = [];
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){
            $res = Computation::rfcfnByOrg($key, $rfc);


            $collection_res->push($res);
        }


        $orgs = Organisation::with('sector')->get();


        foreach($orgs as $org){

            $asset = $business_environment = $governance = $risk_management = $risk_management_strategy = 0;


            foreach($collection_res as $res){

                $check = false;

                if($org->name ==$res[0]['org']){


                    if($res[0]['name'] == 'Asset'){
                        $asset = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Governance'){
                        $governance = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Risk Management'){
                        $risk_management = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Business Environment'){
                        $business_environment = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Risk Management Strategy'){
                        $risk_management_strategy = $res[0]['rfcfn'];
                    }

                    $check = true;
                }

            }

            if($check){
                $data = [
                    'sector' => $org->sector->name,
                    'organisation' => $org->name,
                    'code' => strtoupper($org->code),
                    'assets' => number_format((float)$asset, 2, '.', ''),
                    'governance' => number_format((float)$governance, 2, '.', ''),
                    'risk_management' => number_format((float)$risk_management, 2, '.', ''),
                    'business_environment' => number_format((float)$business_environment, 2, '.', ''),
                    'risk_management_strategy' => number_format((float)$risk_management_strategy, 2, '.', '')
                ];

                array_push($response, $data);
            }


        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }


    public function protect()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 13)->pluck('name', 'id');//13 is the id of protect in rf table

        $response = [];
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){
            $res = Computation::rfcfnByOrg($key, $rfc);


            $collection_res->push($res);
        }


        $orgs = Organisation::with('sector')->get();


        foreach($orgs as $org){

            $maintenance = $access_control = $identity_management = $awareness_and_training = $protective_technology = 0;


            foreach($collection_res as $res){

                $check = false;

                if($org->name ==$res[0]['org']){


                    if($res[0]['name'] == 'Maintenance'){
                        $maintenance = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Access Control'){
                        $access_control = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Identity Management'){
                        $identity_management = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Awareness and Training'){
                        $awareness_and_training = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Protective Technology'){
                        $protective_technology = $res[0]['rfcfn'];
                    }

                    $check = true;
                }

            }

            if($check){
                $data = [
                    'sector' => $org->sector->name,
                    'organisation' => $org->name,
                    'code' => strtoupper($org->code),
                    'maintenance' => number_format((float)$maintenance, 2, '.', ''),
                    'access_control' => number_format((float)$access_control, 2, '.', ''),
                    'identity_management' => number_format((float)$identity_management, 2, '.', ''),
                    'awareness_and_training' => number_format((float)$awareness_and_training, 2, '.', ''),
                    'protective_technology' => number_format((float)$protective_technology, 2, '.', '')
                ];

                array_push($response, $data);
            }


        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }

    public function detect()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 14)->pluck('name', 'id');//14 is the id of detect in rf table

        $response = [];
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){
            $res = Computation::rfcfnByOrg($key, $rfc);


            $collection_res->push($res);
        }


        $orgs = Organisation::with('sector')->get();


        foreach($orgs as $org){

            $anomalies_and_events = $monitoring = $detection_process = 0;


            foreach($collection_res as $res){

                $check = false;

                if($org->name ==$res[0]['org']){


                    if($res[0]['name'] == 'Anomalies and Events'){
                        $anomalies_and_events = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Monitoring'){
                        $monitoring = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Detection Process'){
                        $detection_process = $res[0]['rfcfn'];
                    }

                    $check = true;
                }

            }

            if($check){
                $data = [
                    'sector' => $org->sector->name,
                    'organisation' => $org->name,
                    'code' => strtoupper($org->code),
                    'anomalies_and_events' => number_format((float)$anomalies_and_events, 2, '.', ''),
                    'monitoring' => number_format((float)$monitoring, 2, '.', ''),
                    'detection_process' => number_format((float)$detection_process, 2, '.', '')
                ];

                array_push($response, $data);
            }


        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }

    public function respond()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 15)->pluck('name', 'id');//15 is the id of respond in rf table

        $response = [];
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){
            $res = Computation::rfcfnByOrg($key, $rfc);


            $collection_res->push($res);
        }


        $orgs = Organisation::with('sector')->get();


        foreach($orgs as $org){

            $planning = $analysis = $communication = $mitigation = $improvements = 0;


            foreach($collection_res as $res){

                $check = false;

                if($org->name ==$res[0]['org']){


                    if($res[0]['name'] == 'Planning'){
                        $planning = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Analysis'){
                        $analysis = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Mitigation'){
                        $mitigation = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Improvements'){
                        $improvements = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Communication'){
                        $communication = $res[0]['rfcfn'];
                    }

                    $check = true;
                }

            }

            if($check){
                $data = [
                    'sector' => $org->sector->name,
                    'organisation' => $org->name,
                    'code' => strtoupper($org->code),
                    'planning' => number_format((float)$planning, 2, '.', ''),
                    'analysis' => number_format((float)$analysis, 2, '.', ''),
                    'mitigation' => number_format((float)$mitigation, 2, '.', ''),
                    'improvements' => number_format((float)$improvements, 2, '.', ''),
                    'communication' => number_format((float)$communication, 2, '.', '')
                ];

                array_push($response, $data);
            }


        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }

    public function recover()
    {
        $rfcs = ResilienceFunctionCategory::where('rf_id', 16)->pluck('name', 'id');//16 is the id of recover in rf table

        $response = [];
        $collection_res = collect();


        foreach($rfcs as $key => $rfc){
            $res = Computation::rfcfnByOrg($key, $rfc);


            $collection_res->push($res);
        }


        $orgs = Organisation::with('sector')->get();


        foreach($orgs as $org){

            $planning = $improvements = $communication = 0;


            foreach($collection_res as $res){

                $check = false;

                if($org->name ==$res[0]['org']){


                    if($res[0]['name'] == 'Planning'){
                        $planning = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Improvements'){
                        $improvements = $res[0]['rfcfn'];
                    }

                    if($res[0]['name'] == 'Communication'){
                        $communication = $res[0]['rfcfn'];
                    }


                    $check = true;
                }

            }

            if($check){
                $data = [
                    'sector' => $org->sector->name,
                    'organisation' => $org->name,
                    'code' => strtoupper($org->code),
                    'planning' => number_format((float)$planning, 2, '.', ''),
                    'improvements' => number_format((float)$improvements, 2, '.', ''),
                    'communication' => number_format((float)$communication, 2, '.', '')
                ];

                array_push($response, $data);
            }


        }

        return $this->successResponse($response, 'success', Response::HTTP_OK);
    }
}
