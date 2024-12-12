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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('apartment', 'ApartmentController');
Route::get('apartment/{id}/task/create', 'TaskController@create')->name('task.create');
Route::post('apartment/{id}/task', 'TaskController@store')->name('task.store');
Route::resource('task', 'TaskController')->except(['create', 'store']);
