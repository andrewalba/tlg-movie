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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('actors')->group(function () {
    Route::get('/', 'App\Http\Controllers\ActorController@index')->name('actors');
    Route::post('/', 'App\Http\Controllers\ActorController@store')->middleware('auth')->name('store.actor');
    Route::get('/{id}', 'App\Http\Controllers\ActorController@show')->name('actor');
    Route::put('/{id}', 'App\Http\Controllers\ActorController@update')->middleware('auth')->name('update.actor');
    Route::delete('/{id}', 'App\Http\Controllers\ActorController@destroy')->middleware('auth')->name('delete.actor');
});

Route::prefix('movies')->group(function () {
    Route::get('/', 'App\Http\Controllers\MovieController@index')->name('movies');
    Route::post('/', 'App\Http\Controllers\MovieController@store')->middleware('auth')->name('store.movie');
    Route::get('/{id}', 'App\Http\Controllers\MovieController@show')->name('movie');
    Route::put('/{id}', 'App\Http\Controllers\MovieController@update')->middleware('auth')->name('update.movie');
    Route::delete('/{id}', 'App\Http\Controllers\MovieController@destroy')->middleware('auth')->name('delete.movie');
});
