<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\V1\Admin\UserController;
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


// Route::fallback(function(){
//     return response()->json([
//         'message' => 'Page Not Found.'], 404);
// });

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::prefix('v1')->group(function(){
    Route::group(['middleware' => ['auth:sanctum']], function () {

        Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
            Route::get('/profile', [UserController::class, 'profile']);
        });

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
            Route::apiResource('sector', SectorController::class);
            Route::apiResource('organisation', OrganisationController::class);
        });

    });

});

