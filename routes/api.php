<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// url iniziano con /api/...

// Test route API 

Route::get('/test', function() {
    return 'hello world';
}); 

// Endpoint per le API
Route::namespace('Api')->group(function() {
    // Post archive
    Route::get('/posts', 'PostController@index');
});