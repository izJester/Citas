<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TramiteController;
use App\Models\Tramite;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TramiteRegistradoConExito;

use App\Classes\IpgBdv;
use App\Classes\IpgBdvPaymentRequest;
use App\Models\Pago;

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
    Route::get('/temporary-request/create', 'create')->name('temporary.create')->middleware('signed');
    //Route::get('/temporary-request/create/s', 'create_second')->name('temporary.create_second')->middleware('signed');
    //Route::get('/temporary-request/create/t' , 'create_third')->name('temporary.create_third')->middleware('signed');
});

Route::get('/success' , function(){
    $tramite = Tramite::where('id' , request('tramite'))->first();
    $tramite->update(['pago' => true]);
    Mail::to($tramite->email)->send(new TramiteRegistradoConExito($tramite));
    return view('temporary.success');
})->name('success');

Route::get('/fail' , function(){
    $tramite = Tramite::where('id' , request('tramite'))->first();
    $tramite->delete();
    return redirect('/');
})->name('fail');

Route::get('prueba' , function(){
    return dd(config('bdv.user') , config('bdv.password'));
});


