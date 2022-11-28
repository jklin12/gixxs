<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeojsonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('login', function () {
    return view('login');
})->name('login');
Route::get('peta', [PetaController::class, 'index']);
Route::post('ajax', [PetaController::class, 'ajax'])->name('peta.ajax');
Route::post('login', [AuthenticationController::class, 'login'])->name('login.action');
Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'user-access:super-admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('geojson/form', function () {
        return view('geojson.form');
    })->name('geojson.form');
    Route::post('geojson/store', [GeojsonController::class, 'store'])->name('geojson.store');
});
