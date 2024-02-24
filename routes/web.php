<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('privacy-policy', function () {
    return view('privacy-policy');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

/* Dashboard Controller */
Route::get('/dashboard'                         , 'App\Http\Controllers\DashboardController@index');
Route::get('settings'                           , 'DashboardController@globalSetting');
Route::post('update/{id}'                       , 'DashboardController@updateSettings');
Route::get('db-backup'                          , 'DashboardController@databaseBackup');




Route::get('auth/google', 'App\Http\Controllers\Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');

