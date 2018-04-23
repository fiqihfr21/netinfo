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
use Illuminate\Http\Request;
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@filter');
Route::post('/search', 'HomeController@search');

Auth::routes();
// Route untuk user yang sudah register
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function(){
    Route::get('/', 'UserController@index');
    Route::post('/loc', 'UserController@filter');
    Route::post('/src', 'UserController@search');
    Route::post('/upload', 'UserController@upload');
    Route::get('/{id}/report', 'UserController@report');
    Route::Post('report', 'UserController@storeReport');
    Route::post('comment/{id}', 'UserController@storeComment');
    Route::get('profil', 'profilController@index');
    Route::get('{id}', 'UserController@getComment');
    Route::get('profil/edit', 'profilController@edit');
    Route::post('profil/edit', 'profilController@update');

});
// Route untuk user yang admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin']], function(){
    Route::get('/', 'AdminController@index');
    Route::get('/member', 'AdminController@member');
    Route::delete('/member/{id}', 'AdminController@memberDelete');
    Route::get('/post', 'AdminController@post');
    Route::delete('/post/{id}', 'AdminController@postDelete');
    Route::get('/report', 'AdminController@report');
    Route::delete('/report/{id}', 'AdminController@reportDelete');
});
