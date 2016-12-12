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
Route::get('/','HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('estado', 'EstadoController@index');
Route::get('estado/index', 'EstadoController@index');
Route::post('estado/find', 'EstadoController@find');
Route::post('estado/save', 'EstadoController@save');
Route::get('estado/all', 'EstadoController@all');
Route::post('estado/delete', 'EstadoController@delete');
