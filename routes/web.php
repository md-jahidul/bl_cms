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


Route::get('/cms', 'CMS\TestCMSController@index');

Route::resource('sliders', 'SliderController');
Route::resource('slider_image', 'SliderImageController');

Route::resource('questions', 'CMS\QuestionController');
Route::resource('prize', 'PrizeController');
Route::resource('tags','TagController');
Route::resource('campaigns','CMS\CampaignController');
Route::resource('prizes','CMS\PrizeController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


// myBL-routs
route::resource('short_cuts','CMS\ShortCutController');
route::resource('UserShortcut','CMS\UserShortcutController');
route::resource('slider','CMS\SliderController');
Route::get('slider/destroy/{id}','CMS\SliderController@destroy');

route::resource('sliderImage','CMS\SliderImageController');
Route::get('slider/addImage/{sliderId}','CMS\SliderImageController@index')->name('sliderImage.index');

route::resource('banner','CMS\BannerController');
Route::get('banner/destroy/{id}','CMS\BannerController@destroy');

route::resource('welcome_info','CMS\WelcomeInfoController');


Route::put('short_cuts/SerialUpdate/{id}','CMS\UserShortcutController@serialUpdate')->name('serial.update');
Route::get('short_cuts/destroy/{id}','CMS\ShortCutController@destroy');
// myBL-routs
