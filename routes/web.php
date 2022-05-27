<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TramiteController;

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
    return view('default');
});

Route::controller(TramiteController::class)->group(function () {
    Route::get('/temporary-request', 'index')->name('temporary.index');
    Route::post('/temporary-request', 'continue')->name('temporary.continue');
    Route::get('/estatus' , 'viewEstatus')->name('temporary.estatus');
    Route::get('/temporary-request/create/f', 'create')->name('temporary.create')->middleware('signed');
    Route::get('/temporary-request/create/s', 'create_second')->name('temporary.create_second')->middleware('signed');
    Route::get('/temporary-request/create/t' , 'create_third')->name('temporary.create_third')->middleware('signed');
});

Route::get('/prueba', function () {
    App\Events\Prueba::dispatch();
});

Route::get('/success' , function(){
    return view('temporary.success');
});

Route::get('/fail' , function(){
    return view('temporary.fail');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
