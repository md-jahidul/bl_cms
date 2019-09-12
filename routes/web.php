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


Route::get('/cms', 'CMS\TestCMSController@index');


// Route::resource('sliders', 'CMS\SliderController');
Route::resource('slider_image', 'CMS\SliderImageController');

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

//------ offers -----------//
// minute 
route::resource('minuteOffer','CMS\MinuteOfferController');
Route::get('minuteOffer/destroy/{id}','CMS\MinuteOfferController@destroy');

// sms offer
route::resource('smsOffer','CMS\SmsOfferController');
Route::get('smsOffer/destroy/{id}','CMS\SmsOfferController@destroy');

// internet
route::resource('internetOffer','CMS\InternetOfferController');
Route::get('internetOffer/destroy/{id}','CMS\InternetOfferController@destroy');

// Mixed Bundle
route::resource('mixedBundleOffer','CMS\MixedBundleOfferController');
Route::get('mixedBundleOffer/destroy/{id}','CMS\MixedBundleOfferController@destroy');

// Near By Offer
route::resource('nearByOffer','CMS\NearbyOfferController');
Route::get('nearByOffer/destroy/{id}','CMS\NearbyOfferController@destroy');

//------ offers -----------//

// ussd code
route::resource('ussd','CMS\UssdController');
Route::get('ussd/destroy/{id}','CMS\UssdController@destroy');

// help center
route::resource('helpCenter','CMS\HelpCenterController');
Route::get('helpCenter/destroy/{id}','CMS\HelpCenterController@destroy');




//------------------------------- ********** ------------------------------------//
//------------------------------- myBL-routs ------------------------------------//
//------------------------------- ********** ------------------------------------//
Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');


// MENU PAGES ====================================
Route::resource('menu','CMS\MenuController');
Route::get('menu/{parentId}/destroy/{id}', 'CMS\MenuController@destroy');
Route::get('/menu-auto-save','CMS\MenuController@parentMenuSortable');
Route::group(['prefix' => 'menu'], function () {
    Route::get('/{id}/child-menu', 'CMS\MenuController@index');
    Route::get('/{id}/child-menu/create', 'CMS\MenuController@create');
});

// FOOTER MENU PAGES ====================================
Route::resource('footer-menu','CMS\FooterMenuController');
Route::get('footer-menu/{parentId}/destroy/{id}', 'CMS\FooterMenuController@destroy');
Route::get('sort-autosave/parent-footer-sort','CMS\FooterMenuController@parentFooterSortable');

// QUICK LAUNCH PAGES ====================================
Route::resource('quick-launch','CMS\QuickLaunchController');
Route::get('quick-launch/destroy/{id}', 'CMS\QuickLaunchController@destroy');
//Route::get('sort-autosave/parent-footer-sort','CMS\QuickLaunchController@parentFooterSortable');

Route::group(['prefix' => 'footer-menu'], function () {
    Route::get('/{id}/child-footer', 'CMS\FooterMenuController@index');
    Route::get('/{id}/child-footer/create', 'CMS\FooterMenuController@create');
});


//Route::get('quick-launch-panel', 'CMS\QuickLaunchController@index');
