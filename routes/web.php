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

Route::get('/', 'PagesController@home')->name('blog.home');
Route::get('blog/{post}', 'PostsController@show')->name('posts.show');
Route::get('categories/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');


Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth'],
function(){
    Route::get('posts', 'PostsController@index')->name('admin.posts.index');
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('post/create', 'PostsController@create')->name('admin.posts.create');
    //Route::post('posts', 'PostsController@store')->name('admin.posts.store');
    Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
    Route::post('posts/{post}', 'PostsController@store')->name('admin.posts.store');
    Route::post('posts/{post}/images', 'ImagesController@store')->name('admin.posts.images.store');
    Route::delete('images/{image}', 'ImagesController@destroy')->name('admin.images.destroy');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
