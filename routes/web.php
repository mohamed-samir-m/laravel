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

Route::get('/contact','PagesController@contact');
Route::get('/','ResturantController@index')->name('posts.index'); 
Route::get('/about','PagesController@about');
Route::get('/cards/create','ResturantController@create')->name('posts.create');
Route::get('/cards/{id}','ResturantController@show')->name('posts.show');
Route::post('/','ResturantController@store')->name('posts.store');
Route::get('/cards/{id}/edit','ResturantController@edit')->name('posts.edit');
Route::put('/cards/{id}','ResturantController@update')->name('posts.update');
Route::delete('/cards/{id}','ResturantController@destroy')->name('posts.destroy');


Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');