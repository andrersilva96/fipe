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

Auth::routes(['reset' => false]);

Route::get('/', 'HomeController@index')->name('index');
Route::match(['get', 'post'], '/home', 'HomeController@home')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/tip/delete/{tip}', 'TipController@delete')->name('delete.tip')->can('owner,tip');
    Route::post('/tip/{tip}', 'TipController@index')->can('owner,tip');
});

Route::get('/tip/{tip}', 'TipController@index')->name('tip');
