<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'PageCDR@index');

Route::get('/cdr', 'PageCDR@index');
Route::post('/cdr', 'PageCDR@index');

Route::get('/users', 'PageUsers@index');


Route::get('/home', 'HomeController@index');
