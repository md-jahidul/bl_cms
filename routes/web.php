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


    Route::resource('sliders', 'CMS\SliderController');
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
//Route::resource('sliders', 'SliderController');
//Route::get('slider/{parent_id}/images', 'CMS\SliderImageController@index');
//Route::get('slider-image/{id}/edit', 'CMS\SliderImageController@edit');




Route::resource('questions', 'CMS\QuestionController');
// Route::resource('prize', 'PrizeController');
Route::resource('tags','TagController');
Route::resource('campaigns','CMS\CampaignController');
// Route::resource('prizes','CMS\PrizeController');

});


//------------------------------- ********** ------------------------------------//
//------------------------------- myBL-routs ------------------------------------//
//------------------------------- ********** ------------------------------------//
Route::group(['middleware' => ['appAdmin']], function () {

    //------ shortcuts -----------//

    // route::resource('short_cuts','CMS\ShortCutController');
    // route::resource('UserShortcut','CMS\UserShortcutController');

    //shortcuts
    Route::put('shortcuts/SerialUpdate/{id}','CMS\UserShortcutController@serialUpdate')->name('serial.update');
    Route::get('shortcuts/destroy/{id}','CMS\ShortCutController@destroy');

    Route::get('shortcuts','CMS\ShortCutController@index')->name('short_cuts.index');
    Route::post('shortcuts','CMS\ShortCutController@store')->name('short_cuts.store');
    Route::get('shortcuts/create','CMS\ShortCutController@create')->name('short_cuts.create');
    Route::get('shortcuts/{short_cut}/edit','CMS\ShortCutController@edit')->name('short_cuts.edit');
    Route::put('shortcuts/{short_cut}','CMS\ShortCutController@update')->name('short_cuts.update');

    //------ shortcuts -----------//


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
    route::resource('myblslider','CMS\MyblSliderController');
    Route::get('myblslider/destroy/{id}','CMS\MyblSliderController@destroy');
    Route::get('myblslider/edit/{slider}','CMS\MyblSliderController@edit')->name('slider.edit');
    // Slider

    // Slider Image
    route::resource('myblsliderImage','CMS\MyblSliderImageController');
    route::get('myblsliderImage/addImage/update-position','CMS\MyblSliderImageController@updatePosition');
    Route::get('myblslider/addImage/{sliderId}','CMS\MyblSliderImageController@index')->name('myblsliderImage.index');
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
    Route::get('help_Center/update-position','CMS\HelpCenterController@changeSequece');

    // contextual cards
    route::resource('contextualcard','CMS\ContextualCardController');
    Route::get('card/destroy/{id}','CMS\ContextualCardController@destroy');

});


//------------------------------- ********** ------------------------------------//
//------------------------------- myBL-routs ------------------------------------//
//------------------------------- ********** ------------------------------------//



Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

// CONFIG PAGES ====================================
Route::get('config','CMS\ConfigController@index');
Route::put('config/update','CMS\ConfigController@update');

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
Route::group(['prefix' => 'footer-menu'], function () {
    Route::get('/{id}/child-footer', 'CMS\FooterMenuController@index');
    Route::get('/{id}/child-footer/create', 'CMS\FooterMenuController@create');
});

// QUICK LAUNCH PAGES ====================================
Route::resource('quick-launch','CMS\QuickLaunchController');
Route::get('quick-launch/destroy/{id}', 'CMS\QuickLaunchController@destroy');
Route::get('/quick-launch-sortable','CMS\QuickLaunchController@quickLaunchSortable');


// CONFIG PAGES ====================================
Route::get('config','CMS\ConfigController@index');
Route::put('config/update','CMS\ConfigController@update');

// SLIDERS PAGES ====================================
Route::get('sliders', 'SliderController@index');
Route::get('slider/{slider_id}/{type}', 'CMS\SliderImageController@index')->name('slider_images');
Route::get('slider/{slider_id}/{type}/image/create', 'CMS\SliderImageController@create');
Route::post('slider/{slider_id}/{type}/image/store', 'CMS\SliderImageController@store')->name('slider_image_store');
Route::get('slider/{slider_id}/{type}/image/{id}', 'CMS\SliderImageController@edit')->name('slider_image_edit');
Route::put('slider/{slider_id}/{type}/image/{id}/update', 'CMS\SliderImageController@update')->name('slider_image_update');
Route::get('slider/{slider_id}/{type}/image/destroy/{id}', 'CMS\SliderImageController@destroy');
Route::get('/slider-image-sortable','CMS\SliderImageController@sliderImageSortable');




// PARTNERS PAGES ====================================
Route::resource('partners','CMS\PartnerController');
Route::get('partner/destroy/{id}', 'CMS\PartnerController@destroy');
//Route::get('/quick-launch-sortable','CMS\QuickLaunchController@quickLaunchSortable');




Route::resource('questions', 'CMS\QuestionController');
// Route::resource('prize', 'PrizeController');
Route::resource('tags','TagController');
Route::resource('campaigns','CMS\CampaignController');
// Route::resource('prizes','CMS\PrizeController');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');


