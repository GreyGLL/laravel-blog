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
    return view('home');
});

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/route-search', function () {
    return view('route-search');
});

Route::get('/route-detail', function () {
    return view('route-detail');
});
//Route::get('routes-search', 'RoutesController@index')->name('routes.index');

Route::get('/test', function () {
    return view('test');
});

Route::get('/gibson', function () {
    return view('gibson');
});