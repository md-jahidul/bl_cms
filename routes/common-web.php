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
})->name('test');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['webAdmin']], function () {

    Route::get('/cms', 'CMS\TestCMSController@index');


    Route::resource('questions', 'CMS\QuestionController');
    Route::resource('prize', 'CMS\PrizeController');
    Route::resource('tags','CMS\TagController');

    // Route::resource('sliders', 'SliderController');
    // Route::resource('slider_image', 'SliderImageController');
    // Route::resource('questions', 'CMS\QuestionController');
    // // Route::resource('prize', 'PrizeController');
    // Route::resource('tags','TagController');

    Route::resource('campaigns','CMS\CampaignController');
    // Route::resource('prizes','CMS\PrizeController');
//Route::resource('sliders', 'SliderController');
//Route::get('slider/{parent_id}/images', 'CMS\SliderImageController@index');
//Route::get('slider-image/{id}/edit', 'CMS\SliderImageController@edit');




Route::resource('questions', 'CMS\QuestionController');
// Route::resource('prize', 'PrizeController');
Route::resource('tags','TagController');
Route::resource('campaigns','CMS\CampaignController');
// Route::resource('prizes','CMS\PrizeController');

});
