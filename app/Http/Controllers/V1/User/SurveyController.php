<?php

namespace App\Http\Controllers\V1\User;

use Illuminate\Http\Request;
use App\Models\ResilienceControl;
use App\Models\ResilienceMeasure;
use App\Models\ResilienceFunction;
use App\Http\Controllers\Controller;
use App\Models\ResilienceFunctionCategory;
use App\Http\Resources\V1\Survey\ResilienceFunctionResource;

class SurveyController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\V1\SurveyResource
     */
    public function getMeasuresWithScales(int $rf_id = 0)
    {
        if($rf_id <= 0){

            $data = ResilienceFunction::with(['resilienceFunctionCategorys',
            'resilienceFunctionCategorys.resilienceControls',
            'resilienceFunctionCategorys.resilienceControls.resilienceMeasures',
            'resilienceFunctionCategorys.resilienceControls.resilienceMeasures.resilienceMeasureScales'])
            ->get();

        }else{
            $data = ResilienceFunction::where('id', $rf_id)
            ->with(['resilienceFunctionCategorys',
             'resilienceFunctionCategorys.resilienceControls',
             'resilienceFunctionCategorys.resilienceControls.resilienceMeasures',
             'resilienceFunctionCategorys.resilienceControls.resilienceMeasures.resilienceMeasureScales'])
             ->get();

        }

        return $this->successResponse(ResilienceFunctionResource::collection($data));
    }


    public function getMeasureByRF(string $rf){

        $rfcIds = self::getIdsOfRFCategoriesByRFName($rf);

        return ResilienceMeasure::whereIn('rc_id', self::getIdsOfRControlsByRFCategoriesId($rfcIds))
                ->with('resilienceMeasureScales')
                ->with('resilienceControl')->get();
    }


    private static function getIdsOfRFCategoriesByRFName(string $rf){

        $rfId  = ResilienceFunction::where(['name' => $rf])->pluck('id');

        return ResilienceFunctionCategory::whereIn('rf_id', $rfId)->pluck('id');
    }

    private static function getIdsOfRControlsByRFCategoriesId($rfcIds){

        return ResilienceControl::whereIn('rfc_id', $rfcIds)->pluck('id');
    }

}
