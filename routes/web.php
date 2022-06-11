<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TramiteController;
use App\Models\Tramite;
use Illuminate\Support\Facades\URL;

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
    //Route::get('/temporary-request/create/s', 'create_second')->name('temporary.create_second')->middleware('signed');
    //Route::get('/temporary-request/create/t' , 'create_third')->name('temporary.create_third')->middleware('signed');
});

Route::get('/billing', function () {
    $tramite = Tramite::first();
    //$stripeCustomer = $tramite->createAsStripeCustomer();
    return $tramite->checkout(['price_1KlitfCfO3YICm7hCUSDnlO6'] , [
        'success_url' => route('success'),
        'cancel_url' => URL::signedRoute('temporary.create'),
    ]);
});

Route::get('/success' , function(){
    return view('temporary.success');
})->name('success');

Route::get('/fail' , function(){
    return view('temporary.fail');
})->name('fail');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
