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
Route::get('peta', [PetaController::class, 'index'])->name('peta');
Route::post('ajax', [PetaController::class, 'ajax'])->name('peta.ajax');
Route::post('login', [AuthenticationController::class, 'login'])->name('login.action');
Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/ijin_lingkungan', [HomeController::class, 'ijinLingkungan'])->name('ijinLingkungan');
Route::get('/ijin_lingkungan/{data_id}', [HomeController::class, 'ijinLingkunganDetail'])->name('ijinLingkungan.detail');
Route::get('/kawasan_es', [HomeController::class, 'kes'])->name('kes');
Route::get('/kawasan_es/{data_id}', [HomeController::class, 'kesDetail'])->name('kes.detail');
Route::get('/dokumen_kl', [HomeController::class, 'dkl'])->name('dkl');
Route::get('/dokumen_kl/{data_id}', [HomeController::class, 'dklDetail'])->name('dkl.detail');
Route::get('/sppl', [HomeController::class, 'sppl'])->name('sppl');
Route::get('/sppl/{data_id}', [HomeController::class, 'spplDetail'])->name('sppl.detail');

Route::middleware(['auth', 'user-access:super-admin'])->group(function () {
    Route::get('geojson/form', function () {
        return view('geojson.form');
    })->name('geojson.form');
    Route::post('geojson/store', [GeojsonController::class, 'store'])->name('geojson.store');
});
