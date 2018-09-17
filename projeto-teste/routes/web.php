<?php

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

Route::get('/users/get/{id}', 'UsersController@get');
Route::get('/users/list', 'UsersController@list');
Route::post('/users/list', 'UsersController@list');
Route::post('/users/create', 'UsersController@create');
Route::delete('/users/delete', 'UsersController@delete');
