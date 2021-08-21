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

// Please be noticed that i've update the route service provider to point controllers path in my directory
// to just group the work inside the same dir.

Route::post('/users/import', 'UserImportsController@import');


