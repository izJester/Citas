<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemporalController;

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

Route::controller(TemporalController::class)->group(function () {
    Route::get('/temporary-request', 'index')->name('temporary.index');
    Route::get('/temporary-request/create/f/{identf?}', 'create')->name('temporary.create');
    Route::get('/temporary-request/create/s/{identf}', 'create_second')->name('temporary.create_second')->middleware('signed');
    Route::get('/temporary-request/create/t/{identf}' , 'create_third')->name('temporary.create_third');
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
