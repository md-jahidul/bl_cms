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
    return view('admin.admin-auth.login');
});


Route::get('/cms', 'CMS\TestCMSController@index');

Route::resource('question', 'QuestionController');

Route::group(['prefix'=>'question'], function(){
    Route::get('/', ['uses' => 'QuestionController@index']);
    Route::get('/create', ['uses' => 'QuestionController@create']);
    Route::post('/store', ['uses' => 'QuestionController@store'])->name('question.store');
    Route::put('/update/{id}', ['uses' => 'QuestionController@update'])->name('question.update');
    Route::get('/edit/{id}', ['uses' => 'QuestionController@edit']);
});

Route::group(['prefix'=>'users'], function(){
    Route::get('/', ['uses' => 'Users\UserController@index']);
    Route::get('/store', ['uses' => 'Users\UserController@store'])->name('page.store');
    Route::delete('/destroy/{id}', ['uses' => 'Users\UserController@destroy'])->name('page.destroy');
    Route::put('/update/{id}', ['uses' => 'Users\UserController@update'])->name('page.update');
});


Route::group(['prefix'=>'page-builder'], function(){
    Route::get('/', ['middleware' => 'cross', 'uses' => 'API\PageBuilderApiController@index']);
    Route::get('/store', ['uses' => 'API\PageBuilderApiController@store'])->name('page.store');
});


Route::resource('sliders','SliderController');
Route::resource('slider_image','SliderImageController');
Route::get('slider_image/destroy/{id}','SliderImageController@destroy');


Route::resource('page','PageBuilderController');

Route::resource('campaign','CampaignController');
Route::resource('prize','PrizeController');
Route::resource('tag','TagController');
Route::resource('digital_service','DigitalServiceController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
