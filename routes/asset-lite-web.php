<?php

/*
|--------------------------------------------------------------------------
| Web Routes  for Asset Lite
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

//Route::resource('sliders', 'CMS\AlSliderController');
//Route::get('slider/{parent_id}/images', 'CMS\AlSliderImageController@index');
//Route::get('slider-image/{id}/edit', 'CMS\AlSliderImageController@edit');

Route::middleware('authorize')->group(function() {
    //Place all your routes here

//Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

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

// META TAG PAGES ====================================
Route::resource('meta-tag','CMS\MetaTagController');
//Route::get('quick-launch/destroy/{id}', 'CMS\QuickLaunchController@destroy');
//Route::get('/quick-launch-sortable','CMS\QuickLaunchController@quickLaunchSortable');


// CONFIG PAGES ====================================
Route::get('config','CMS\ConfigController@index');
Route::put('config/update','CMS\ConfigController@update');

// SLIDERS PAGES ====================================
Route::get('single-sliders', 'CMS\AlSliderController@singleSlider');
Route::get('multiple-sliders', 'CMS\AlSliderController@multiSlider');
Route::get('sliders/{id}/{type}/edit', 'CMS\AlSliderController@edit');
Route::put('sliders/{id}/update', 'CMS\AlSliderController@update');
Route::get('slider/{slider_id}/{type}', 'CMS\AlSliderImageController@index')->name('slider_images');
Route::get('slider/{slider_id}/{type}/image/create', 'CMS\AlSliderImageController@create');
Route::post('slider/{slider_id}/{type}/image/store', 'CMS\AlSliderImageController@store')->name('slider_image_store');
Route::get('slider/{slider_id}/{type}/image/{id}', 'CMS\AlSliderImageController@edit')->name('slider_image_edit');
Route::put('slider/{slider_id}/{type}/image/{id}/update', 'CMS\AlSliderImageController@update')->name('slider_image_update');
Route::get('slider/{slider_id}/{type}/image/destroy/{id}', 'CMS\AlSliderImageController@destroy');
Route::get('/slider-image-sortable','CMS\AlSliderImageController@sliderImageSortable');

// PARTNERS PAGES ====================================
Route::resource('partners','CMS\PartnerController');
Route::get('partner/destroy/{id}', 'CMS\PartnerController@destroy');

Route::get('partner-offer/{partner_id}/{type}', 'CMS\PartnerOfferController@index')->name('partner-offer');
Route::get('partner-offer/{partner_id}/{partner}/offer/create', 'CMS\PartnerOfferController@create');
Route::post('partner-offer/{partner_id}/{partner}/offer/store', 'CMS\PartnerOfferController@store')->name('partner_offer_store');
Route::get('partner-offer/{partner_id}/{partner}/offer/{id}/', 'CMS\PartnerOfferController@edit')->name('partner_offer_edit');
Route::put('partner-offer/{partner_id}/{partner}/offer/{id}/update/', 'CMS\PartnerOfferController@update')->name('partner_offer_update');
Route::get('partner-offer/{partner_id}/{partner}/offer/destroy/{id}', 'CMS\PartnerOfferController@destroy');
Route::get('/partner-offer-home/sortable','CMS\PartnerOfferController@partnerOfferSortable');
Route::get('partner-offers-home','CMS\PartnerOfferController@partnerOffersHome')->name('partner-offer-home');

//Route::get('/quick-launch-sortable','CMS\QuickLaunchController@quickLaunchSortable');


// Fixed PAGES ====================================
Route::get('fixed-pages', 'CMS\FixedPageController@index');
Route::get('fixed-page/{id}/components', 'CMS\FixedPageController@components')->name('fixed-page-components');
Route::get('fixed-pages/{id}/meta-tags', 'CMS\FixedPageController@metaTagsEdit')->name('fixed-page-metatags');
Route::post('fixed-pages/{id}/meta-tag/{metaId}/update', 'CMS\FixedPageController@metaTagsUpdate');
Route::get('fixed-pages/{pageId}/component/{componentId}', 'CMS\FixedPageController@fixedPageStatusUpdate')->name('update-component-status');
// Route::get('dynamic-pages', 'CMS\FixedPageController@index');



Route::resource('questions', 'CMS\QuestionController');
// Route::resource('prize', 'PrizeController');
// Route::resource('tags','TagController');
Route::resource('campaigns','CMS\CampaignController');
// Route::resource('prizes','CMS\PrizeController');

Route::get('/home', 'CMS\HomeController@index')->name('home');
//Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');



});

