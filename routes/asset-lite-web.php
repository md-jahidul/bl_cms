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

//Route::resource('sliders', 'AssetLite\AlSliderController');
//Route::get('slider/{parent_id}/images', 'AssetLite\AlSliderImageController@index');
//Route::get('slider-image/{id}/edit', 'AssetLite\AlSliderImageController@edit');

Route::middleware('authorize')->group(function() {
    //Place all your routes here
    Route::resource('authorize/users', 'UserController');

    //Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

    // CONFIG PAGES ====================================
    Route::get('config','AssetLite\ConfigController@index');
    Route::put('config/update','AssetLite\ConfigController@update');


    // MENU PAGES ====================================
    Route::resource('menu','AssetLite\MenuController');
    Route::get('menu/{parentId}/destroy/{id}', 'AssetLite\MenuController@destroy');
    Route::get('/menu-auto-save','AssetLite\MenuController@parentMenuSortable');
    Route::group(['prefix' => 'menu'], function () {
        Route::get('/{id}/child-menu', 'AssetLite\MenuController@index');
        Route::get('/{id}/child-menu/create', 'AssetLite\MenuController@create');
    });

    // FOOTER MENU PAGES ====================================
    Route::resource('footer-menu','AssetLite\FooterMenuController');
    Route::get('footer-menu/{parentId}/destroy/{id}', 'AssetLite\FooterMenuController@destroy');
    Route::get('sort-autosave/parent-footer-sort','AssetLite\FooterMenuController@parentFooterSortable');
    Route::group(['prefix' => 'footer-menu'], function () {
        Route::get('/{id}/child-footer', 'AssetLite\FooterMenuController@index');
        Route::get('/{id}/child-footer/create', 'AssetLite\FooterMenuController@create');
    });

    // QUICK LAUNCH PAGES ====================================
    Route::resource('quick-launch','AssetLite\QuickLaunchController');
    Route::get('quick-launch/destroy/{id}', 'AssetLite\QuickLaunchController@destroy');
    Route::get('/quick-launch-sortable','AssetLite\QuickLaunchController@quickLaunchSortable');

    // META TAG PAGES ====================================
    Route::resource('meta-tag','AssetLite\MetaTagController');
    //Route::get('quick-launch/destroy/{id}', 'AssetLite\QuickLaunchController@destroy');
    //Route::get('/quick-launch-sortable','AssetLite\QuickLaunchController@quickLaunchSortable');


    // CONFIG PAGES ====================================
    Route::get('config','AssetLite\ConfigController@index');
    Route::put('config/update','AssetLite\ConfigController@update');

    // SLIDERS PAGES ====================================
    Route::get('single-sliders', 'AssetLite\AlSliderController@singleSlider');
    Route::get('multiple-sliders', 'AssetLite\AlSliderController@multiSlider');
    Route::get('sliders/{id}/{type}/edit', 'AssetLite\AlSliderController@edit');
    Route::put('sliders/{id}/update', 'AssetLite\AlSliderController@update');
    Route::get('slider/{slider_id}/{type}', 'AssetLite\AlSliderImageController@index')->name('slider_images');
    Route::get('slider/{slider_id}/{type}/image/create', 'AssetLite\AlSliderImageController@create');
    Route::post('slider/{slider_id}/{type}/image/store', 'AssetLite\AlSliderImageController@store')->name('slider_image_store');
    Route::get('slider/{slider_id}/{type}/image/{id}', 'AssetLite\AlSliderImageController@edit')->name('slider_image_edit');
    Route::put('slider/{slider_id}/{type}/image/{id}/update', 'AssetLite\AlSliderImageController@update')->name('slider_image_update');
    Route::get('slider/{slider_id}/{type}/image/destroy/{id}', 'AssetLite\AlSliderImageController@destroy');
    Route::get('/slider-image-sortable','AssetLite\AlSliderImageController@sliderImageSortable');

    // PARTNERS PAGES ====================================
    Route::resource('partners','AssetLite\PartnerController');
    Route::get('partner/destroy/{id}', 'AssetLite\PartnerController@destroy');

    Route::get('partner-offer/{partner_id}/{type}', 'AssetLite\PartnerOfferController@index')->name('partner-offer');
    Route::get('partner-offer/{partner_id}/{partner}/offer/create', 'AssetLite\PartnerOfferController@create');
    Route::post('partner-offer/{partner_id}/{partner}/offer/store', 'AssetLite\PartnerOfferController@store')->name('partner_offer_store');
    Route::get('partner-offer/{partner_id}/{partner}/offer/{id}/', 'AssetLite\PartnerOfferController@edit')->name('partner_offer_edit');
    Route::put('partner-offer/{partner_id}/{partner}/offer/{id}/update/', 'AssetLite\PartnerOfferController@update')->name('partner_offer_update');
    Route::get('partner-offer/{partner_id}/{partner}/offer/destroy/{id}', 'AssetLite\PartnerOfferController@destroy');
    Route::get('/partner-offer-home/sortable','AssetLite\PartnerOfferController@partnerOfferSortable');
    Route::get('partner-offers-home','AssetLite\PartnerOfferController@partnerOffersHome')->name('partner-offer-home');

    //Route::get('/quick-launch-sortable','AssetLite\QuickLaunchController@quickLaunchSortable');


    // Fixed PAGES ====================================
    Route::get('fixed-pages', 'AssetLite\FixedPageController@index');
    Route::get('fixed-page/{id}/components', 'AssetLite\FixedPageController@components')->name('fixed-page-components');
    Route::get('fixed-pages/{id}/meta-tags', 'AssetLite\FixedPageController@metaTagsEdit')->name('fixed-page-metatags');
    Route::post('fixed-pages/{id}/meta-tag/{metaId}/update', 'AssetLite\FixedPageController@metaTagsUpdate');
    Route::get('fixed-pages/{pageId}/component/{componentId}', 'AssetLite\FixedPageController@fixedPageStatusUpdate')->name('update-component-status');
    // Route::get('dynamic-pages', 'AssetLite\FixedPageController@index');



    Route::resource('questions', 'AssetLite\QuestionController');
//     Route::resource('prize', 'PrizeController');
    // Route::resource('tags','TagController');
//    Route::resource('campaigns','AssetLite\CampaignController');
//     Route::resource('prizes','AssetLite\PrizeController');

    Route::get('/home', 'AssetLite\HomeController@index')->name('home');
    //Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

});

/*

use Symfony\component\Finder\Finder;

Route::get('/b3-b4', function () {

    // dd( Config::get('view.paths') );
    // dd( app_path(), Config::get('view.paths.0') );
    $view_path = Config::get('view.paths');
    $routes_path = base_path().'/routes';
    $controller_path = app_path() . '/Http/Controllers/AssetLite';

    $files = Finder::create()
        ->in( $routes_path )
        ->name('*.php')
        ->contains('Asset Lite');

    // ->contains("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i");
    // ->contains('class="');
    // ->notName('*.rb');
    foreach ($files as $key => $file) {
        $content =  File::get( $file->getRealPath() );
        $update = str_replace('AssetLite', 'AssetLite', $content);
        File::put( $file->getRealPath() , $update );
    }
    echo "Count -->" . count($files);
});
*/
