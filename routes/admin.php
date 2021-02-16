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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


Route::group(['namespace'=>'Dashboard','prefix'=>'admin'],function (){

   Route::get('/','dashboardController@index')->name('admin.dashboard') ;//the first page in the dashboard if authantication

    Route::group(['prefix','settings'],function (){

        Route::get('sipping-methods/{type}','SettingsController@editShippingMethod')->name('edit.shippings.methods');
        Route::put('sipping-methods/{id}','SettingsController@updateShippingMethod')->name('update.shippings.methods');
    });

});


Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){

   Route::get('login','loginController@login')->name('admin.login');
    Route::post('login','loginController@postLogin')->name('admin.post.login');

});


});
