<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//note the prefix of the file is admin

Route::group(['namespace'=>'Dashboard'],function (){

   Route::get('/','dashboardController@index')->name('admin.dashboard') ;//the first page in the dashboard if authantication

});


Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin'],function (){

   Route::get('login','loginController@login')->name('admin.login');
    Route::post('login','loginController@postLogin')->name('admin.post.login');

});
