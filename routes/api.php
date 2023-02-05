<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\V1\Admin\UserController;
use App\Http\Controllers\V1\User\SurveyController;
use App\Http\Controllers\V1\Admin\SectorController;
use App\Http\Controllers\V1\Admin\QuadrantController;
use App\Http\Controllers\V1\Admin\CniirIndexController;
use App\Http\Controllers\V1\Admin\ComputationController;
use App\Http\Controllers\V1\Admin\OrganisationController;
use App\Http\Controllers\V1\Admin\ReportController;
use App\Http\Controllers\V1\Admin\ResilienceControlController;
use App\Http\Controllers\V1\Admin\ResilienceMeasureController;
use App\Http\Controllers\V1\Admin\ResilienceFunctionController;
use App\Http\Controllers\V1\Admin\ResilienceMeasureScaleController;
use App\Http\Controllers\V1\Admin\ResilienceMeasureResponseController;
use App\Http\Controllers\V1\Admin\ResilienceFunctionCategoryController;
use App\Http\Controllers\V1\Admin\ResilienceTemporalDimensionController;
use App\Models\Organisation;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::fallback(function(){
//     return response()->json([
//         'message' => 'Page Not Found.'], 404);
// });

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::prefix('v1')->group(function(){

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::apiResource('sector', SectorController::class);
        Route::apiResource('organisation', OrganisationController::class);
    });
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::group(['prefix' => 'admin', 'middleware' => 'is_admin', 'as' => 'admin.'], function() {
            // Route::apiResource('sector', SectorController::class);
            // Route::apiResource('organisation', OrganisationController::class);
            Route::apiResource('resilienceTemporalDimension', ResilienceTemporalDimensionController::class);
            Route::apiResource('resilienceFunction', ResilienceFunctionController::class);
            Route::apiResource('resilienceFunctionCategory', ResilienceFunctionCategoryController::class);
            Route::apiResource('resilienceControl', ResilienceControlController::class);
            Route::apiResource('resilienceMeasure', ResilienceMeasureController::class);
            Route::apiResource('resilienceMeasureScale', ResilienceMeasureScaleController::class);
            Route::apiResource('resilienceMeasureResponse', ResilienceMeasureResponseController::class);
            Route::apiResource('quadrant', QuadrantController::class);
            Route::apiResource('cniirIndex', CniirIndexController::class);

            Route::get('/resilienceFunctionByRtd/{id}/', [ResilienceFunctionController::class, 'getRFbyRTDid']);
            Route::get('/resilienceFunctionCategoryByRf/{id}/', [ResilienceFunctionCategoryController::class, 'getRFCbyRFid']);
            Route::get('/resilienceControlByRfc/{id}/', [ResilienceControlController::class, 'getRCbyRFCid']);
            Route::get('/resilienceMeasureByRc/{id}/', [ResilienceMeasureController::class, 'getRMbyRCid']);
            Route::get('/resilienceMeasureScaleByRm/{id}/', [ResilienceMeasureScaleController::class, 'getRMSbyRMid']);
            Route::get('/cIndex/consolidated', [CniirIndexController::class, 'getConsolidatedIndex']);
            Route::get('/users', [UserController::class, 'get_all_users']);

            Route::get('/report/identity', [ReportController::class, 'identity']);
            Route::get('/report/protect', [ReportController::class, 'protect']);
            Route::get('/report/detect', [ReportController::class, 'detect']);
            Route::get('/report/respond', [ReportController::class, 'respond']);
            Route::get('/report/recover', [ReportController::class, 'recover']);
            Route::get('/report/organizations_per_quadrant', [ReportController::class, 'organizations_per_quadrant']);
            Route::get('/report/sectors_per_quadrant', [ReportController::class, 'sectors_per_quadrant']);

        });


         Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
            Route::get('/profile', [UserController::class, 'profile']);
            Route::get('/survey/{rf_id?}', [SurveyController::class, 'getMeasuresWithScales']);
            Route::post('/survey/storeResponse', [SurveyController::class, 'storeResponse']);
            Route::get('/cniirIndex/computation', [CniirIndexController::class, 'cniirIndexComputation']);
            Route::get('/cniirIndex/show', [SurveyController::class, 'showCniirIndex']);
        });

    });

    Route::get('/sectors', [SectorController::class, 'index']);
    Route::get('/organisations', [OrganisationController::class, 'index']);
    Route::get('/organisationsBySectorID/{sector_id}', [OrganisationController::class, 'organisationsBySectorID']);

});

