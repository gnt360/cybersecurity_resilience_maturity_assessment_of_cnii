<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Organisation;
use App\Models\ResilienceControl;
use App\Models\ResilienceMeasure;
use App\Models\ResilienceFunction;
use App\Models\ResilienceMeasureResponse;
use App\Models\ResilienceFunctionCategory;
use App\Models\ResilienceTemporalDimension;

class Computation
{
    public function __construct()
    {
    }

    //CNII Resilience Index (CNIIRI)
    public static function calculateCNIIRIndex($user_id, $prtdi, $drtdi, $portdi){

        $rtds = ResilienceTemporalDimension::all();

        $prrtd = ResilienceTemporalDimension::where('name', 'Pre-Event')->first();
        $drrtd = ResilienceTemporalDimension::where('name', 'During-Event')->first();
        $portd = ResilienceTemporalDimension::where('name', 'Post-Event')->first();

        $cniiri = 0;

        $cniiri = ($prrtd->weight * $prtdi) + ($drrtd->weight * $drtdi) + ($portd->weight * $portdi);


        return $cniiri;
    }

    public static function calculatePRTDI($user_id){

        $prrtd = ResilienceTemporalDimension::where('name', 'Pre-Event')->first();

        return self::calculateRTDIndex($prrtd->id, $user_id);
    }

    public static function calculateDRTDI($user_id){

        $drrtd = ResilienceTemporalDimension::where('name', 'During-Event')->first();

        return self::calculateRTDIndex($drrtd->id, $user_id);
    }

    public static function calculatePORTDI($user_id){

        $portd = ResilienceTemporalDimension::where('name', 'Post-Event')->first();

        return self::calculateRTDIndex($portd->id, $user_id);
    }

    //Resilience Temporal Dimension Index (RTDI)
    private static function calculateRTDIndex($rtd_id, $user_id){

        $ids = ResilienceFunction::where('rtd_id', $rtd_id)->pluck('id');

        $rtdi = 0;
        $rffn = 0;
        $count = 0;

        if($ids){

            foreach($ids as $id){

                $temp = self::calculateRFfn($id, $user_id);

                if($temp != "N/A"){
                    $rffn += $temp;
                    $count++;
                }

            }

            if($count == 0){
                return 0;
            }

            $rtdi = $rffn / $count;

        }

        return  $rtdi;
    }


    //Resilience Function Factor normalised (RFfN)
    public static function calculateRFfn($rf_id, $user_id){

        $ids = ResilienceFunctionCategory::where('rf_id', $rf_id)->pluck('id');

        $rffn = 0;
        $rfcn = 0;
        $count = 0;

        if($ids){

            foreach($ids as $id){

                $temp = self::calculateRFCfn($id, $user_id);

                if($temp != "N/A"){
                    $rfcn += $temp;
                    $count++;
                }

            }

            if($count == 0){
                return "N/A";
            }

            $rffn = $rfcn / $count;

        }

        return  $rffn;
    }

    //Resilience Function Category Factor normalised (RFCfN)
    private static function calculateRFCfn($rcf_id, $user_id){

        $ids = ResilienceControl::where('rfc_id', $rcf_id)->pluck('id');

        $rfcfn = 0;
        $rcfn = 0;
        $count = 0;

        if($ids){

            foreach($ids as $id){

                $temp = self::calculateRCfn($id, $user_id);

                if($temp != "N/A"){
                    $rcfn += $temp;
                    $count++;
                }

            }

            if($count == 0){
                return "N/A";
            }

            $rfcfn = $rcfn / $count;
        }

        return $rfcfn;
    }

    //Resilience Control Factor normalised (RCfN)
    private static function calculateRCfn($r_control_id, $user_id){

        $rm_ids = self::getRMIds4aGivingRC($r_control_id);

        $rmrs = self::getRMRs4aGivingRC($rm_ids, $user_id);


        $count = $rmrs->count();

        if($count == 0){
            return "N/A";
        }

        $rcf = self::sumRMSWeights($rmrs);

        $rcfn = $rcf / (4 * $count);

        return $rcfn;
    }


    private static function sumRMSWeights($data){

        $sum = $data->sum('resilienceMeasureScale.weight');

        return $sum;
    }

    //ResilienceMeasureResponse  RMR
    private static function getRMRs4aGivingRC($rm_ids, $user_id){

        $data = ResilienceMeasureResponse::where('user_id', $user_id)
                ->whereIn('rm_id', $rm_ids)
                ->with(['resilienceMeasureScale', 'resilienceMeasure'])->get();

        return $data;
    }

    private static function getRMIds4aGivingRC($r_control_id){
        return ResilienceMeasure::where('rc_id', $r_control_id)->pluck('id');
    }


    public static function rfcfnByOrg($rfc_id, $name){
        $user_ids = User::pluck('id');

        //$rms = ResilienceMeasureResponse::whereIn('user_id', $user_ids)->with('organisation')->get();

        //$rfcs = ResilienceFunctionCategory::where('rf_id', $rf_id)->pluck('id', 'name');

        $orgs = Organisation::all();

            $collection = collect();

            foreach($orgs as $org){
                $rfcfn = self::calculateRFCfnByOrg($rfc_id, $org->id);

                if($rfcfn != 'N/A')
                {
                    $collection->push(['org' => $org->name, 'rfcfn' => $rfcfn, 'name' => $name]);
                }



            }

            return $collection;

    }

     //Resilience Function Factor normalised (RFfN) By organisation
     public static function calculateRFfnByOrg($rf_id, $org_id){

        $ids = ResilienceFunctionCategory::where('rf_id', $rf_id)->pluck('id');

        $rffn = 0;
        $rfcn = 0;
        $count = 0;

        if($ids){

            foreach($ids as $id){

                $temp = self::calculateRFCfnByOrg($id, $org_id);

                if($temp != "N/A"){
                    $rfcn += $temp;
                    $count++;
                }

            }

            if($count == 0){
                return "N/A";
            }

            $rffn = $rfcn / $count;

        }

        return  $rffn;
    }

    //Resilience Function Category Factor normalised (RFCfN) by Organisation
    private static function calculateRFCfnByOrg($rcf_id, $org_id){

        $ids = ResilienceControl::where('rfc_id', $rcf_id)->pluck('id');

        $rfcfn = 0;
        $rcfn = 0;
        $count = 0;

        if($ids){

            foreach($ids as $id){

                $temp = self::calculateRCfnByOrg($id, $org_id);

                if($temp != "N/A"){
                    $rcfn += $temp;
                    $count++;
                }

            }

            if($count == 0){
                return "N/A";
            }

            $rfcfn = $rcfn / $count;
        }

        return $rfcfn;
    }

    //Resilience Control Factor normalised (RCfN) by organisation
    private static function calculateRCfnByOrg($r_control_id, $org_id){

        $rm_ids = self::getRMIds4aGivingRC($r_control_id);

        $rmrs = self::getRMRs4aGivingRCByOrg($rm_ids, $org_id);


        $count = $rmrs->count();

        if($count == 0){
            return "N/A";
        }

        $rcf = self::sumRMSWeights($rmrs);

        $rcfn = $rcf / (4 * $count);

        return $rcfn;
    }


    //ResilienceMeasureResponse  RMR by organisation
    private static function getRMRs4aGivingRCByOrg($rm_ids, $org_id){

        $data = ResilienceMeasureResponse::where('user_id', $org_id)
                ->whereIn('rm_id', $rm_ids)
                ->with(['resilienceMeasureScale', 'resilienceMeasure'])->get();

        return $data;
    }
}
