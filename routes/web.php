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

Route::get('/', [\App\Http\Controllers\PageController::class, 'home']);
Route::get('/projects', [\App\Http\Controllers\PageController::class, 'projects']);
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact']);
Route::post('/contact', [\App\Http\Controllers\PageController::class, 'contactFormSubmit']);
