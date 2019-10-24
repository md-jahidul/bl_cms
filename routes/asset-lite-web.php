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
use Illuminate\Support\Facades\Route;

Auth::routes();

//Route::resource('sliders', 'AssetLite\SliderController');
//Route::get('slider/{parent_id}/images', 'AssetLite\SliderImageController@index');
//Route::get('slider-image/{id}/edit', 'AssetLite\SliderImageController@edit');

Route::get('/users/change-password', 'AssetLite\UserController@changePasswordForm');
Route::post('/users/password-update', 'AssetLite\UserController@changePassword')->name('password.update');

Route::middleware('authorize', 'auth')->group(function () {
    //Place all your routes here
    Route::resource('authorize/users', 'AssetLite\UserController')->except(['show']);

    Route::resource('authorize/roles', 'AssetLite\RolesController')->except(['show']);
    Route::get('authorize/permissions', 'AssetLite\PermissionsController@index');
    Route::post('authorize/permissions', 'AssetLite\PermissionsController@update');
    Route::post('authorize/permissions/getSelectedRoutes', 'AssetLite\PermissionsController@getSelectedRoutes');


    //Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

    // CONFIG PAGES ====================================
    Route::get('config', 'AssetLite\ConfigController@index');
    Route::put('config/update', 'AssetLite\ConfigController@update');

    // MENU PAGES ====================================
    Route::get('menu/{id}/child-menu/create', 'AssetLite\MenuController@create');
    Route::resource('menu', 'AssetLite\MenuController')->only(['update','edit','store']);
    Route::get('menu/{id?}/{child_menu?}', 'AssetLite\MenuController@index');
    Route::get('/menu-auto-save', 'AssetLite\MenuController@parentMenuSortable');
    Route::get('menu/{parentId}/destroy/{id}', 'AssetLite\MenuController@destroy');

    // FOOTER MENU PAGES ====================================
    Route::get('footer-menu/{id}/child-footer/create', 'AssetLite\FooterMenuController@create');
    Route::resource('footer-menu', 'AssetLite\FooterMenuController')->only(['update','edit','store']);
    Route::get('footer-menu/{parentId}/destroy/{id}', 'AssetLite\FooterMenuController@destroy');
    Route::get('footer-menu/{parent_id?}/{child_footer?}', 'AssetLite\FooterMenuController@index');  // always put it last
    Route::get('sort-autosave/parent-footer-sort', 'AssetLite\FooterMenuController@FooterMenuSortable');


    // Route::group(['prefix' => 'footer-menu'], function () {
    //     // Route::get('/{id}/child-footer', 'AssetLite\FooterMenuController@index');
    //     Route::get('/{id}/child-footer/create', 'AssetLite\FooterMenuController@create');
    // });

    // QUICK LAUNCH PAGES ====================================
    Route::resource('quick-launch', 'AssetLite\QuickLaunchController')->except(['show', 'destroy']);
    Route::get('quick-launch/destroy/{id}', 'AssetLite\QuickLaunchController@destroy');
    Route::get('/quick-launch-sortable', 'AssetLite\QuickLaunchController@quickLaunchSortable');

    // META TAG PAGES ====================================
    Route::resource('meta-tag', 'AssetLite\MetaTagController');
    //Route::get('quick-launch/destroy/{id}', 'AssetLite\QuickLaunchController@destroy');
    //Route::get('/quick-launch-sortable','AssetLite\QuickLaunchController@quickLaunchSortable');


    // CONFIG PAGES ====================================
    Route::get('config', 'AssetLite\ConfigController@index');
    Route::put('config/update', 'AssetLite\ConfigController@update');

    // SLIDERS PAGES ====================================
    Route::get('single-sliders', 'AssetLite\SliderController@singleSlider');
    Route::get('multiple-sliders', 'AssetLite\SliderController@multiSlider');
    Route::get('sliders/{id}/{type}/edit', 'AssetLite\SliderController@edit');
    Route::put('sliders/{id}/update', 'AssetLite\SliderController@update');
    Route::get('slider/{slider_id}/{type}', 'AssetLite\SliderImageController@index')->name('slider_images');
    Route::get('slider/{slider_id}/{type}/image/create', 'AssetLite\SliderImageController@create');
    Route::post('slider/{slider_id}/{type}/image/store', 'AssetLite\SliderImageController@store')
        ->name('slider_image_store');
    Route::get('slider/{slider_id}/{type}/image/{id}', 'AssetLite\SliderImageController@edit')
        ->name('slider_image_edit');
    Route::put('slider/{slider_id}/{type}/image/{id}/update', 'AssetLite\SliderImageController@update')
        ->name('slider_image_update');
    Route::get('slider/{slider_id}/{type}/image/destroy/{id}', 'AssetLite\SliderImageController@destroy');
    Route::get('/slider-image-sortable', 'AssetLite\SliderImageController@sliderImageSortable');



    // OFFER CATEGORY PAGES ====================================
    Route::resource('tag-category', 'AssetLite\TagCategoryController')->except(['show', 'destroy']);
    Route::get('tag-category/destroy/{id}', 'AssetLite\TagCategoryController@destroy');
    Route::resource('sim-categories', 'AssetLite\SimCategoryController')->only(['index']);
    Route::resource('duration-categories', 'AssetLite\DurationCategoryController')->only(['index']);
    Route::resource('offer-categories', 'AssetLite\OfferCategoryController')->only(['index']);



    // OFFERS PAGES ====================================
    Route::get('offers/{type}', 'AssetLite\ProductController@index')->name('product.list');
    Route::get('offers/{type}/create', 'AssetLite\ProductController@create')->name('product.create');
    Route::get('offers/{type}/store', 'AssetLite\ProductController@create')->name('product.store');



    // PARTNERS PAGES ====================================
    Route::resource('partners', 'AssetLite\PartnerController')->except(['show', 'destroy']);
    Route::get('partner/destroy/{id}', 'AssetLite\PartnerController@destroy');

    Route::get('partner-offer/{partner_id}/{type}', 'AssetLite\PartnerOfferController@index')->name('partner-offer');
    Route::get('partner-offer/{partner_id}/{partner}/offer/create', 'AssetLite\PartnerOfferController@create');
    Route::post('partner-offer/{partner_id}/{partner}/offer/store', 'AssetLite\PartnerOfferController@store')
        ->name('partner_offer_store');
    Route::get('partner-offer/{partner_id}/{partner}/offer/{id}/', 'AssetLite\PartnerOfferController@edit')
        ->name('partner_offer_edit');
    Route::put('partner-offer/{partner_id}/{partner}/offer/{id}/update/', 'AssetLite\PartnerOfferController@update')
        ->name('partner_offer_update');
    Route::get('partner-offer/{partner_id}/{partner}/offer/destroy/{id}', 'AssetLite\PartnerOfferController@destroy');
    Route::get('/partner-offer-home/sortable', 'AssetLite\PartnerOfferController@partnerOfferSortable');

    Route::get('partner-offers-home', 'AssetLite\PartnerOfferController@partnerOffersHome')->name('partner-offer-home');
    Route::get('/trending-home', 'AssetLite\ProductController@trendingOfferHome')->name('trending-home');
    //Route::get('/quick-launch-sortable','AssetLite\QuickLaunchController@quickLaunchSortable');


    // Fixed PAGES ====================================
    Route::get('fixed-pages', 'AssetLite\FixedPageController@index');
    Route::get('fixed-page/{id}/components', 'AssetLite\FixedPageController@components')->name('fixed-page-components');
    Route::get('fixed-pages/{id}/meta-tags', 'AssetLite\FixedPageController@metaTagsEdit')->name('fixed-page-metatags');
    Route::post('fixed-pages/{id}/meta-tag/{metaId}/update', 'AssetLite\FixedPageController@metaTagsUpdate');
    Route::get('fixed-pages/{pageId}/component/{componentId}', 'AssetLite\FixedPageController@fixedPageStatusUpdate')
        ->name('update-component-status');
    // Route::get('dynamic-pages', 'AssetLite\FixedPageController@index');

    Route::resource('questions', 'AssetLite\QuestionController');
//     Route::resource('prize', 'PrizeController');
//     Route::resource('tags', 'AssetLite\TagController');
//     Route::resource('campaigns','AssetLite\CampaignController');
//     Route::resource('prizes','AssetLite\PrizeController');

    Route::get('/home', 'AssetLite\HomeController@index')->name('home');
});
