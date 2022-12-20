<?php

namespace App\Helpers;

use App\Models\CniirIndex;
use App\Models\Quadrant;
use App\Models\ResilienceMeasureResponse;

class CniirIndexService
{

    public function __construct()
    {
    }


    public static function checkIfUserHasCompletedSurvey($user_id){

        $result = true;

        //$data1 = CniirIndex::where('user_id', $user_id)->latest()->first();

        $data2 = ResilienceMeasureResponse::where('user_id', $user_id)->latest()->first();

        if($data2 == null){
            $result = false;
        }

        // if($data1 != null && $data2 != null){
        //     $result = $data2->created_at > $data1->created_at;
        // }

        return $result;
    }

    public static function getQuadrantFromScore($score){
        $quadrants = Quadrant::all();

        $q_id = 0;

        foreach($quadrants as $q){
            if($q->low_limit <= $score && $q->upper_limit >= $score){
                $q_id = $q->id;

                break;
            }
        }

        return $q_id;
    }

    public static function saveCniirIndex($org_id, $quadrant_id, $user_id, $score, $pre_event_rtd_score, $during_event_rtd_score, $post_event_rtd_score){

        $cniir = CniirIndex::where('org_id', $org_id)->first();

        if($cniir){
           $score = $cniir->score + $score;

           $score = $score / 2;

           $pre_event_rtd_score = $pre_event_rtd_score / 2;

           $during_event_rtd_score = $during_event_rtd_score / 2;

           $post_event_rtd_score = $post_event_rtd_score / 2;

           $quadrant_id = self::getQuadrantFromScore($score);

           $cniir->update([
                'org_id'        => $org_id,
                'quadrant_id'   => $quadrant_id,
                'user_id'       => $user_id,
                'score'         => $score,
                'pre_event_rtd_score' => $pre_event_rtd_score,
                'during_event_rtd_score' => $during_event_rtd_score,
                'post_event_rtd_score' => $post_event_rtd_score
            ]);

            return $cniir;
        }

        return CniirIndex::create([
            'org_id'        => $org_id,
            'quadrant_id'   => $quadrant_id,
            'user_id'       => $user_id,
            'score'         => $score,
            'pre_event_rtd_score' => $pre_event_rtd_score,
            'during_event_rtd_score' => $during_event_rtd_score,
            'post_event_rtd_score' => $post_event_rtd_score
        ]);
    }

    public static function consolidateIndex(){

        $org_ids = CniirIndex::unique('org_id');
        dd($org_ids) ;
    }
}
