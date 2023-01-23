<?php

use App\Http\Controllers\API\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('geojson',[DataController::class,'geojson']);
Route::get('ijin_lingkungan',[DataController::class,'ijinLingkungan']);
Route::get('kes',[DataController::class,'kes']);
Route::get('dkl',[DataController::class,'dkl']);
Route::get('sppl',[DataController::class,'sppl']);
