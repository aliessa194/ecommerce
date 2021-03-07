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


Route::group(['namespace'=>'Dashboard','prefix'=>'admin','middleware' => 'auth:admin'],function (){

   Route::get('/','dashboardController@index')->name('admin.dashboard') ;//the first page in the dashboard if authantication
    Route::get('logout','dashboardController@logout')->name('logout.admin');


    Route::group(['prefix','settings'],function (){

        Route::get('sipping-methods/{type}','SettingsController@editShippingMethod')->name('edit.shippings.methods');
        Route::put('sipping-methods/{id}','SettingsController@updateShippingMethod')->name('update.shippings.methods');
    });


    Route::group(['prefix'=>'profile'],function (){

        Route::get('edit','ProfileController@editprofile')->name('edit.profile');
        Route::put('update','ProfileController@updateprofile')->name('update.profile');
       // Route::put('update/password','ProfileController@updateprofilepassword')->name('update.profile.password');
    });

      ////////////categories admin////////

    Route::group(['prefix'=>'main_categories'],function (){

        Route::get('/','MainCategoriesController@index')->name('admin.main_categories');
        Route::get('creat','MainCategoriesController@creat')->name('admin.main_categories.creat');
        Route::post('store','MainCategoriesController@store')->name('admin.main_categories.store');
        Route::get('edit/{id}','MainCategoriesController@edit')->name('admin.main_categories.edit');
        Route::post('update/{id}','MainCategoriesController@update')->name('admin.main_categories.update');
        Route::get('delete/{id}','MainCategoriesController@delete')->name('admin.main_categories.delete');

    });

    Route::group(['prefix'=>'sub_categories'],function (){

        Route::get('/','SubCategoriesController@index')->name('admin.sub_categories');
        Route::get('creat','SubCategoriesController@creat')->name('admin.sub_categories.creat');
        Route::post('store','SubCategoriesController@store')->name('admin.sub_categories.store');
        Route::get('edit/{id}','SubCategoriesController@edit')->name('admin.sub_categories.edit');
        Route::post('update/{id}','SubCategoriesController@update')->name('admin.sub_categories.update');
        Route::get('delete/{id}','SubCategoriesController@delete')->name('admin.sub_categories.delete');

    });

    Route::group(['prefix'=>'brands'],function (){

        Route::get('/','BrandsController@index')->name('admin.brands');
        Route::get('creat','BrandsController@creat')->name('admin.brands.creat');
        Route::post('store','BrandsController@store')->name('admin.brands.store');
        Route::get('edit/{id}','BrandsController@edit')->name('admin.brands.edit');
        Route::post('update/{id}','BrandsController@update')->name('admin.brands.update');
        Route::get('delete/{id}','BrandsController@delete')->name('admin.brands.delete');

    });




    Route::group(['prefix'=>'tags'],function (){

        Route::get('/','TagsController@index')->name('admin.tags');
        Route::get('creat','TagsController@creat')->name('admin.tags.creat');
        Route::post('store','TagsController@store')->name('admin.tags.store');
        Route::get('edit/{id}','TagsController@edit')->name('admin.tags.edit');
        Route::post('update/{id}','TagsController@update')->name('admin.tags.update');
        Route::get('delete/{id}','TagsController@delete')->name('admin.tags.delete');

    });



});


Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin','prefix'=>'admin'],function (){

   Route::get('login','loginController@login')->name('admin.login');
    Route::post('login','loginController@postLogin')->name('admin.post.login');

});


});
