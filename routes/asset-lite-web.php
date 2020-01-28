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

use App\Repositories\ProductCoreRepository;
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

    // CONFIG  ====================================
    Route::get('config', 'AssetLite\ConfigController@index');
    Route::put('config/update', 'AssetLite\ConfigController@update');

    // Priyojon Landing Page ====================================
    Route::get('priyojon/{id}/child-menu/create', 'AssetLite\PriyojonController@create');
    Route::resource('priyojon', 'AssetLite\PriyojonController')->only(['update','edit']);
    Route::get('priyojon/{id?}/{child_menu?}', 'AssetLite\PriyojonController@index');
//    Route::get('/menu-auto-save', 'AssetLite\MenuController@parentMenuSortable');
//    Route::get('menu/{parentId}/destroy/{id}', 'AssetLite\MenuController@destroy');

    // MENU  ====================================
    Route::get('menu/create', 'AssetLite\MenuController@create');
    Route::get('menu/{id}/child-menu/create', 'AssetLite\MenuController@create');
    Route::resource('menu', 'AssetLite\MenuController')->only(['update','edit','store']);
    Route::get('menu/{id?}/{child_menu?}', 'AssetLite\MenuController@index');
    Route::get('/menu-auto-save', 'AssetLite\MenuController@parentMenuSortable');
    Route::get('menu/{parentId}/destroy/{id}', 'AssetLite\MenuController@destroy');

    // FOOTER MENU  ====================================
    Route::get('footer-menu/{id}/child-footer/create', 'AssetLite\FooterMenuController@create');
    Route::resource('footer-menu', 'AssetLite\FooterMenuController')->only(['update','edit','store']);
    Route::get('footer-menu/{parentId}/destroy/{id}', 'AssetLite\FooterMenuController@destroy');
    Route::get('footer-menu/{parent_id?}/{child_footer?}', 'AssetLite\FooterMenuController@index');  // always put it last
    Route::get('sort-autosave/parent-footer-sort', 'AssetLite\FooterMenuController@FooterMenuSortable');


    // Route::group(['prefix' => 'footer-menu'], function () {
    //     // Route::get('/{id}/child-footer', 'AssetLite\FooterMenuController@index');
    //     Route::get('/{id}/child-footer/create', 'AssetLite\FooterMenuController@create');
    // });

    // QUICK LAUNCH  ====================================
    Route::prefix('quick-launch/{type}')->group(function () {
        Route::get('/', 'AssetLite\QuickLaunchController@index');
        Route::get('/create', 'AssetLite\QuickLaunchController@create');
        Route::post('/store', 'AssetLite\QuickLaunchController@store')->name('quick-launch.store');
        Route::get('/{id}/edit', 'AssetLite\QuickLaunchController@edit');
        Route::put('/{id}/update', 'AssetLite\QuickLaunchController@update')->name('quick-launch.update');
    });
    Route::get('quick-launch/{type}/destroy/{id}', 'AssetLite\QuickLaunchController@destroy');
    Route::get('/quick-launch-sortable', 'AssetLite\QuickLaunchController@quickLaunchSortable');

    // META TAG  ====================================
    Route::resource('meta-tag', 'AssetLite\MetaTagController');
    //Route::get('quick-launch/destroy/{id}', 'AssetLite\QuickLaunchController@destroy');
    //Route::get('/quick-launch-sortable','AssetLite\QuickLaunchController@quickLaunchSortable');


    // CONFIG  ====================================
    Route::get('config', 'AssetLite\ConfigController@index');
    Route::put('config/update', 'AssetLite\ConfigController@update');

    // SLIDERS  ====================================
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



    // OFFER CATEGORY  ===============================
    Route::resource('tag-category', 'AssetLite\TagCategoryController')->except(['show', 'destroy']);
    Route::get('tag-category/destroy/{id}', 'AssetLite\TagCategoryController@destroy');

    Route::resource('sim-categories', 'AssetLite\SimCategoryController')->only(['index']);

    Route::resource('duration-categories', 'AssetLite\DurationCategoryController')->except(['show', 'destroy']);
    Route::get('duration-category/destroy/{id}', 'AssetLite\DurationCategoryController@destroy');

    Route::resource('offer-categories', 'AssetLite\OfferCategoryController')->only(['index', 'edit', 'update']);
    Route::get('offer-categories/{parent_id}/{type}/edit/{id}', 'AssetLite\OfferCategoryController@childEdit');
    Route::put('offer-categories/{parent_id}/update/{id}', 'AssetLite\OfferCategoryController@childUpdate')
        ->name('child-category');


    // OFFER SUB MENU =====================================
    Route::get('offer-categories/{id}/{type}', 'AssetLite\OfferCategoryController@index')->name('child_menu');



    // OFFERS  ======================================
    Route::get('offers/{type}', 'AssetLite\ProductController@index')->name('product.list');
    Route::get('offers/{type}/create', 'AssetLite\ProductController@create')->name('product.create');
    Route::post('offers/{type}/store', 'AssetLite\ProductController@store')->name('product.store');
    Route::get('offers/{type}/{id}/edit/', 'AssetLite\ProductController@edit')->name('product.edit');
    Route::put('offers/{type}/{id}/update', 'AssetLite\ProductController@update')->name('product.update');
    Route::get('offers/{type}/{id}/show', 'AssetLite\ProductController@show')->name('product.show');

    Route::get('offers/{type}/{id}/{offerType}/details', 'AssetLite\ProductController@productDetailsEdit')
        ->name('product.details');
    Route::put('offers/{type}/{id}/details/update', 'AssetLite\ProductController@productDetailsUpdate')
        ->name('product.details-update');

    Route::get('offers/{type}/{id}', 'AssetLite\ProductController@destroy');
    Route::get('trending-home', 'AssetLite\ProductController@trendingOfferHome')->name('trending-home');
