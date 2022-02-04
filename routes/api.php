<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Admin\SectorController;
use App\Http\Controllers\V1\Admin\OrganisationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::fallback(function(){
//     return response()->json([
//         'message' => 'Page Not Found.'], 404);
// });

Route::prefix('v1')->group(function(){

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::apiResource('sector', SectorController::class);
        Route::apiResource('organisation', OrganisationController::class);
    });

});

