<?php

/*
|--------------------------------------------------------------------------
| Web Routes for MY BL
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




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
    route::resource('welcomeInfo','CMS\WelcomeInfoController');

    //settings
    route::resource('setting','CMS\SettingController');
    Route::get('setting_limit/store','CMS\SettingController@Addlimit');
    Route::get('setting/destroy/{id}','CMS\SettingController@destroy')->name('setting.destroy');


    //------ Slider -----------//

    // Slider
    route::resource('myblslider','CMS\MyblSliderController');
    Route::get('myblslider/destroy/{id}','CMS\MyblSliderController@destroy');
    Route::get('myblslider/edit/{slider-other-attr}','CMS\MyblSliderController@edit')->name('slider-other-attr.edit');
    // Slider

    // Slider Image
    route::resource('myblsliderImage','CMS\MyblSliderImageController');
    route::get('myblsliderImage/addImage/update-position','CMS\MyblSliderImageController@updatePosition');
    Route::get('myblslider/addImage/{sliderId}','CMS\MyblSliderImageController@index')->name('myblsliderImage.index');
    // Slider Image


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


    // Amar Offer
    route::resource('amarOffer','CMS\AmarOfferController');
    Route::get('amarOffer/destroy/{id}','CMS\AmarOfferController@destroy');


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

    // Notifiaction Categorie
    route::resource('notifiactionCategorie','CMS\NotifiactionCategorieController');
    Route::get('notifiactionCategorie/destroy/{id}','CMS\NotifiactionCategorieController@destroy');

    // Notifiaction
    route::resource('notifiaction','CMS\NotifiactionController');
    Route::get('notifiaction/destroy/{id}','CMS\NotifiactionController@destroy');

});





