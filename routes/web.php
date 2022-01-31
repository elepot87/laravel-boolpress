<?php

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

// Rotte per autenticazione
Auth::routes();

// Rotte per area admin
Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        // Admin Homepage 
        Route::get('/', 'HomeController@index')->name('home');
    });


// Home Frontend
Route::get('{any?}', function () {
    return view('guests.home');
})->where('any', '.*');