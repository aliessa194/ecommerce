<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/test', function (){

    $cat= \App\Models\Category::find(20);
    $cat->makeVisible(['translations']);
    return $cat;
});

Auth::routes();

Route::get('/dd',function (){
    return view('front.home');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


