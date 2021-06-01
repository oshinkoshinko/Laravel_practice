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

use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});
//TestControllerのindexへアクセス
Route::get('tests/test', 'TestController@index');

//ログインユーザのみルーティング
Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function(){
    //ContactFormControllerのindexへアクセス
    Route::get('index', 'ContactFormController@index')->name('contact.index');
    Route::get('create', 'ContactFormController@create')->name('contact.create');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
