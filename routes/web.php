<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TramiteController;
use App\Models\Tramite;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

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
    Route::get('/citas', 'index')->name('temporary.index');
    Route::post('/citas', 'continue')->name('temporary.continue');
    Route::get('/estatus' , 'viewEstatus')->name('temporary.estatus');
    Route::get('/citas/create', 'create')->name('temporary.create')->middleware('signed');
});

Route::get('bdv-webhook' , [TramiteController::class , 'bdv'])->name('bdv.webhook');


