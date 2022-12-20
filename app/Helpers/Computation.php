<?php

namespace App\Helpers;

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
    public static function calculateCNIIRIndex($user_id){

        $rtds = ResilienceTemporalDimension::all();

        $prrtd = ResilienceTemporalDimension::where('name', 'Pre-Event')->first();
        $drrtd = ResilienceTemporalDimension::where('name', 'During-Event')->first();
        $portd = ResilienceTemporalDimension::where('name', 'Post-Event')->first();

        $cniiri = 0;
        $check = false;
        $prtdi = 0;
        $drtdi = 0;
        $portdi = 0;



        $prtdi = self::calculateRTDIndex($prrtd->id, $user_id);

        $drtdi = self::calculateRTDIndex($drrtd->id, $user_id);

        $portdi = self::calculateRTDIndex($portd->id, $user_id);

        $cniiri = ($prrtd->weight * $prtdi) + ($drrtd->weight * $drtdi) + ($portd->weight * $portdi);


        return $cniiri;
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
    private static function calculateRFfn($rf_id, $user_id){

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

    //Resilience Control Factor (RCf)
    // public static function calculateRCF($r_control_id, $user_id){

    //     $rm_ids = self::getRMIds4aGivingRC($r_control_id);

    //     $rms = self::getRMRs4aGivingRC($rm_ids, $user_id);


    //     return self::sumRMsWeights($rms);
    // }

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
}
