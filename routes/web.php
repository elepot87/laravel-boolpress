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
    return view('welcome');
});

// Rotte per autenticazione
Auth::routes();

// Rotte per area admin
Route::get('/home', 'HomeController@index')->name('home');
