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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*Route::get('/dashboard/actors/{id}', function () {
    return view('actor');
})->middleware(['auth'])->name('actors');*/

Route::get('/dashboard/actors', function () {
    return view('actors');
})->middleware(['auth'])->name('actors');

Route::get('/dashboard/movies', function() {
    return view('movies');
})->middleware(['auth'])->name('movies');

require __DIR__.'/auth.php';
