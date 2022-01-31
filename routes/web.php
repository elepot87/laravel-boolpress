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

// Home Frontend
Route::get('/', function () {
    return view('guests.home');
});

// Rotte per autenticazione
Auth::routes();

// Rotte per area admin

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {
        // Admin Homepage 
        Route::get('/', 'HomeController@index')->name('home');
    });