//    Route::get('trending-home/{id}/edit', 'AssetLite\ProductController@homeEdit');
    Route::get('trending-home/sortable', 'AssetLite\ProductController@trendingOfferSortable');


    // PARTNERS ====================================
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
    Route::get('campaign-offers', "AssetLite\PartnerOfferController@campaignOfferList")->name('campaign-offers.list');
    Route::get('campaign-offer/sortable', "AssetLite\PartnerOfferController@campaignOfferSortable");

    Route::get('partner-offers/{partner}/{id}/details', 'AssetLite\PartnerOfferController@offerDetailsEdit')
        ->name('offer.details');
    Route::put('partner-offers/{partner}/details/update', 'AssetLite\PartnerOfferController@offerDetailsUpdate')
        ->name('offer.details-update');

    // About Pages ================================
    Route::get('about-page/{slug}', 'AssetLite\PriyojonController@aboutPageView')->name('about-page');
    Route::put('about-page/update', 'AssetLite\PriyojonController@aboutPageUpdate')
        ->name('about-page.update');

//    Route::get('about-reward', 'AssetLite\PriyojonController@aboutRewardPoint')->name('about-reward');
//    Route::put('about-reward/update', 'AssetLite\PriyojonController@aboutRewardPointUpdate')
//        ->name('about-reward.update');

    //Route::get('/quick-launch-sortable','AssetLite\QuickLaunchController@quickLaunchSortable');

    // Product Core Mapping To Product
    Route::get('/core-product/entry', 'ProductEntryController@assetliteCoreProductForm');
    Route::post('/core-product/store', 'ProductEntryController@assetliteCoreProductStore')
        ->name('core-product-store');
    Route::get('/core-product/mapping/{offerType}', 'AssetLite\ProductController@coreDataMappingProduct')
        ->name('core-product-mapping');
    Route::get('product-core/match/{productCode}', 'AssetLite\ProductController@existProductCore')
        ->name('product-core/check');

    Route::get('product-details-update', 'AssetLite\ProductController@updateDetails');


    // Fixed  ====================================
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



    Route::get('/test/excel', function (\App\Services\ProductCoreService $service) {

        $service->mapDataFromExcel('/home/bs104/Desktop/product_sample.xlsx');
    });

    // Product core ============================================
    Route::get('product-core', 'AssetLite\ProductCoreController@index')->name('product.core.list');
    Route::get('product-core/{id}/edit/', 'AssetLite\ProductCoreController@edit')->name('product.core.edit');
});
