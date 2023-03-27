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
Route::get('galery',[DataController::class,'galery']);
Route::get('file_menu',[DataController::class,'fileMenu']);
Route::get('file_share/{menu_id}',[DataController::class,'fileShare']);
Route::get('ref_proker',[DataController::class,'refProker']);
Route::get('proker/{ref_proker_id}',[DataController::class,'proker']);
Route::get('option/{title}',[DataController::class,'option']);
Route::get('category/{id}',[DataController::class,'category']);
