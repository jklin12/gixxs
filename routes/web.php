<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DklController;
use App\Http\Controllers\FileMenuController;
use App\Http\Controllers\FileShareController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\Geojson2Controller;
use App\Http\Controllers\GeojsonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IjinLingkunganController;
use App\Http\Controllers\KesController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PetaController;
use App\Http\Controllers\ProkerController;
use App\Http\Controllers\RefProkerController;
use App\Http\Controllers\SpplController;
use App\Http\Controllers\UsersControlerr;
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
 
Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('peta', [PetaController::class, 'index'])->name('peta');
Route::get('peta_mobile', [PetaController::class, 'petaMobile'])->name('peta.mobile');
Route::post('ajax', [PetaController::class, 'ajax'])->name('peta.ajax');
Route::post('dologin', [AuthenticationController::class, 'login'])->name('login.action');
Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ijin_lingkungan', [HomeController::class, 'ijinLingkungan'])->name('ijinLingkungan');
Route::get('/ijin_lingkungan/{data_id}', [HomeController::class, 'ijinLingkunganDetail'])->name('ijinLingkungan.detail');
Route::get('/kawasan_es', [HomeController::class, 'kes'])->name('kes');
Route::get('/kawasan_es/{data_id}', [HomeController::class, 'kesDetail'])->name('kes.detail');
Route::get('/dokumen_kl', [HomeController::class, 'dkl'])->name('dkl');
Route::get('/dokumen_kl/{data_id}', [HomeController::class, 'dklDetail'])->name('dkl.detail');
Route::get('/sppl', [HomeController::class, 'sppl'])->name('sppl');
Route::get('/proker', [HomeController::class, 'proker'])->name('home_proker');
Route::get('/file', [HomeController::class, 'file'])->name('home_file');
Route::get('/sppl/{data_id}', [HomeController::class, 'spplDetail'])->name('sppl.detail');

Route::middleware(['auth', 'user-access:super-admin'])->group(function () {
    /*Route::get('geojson/form', function () {
        return view('geojson.form');
    })->name('geojson.form');
    Route::post('geojson/store', [GeojsonController::class, 'store'])->name('geojson.store');*/
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::resource('dashboard/ijin_lingkungan', IjinLingkunganController::class);
    Route::resource('dashboard/kes', KesController::class);
    Route::resource('dashboard/geojson', Geojson2Controller::class);
    Route::resource('dashboard/dkl', DklController::class);
    Route::resource('dashboard/sppl', SpplController::class);
    Route::resource('dashboard/galery', GaleryController::class);
    Route::resource('dashboard/option', OptionController::class);
    Route::resource('dashboard/menu', MenuController::class);
    Route::resource('dashboard/menu_file', FileMenuController::class);
    Route::resource('dashboard/file_share', FileShareController::class);
    Route::resource('dashboard/category', CategoryController::class);
    Route::resource('dashboard/users', UsersControlerr::class);
    Route::resource('dashboard/ref_proker', RefProkerController::class);
    Route::resource('dashboard/proker', ProkerController::class);
});
