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

// Route::resource('sliders', 'CMS\SliderController');
Route::resource('slider_image', 'CMS\SliderImageController');

Route::resource('questions', 'CMS\QuestionController');
Route::resource('prize', 'CMS\PrizeController');
Route::resource('tags','CMS\TagController');
Route::resource('campaigns','CMS\CampaignController');
Route::resource('prizes','CMS\PrizeController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//------------------------------- ********** ------------------------------------//
//------------------------------- myBL-routs ------------------------------------//
//------------------------------- ********** ------------------------------------//

// shortcuts
route::resource('short_cuts','CMS\ShortCutController');
route::resource('UserShortcut','CMS\UserShortcutController');
Route::put('short_cuts/SerialUpdate/{id}','CMS\UserShortcutController@serialUpdate')->name('serial.update');
Route::get('short_cuts/destroy/{id}','CMS\ShortCutController@destroy');

// Banner
route::resource('banner','CMS\BannerController');
Route::get('banner/destroy/{id}','CMS\BannerController@destroy');

// welcomeInfo
route::resource('wellcomeInfo','CMS\WellcomeInfoController');

//settings 
route::resource('setting','CMS\SettingController');
Route::get('setting_limit/store','CMS\SettingController@Addlimit');
Route::get('setting/destroy/{id}','CMS\SettingController@destroy')->name('setting.destroy');


//------ Slider -----------//

// Slider
route::resource('slider','CMS\SliderController');
Route::get('slider/destroy/{id}','CMS\SliderController@destroy');
Route::get('slider/edit/{slider}','CMS\SliderController@edit')->name('slider.edit');
// Slider

// Slider Image
route::resource('sliderImage','CMS\SliderImageController');
route::get('sliderImage/addImage/update-position','CMS\SliderImageController@updatePosition');
Route::get('slider/addImage/{sliderId}','CMS\SliderImageController@index')->name('sliderImage.index');
// Slider Image

//------ Slider -----------//




//------------------------------- ********** ------------------------------------//
//------------------------------- myBL-routs ------------------------------------//
//------------------------------- ********** ------------------------------------//
