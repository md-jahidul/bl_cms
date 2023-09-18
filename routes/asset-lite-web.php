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
//Route::group(['middleware' => ['auth','CheckFistLogin']], function () {
Route::middleware('authorize', 'auth', 'CheckFistLogin')->group(function () {
    # Al Banner =========================================================
    Route::resource('al-banner', 'AssetLite\AlBannerController')->except('show');
    Route::get('al-banner/destroy/{id}', 'AssetLite\AlBannerController@destroy');


    // Explore C's =========================================================
    Route::resource('explore-c', 'AssetLite\ExploreCController');
    Route::get('explore-c/destroy/{id}', 'AssetLite\ExploreCController@destroy');
    Route::get('explore-c-sort', 'AssetLite\ExploreCController@exploreCSortable');

    Route::get('explore-c-pages/', 'AssetLite\ExploreCDetailsController@pageList');
    Route::get('explore-c-pages/create', 'AssetLite\ExploreCDetailsController@create');
    Route::get('explore-c-pages/edit/{id}', 'AssetLite\ExploreCDetailsController@edit');
    Route::post('explore-c-pages/save', 'AssetLite\ExploreCDetailsController@savePage');
    Route::get('explore-c-pages/delete/{id}', 'AssetLite\ExploreCDetailsController@deletePage');

    Route::get('explore-c-component/{explore_c_id}/list', 'AssetLite\ExploreCDetailsController@index')
        ->name('explore-c-component.list');
    Route::get('explore-c-component/create', 'AssetLite\ExploreCDetailsController@componentCreate')
        ->name('explore-c-component.create');
    Route::post('explore-c-component/store', 'AssetLite\ExploreCDetailsController@componentStore')
        ->name('explore-c-component.store');
    Route::get('explore-c-component/edit/{comId}', 'AssetLite\ExploreCDetailsController@componentEdit')
        ->name('explore-c-component.edit');
    Route::post('explore-c-component/update/{comId}', 'AssetLite\ExploreCDetailsController@componentUpdate')
        ->name('explore-c-component.update');
    Route::get('explore-c-component/destroy/{comId}', 'AssetLite\ExploreCDetailsController@componentDestroy')
        ->name('explore-c-component.destroy');
    Route::get('explore-c-component-sort', 'AssetLite\ExploreCDetailsController@componentSortable');


    //Place all your routes here
    Route::resource('authorize/users', 'AssetLite\UserController')->except(['show']);

    Route::resource('authorize/roles', 'AssetLite\RolesController')->except(['show']);
    Route::get('authorize/permissions', 'AssetLite\PermissionsController@index');
    Route::post('authorize/permissions', 'AssetLite\PermissionsController@update');
    Route::post('authorize/permissions/getSelectedRoutes', 'AssetLite\PermissionsController@getSelectedRoutes');


    //Route::get('/get-digital-service', 'API\DigitalServiceController@getDigitalServices');

    // CONFIG  ====================================
    Route::get('config', 'AssetLite\ConfigController@index');
    Route::post('config/update', 'AssetLite\ConfigController@update');

    // Priyojon Landing Page ====================================
    Route::resource('lms-offer-category', 'AssetLite\LmsOfferCategoryController')->except('show', 'destroy');
    Route::get('lms-offer-category/destroy/{id}', 'AssetLite\LmsOfferCategoryController@destroy');

    Route::get('priyojon/{id}/child-menu/create', 'AssetLite\PriyojonController@create');
    Route::resource('priyojon', 'AssetLite\PriyojonController')->only(['create', 'store', 'update', 'edit']);
    Route::get('priyojon/{id?}/{child_menu?}', 'AssetLite\PriyojonController@index');
//    Route::get('priyojon/{id?}/create', 'AssetLite\PriyojonController@create');
    Route::post('priyojon-landing-page-banner/{id}', 'AssetLite\PriyojonController@landingPageBanner')
        ->name('priyojon.banner');
//    Route::get('/menu-auto-save', 'AssetLite\MenuController@parentMenuSortable');
    Route::get('priyojon/{parentId}/destroy/{id}', 'AssetLite\PriyojonController@destroyMenu');

    // MENU  ====================================
    Route::get('menu/create', 'AssetLite\MenuController@create');
    Route::get('menu/{id}/child-menu/create', 'AssetLite\MenuController@create');
    Route::resource('menu', 'AssetLite\MenuController')->only(['update', 'edit', 'store']);
    Route::get('menu/{id?}/{child_menu?}', 'AssetLite\MenuController@index');
    Route::get('/menu-auto-save', 'AssetLite\MenuController@parentMenuSortable');
    Route::get('menu/{parentId}/destroy/{id}', 'AssetLite\MenuController@destroy');

    // FOOTER MENU  ====================================
    Route::get('footer-menu/{id}/child-footer/create', 'AssetLite\FooterMenuController@create');
    Route::resource('footer-menu', 'AssetLite\FooterMenuController')->only(['update', 'edit', 'store']);
    Route::get('footer-menu/{parentId}/destroy/{id}', 'AssetLite\FooterMenuController@destroy');
    Route::get('footer-menu/{parent_id?}/{child_footer?}',
        'AssetLite\FooterMenuController@index');  // always put it last
    Route::get('sort-autosave/parent-footer-sort', 'AssetLite\FooterMenuController@FooterMenuSortable');

    Route::resource('sub-footer', 'AssetLite\SubFooterController');
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


    // About Us  ====================================
    Route::resource('about-us', 'AssetLite\AboutUsController')->except(['show', 'destroy']);
    Route::get('about-us/slider/{sliderId}/{type}', 'AssetLite\AboutUsController@sliderImageList')
        ->name('about_image_list');

    Route::get('about-us/slider-image/{sliderId}/{type}/create', 'AssetLite\AboutUsController@createSliderImage')
        ->name('about_image_create');

    Route::post('about-us/slider-image/{sliderId}/{type}/store', 'AssetLite\AboutUsController@storeSliderImage')
        ->name('about_image_store');

    Route::get('about-us/slider-image/{sliderId}/{type}/edit/{id}', 'AssetLite\AboutUsController@editSliderImage')
        ->name('about_image_edit');

    Route::post('about-us/slider-image/{sliderId}/{type}/update/{id}', 'AssetLite\AboutUsController@updateSliderImage')
        ->name('about_image_update');

    Route::get('about-us/slider-image/{sliderId}/{type}/destroy/{id}', 'AssetLite\AboutUsController@destroySliderImage')
        ->name('about_image_destroy');


    Route::get('about-us/destroy/{id}', 'AssetLite\AboutUsController@destroy');

    Route::get('about-slider/', 'AssetLite\AboutUsController@aboutSlider');

    Route::resource('management', 'AssetLite\ManagementController')->except(['show', 'destroy']);
    Route::get('management/destroy/{id}', 'AssetLite\ManagementController@destroy');
    Route::get('management-sortable', 'AssetLite\ManagementController@managementSortable');
    Route::post('management-component', 'AssetLite\ManagementController@managementComponentSave');

    Route::resource('about-career', 'AssetLite\AboutEcareerController')->except(['show', 'destroy']);
    Route::get('about-career-item/{careerId}', 'AssetLite\AboutEcareerItemController@index')
        ->name('career-item.list');

    Route::get('about-career-item/{careerId}/create', 'AssetLite\AboutEcareerItemController@create')
        ->name('career-item.create');

    Route::post('about-career-item/{careerId}/store', 'AssetLite\AboutEcareerItemController@store')
        ->name('career-item.store');

    Route::get('about-career-item/{careerId}/edit/{id}', 'AssetLite\AboutEcareerItemController@edit')
        ->name('career-item.edit');

    Route::post('about-career-item/{careerId}/update/{id}', 'AssetLite\AboutEcareerItemController@update')
        ->name('career-item.update');

    Route::get('about-career-item/{careerId}/destroy/{id}', 'AssetLite\AboutEcareerItemController@destroy');

    Route::get('about-us-career-sortable', 'AssetLite\AboutEcareerItemController@aboutUsCareerSortable');


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
    Route::post('slider/{slider_id}/{type}/image/{id}/update', 'AssetLite\SliderImageController@update')
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

    /**
     * Dynamic URL Redirection Routes
     */
    Route::resource('dynamic-url-redirection', 'AssetLite\DynamicUrlRedirectionController')->except([
        'show',
        'destroy'
    ]);
    Route::get('dynamic-url-redirection/toggle-status/{id}/{status}',
        'AssetLite\DynamicUrlRedirectionController@toggleStatus')->name('dynamic-url-redirection.toggle-status');

    // OFFER SUB MENU =====================================
    Route::get('offer-categories/{id}/{type}', 'AssetLite\OfferCategoryController@index')->name('child_menu');


    // Product Offers  ======================================
    Route::get('update-search-datatable', 'AssetLite\ProductController@updateSearchDataTable');

    Route::get('offers/{type}', 'AssetLite\ProductController@index')->name('product.list');
    Route::get('offers/{type}/create', 'AssetLite\ProductController@create')->name('product.create');
    Route::post('offers/{type}/store', 'AssetLite\ProductController@store')->name('product.store');
    Route::get('offers/{type}/{id}/edit/', 'AssetLite\ProductController@edit')->name('product.edit');
    Route::put('offers/{type}/{id}/update', 'AssetLite\ProductController@update')->name('product.update');
    Route::get('offers/{type}/{id}/show', 'AssetLite\ProductController@show')->name('product.show');
    Route::get('al-product-category-sync', 'AssetLite\ProductController@uploadExcel')->name('excel.upload');
    Route::post('al-product-category-sync', 'AssetLite\ProductController@uploadProductCodeAndSlugByExcel')->name('al-product-category-sync');
    Route::post('package/related-product/store', 'AssetLite\ProductController@packageRelatedProductStore');

    // al internet offer category
    Route::get('al-internet-offer-category', 'AssetLite\AlInternetOffersCategoryController@index')->name('al-internet-offer-category');
    Route::POST('al-internet-offer-category', 'AssetLite\AlInternetOffersCategoryController@saveSortFilter')->name('al-internet-offer-category.store');
    Route::get('al-internet-offer-category/create', 'AssetLite\AlInternetOffersCategoryController@create')->name('al.internetOffer.category.create');
    Route::get('al-internet-offer-category/edit/{id}', 'AssetLite\AlInternetOffersCategoryController@edit')->name('al.internetOffer.category.edit');
    Route::put('al-internet-offer-category/update/{id}', 'AssetLite\AlInternetOffersCategoryController@update')->name('al.internetOffer.category.update');
    Route::get('al-internet-offer-category/delete/{id}', 'AssetLite\AlInternetOffersCategoryController@destroy')->name('al.internetOffer.category.delete');

    // Product Offers Details  ======================================
    Route::get('offers/{type}/{id}/{offerType}/details', 'AssetLite\ProductController@productDetailsEdit')
        ->name('product.details');
    Route::put('offers/{type}/{id}/details/update', 'AssetLite\ProductController@productDetailsUpdate')
        ->name('product.details-update');

    Route::post('product-details/{simType}/{productId}/banner-image/related-product',
        'AssetLite\ProductDetailsController@bannerImgRelatedPro')
        ->name('bannerImg-relatedPro');

    Route::get('product-details/{simType}/{productDetailsId}/section', 'AssetLite\ProductDetailsController@sectionList')
        ->name('section-list');

    Route::get('product-details/{type}/{productDetailsId}/section-create', 'AssetLite\ProductDetailsController@create')
        ->name('section-create');

    Route::post('product-details/{simType}/{productDetailsId}/section-store',
        'AssetLite\ProductDetailsController@storeSection')
        ->name('section-store');

    Route::get('product-details/{simType}/{productDetailsId}/section-edit/{id}',
        'AssetLite\ProductDetailsController@editSection')
        ->name('section-edit');

    Route::post('product-details/{simType}/{productDetailsId}/section-update/{id}',
        'AssetLite\ProductDetailsController@updateSection')
        ->name('section-update');

    Route::get('product-details/{simType}/{productDetailsId}/section-delete/{id}',
        'AssetLite\ProductDetailsController@sectionDestroy')
        ->name('section-destroy');

    Route::get('product-details/section-sortable', 'AssetLite\ProductDetailsController@sectionSortable');

    Route::get(
        'product-details/{simType}/{productDetailsId}/section/{sid}/components-list',
        'AssetLite\ProductDetailsController@componentList'
    )->name('component-list');


    Route::get(
        'product-details/{simType}/{productDetailsId}/section/{SectionId}/components-create',
        'AssetLite\ProductDetailsController@componentCreate'
    )->name('component-create');

    Route::post('product-details/{simType}/{productDetailsId}/components-store/{SectionId}',
        'AssetLite\ProductDetailsController@componentStore')
        ->name('component-store');

    Route::get(
        'product-details/{simType}/{productDetailsId}/section/{sid}/component/{id}/edit',
        'AssetLite\ProductDetailsController@componentEdit'
    )->name('component-edit');

    Route::put('product-details/{simType}/{productDetailsId}/section/{sid}/component/{id}/update',
        'AssetLite\ProductDetailsController@componentUpdate')
        ->name('component-update');

    Route::get('product-details/{simType}/{productDetailsId}/section/{sid}/component/{id}/delete',
        'AssetLite\ProductDetailsController@componentDestroy')
        ->name('component-delete');

    Route::get('component-sortable', 'AssetLite\ProductDetailsController@componentSortable');

    Route::get('offers/{type}/{id}', 'AssetLite\ProductController@destroy');
    Route::get('trending-home', 'AssetLite\ProductController@trendingOfferHome')->name('trending-home');
//    Route::get('trending-home/{id}/edit', 'AssetLite\ProductController@homeEdit');
    Route::get('trending-home/sortable', 'AssetLite\ProductController@trendingOfferSortable');

    //business
    Route::get('business-home', 'AssetLite\ProductController@trendingOfferHome')->name('business-home');
    //amar offer details......
    Route::get('amaroffer/details', 'AssetLite\AmarOfferController@amarOfferDetails')->name('amaroffer.list');
    Route::post('amaroffer/banner-image/upload', 'AssetLite\AmarOfferController@bannerImageUpload')
        ->name('banner-image-upload');
    Route::get('amaroffer/edit/{type}', 'AssetLite\AmarOfferController@edit')->name('amaroffer.edit');
    Route::put('amaroffer/update/{type}', 'AssetLite\AmarOfferController@update')->name('amaroffer.update');

    // Device offers
    Route::get('device-offer', 'AssetLite\DeviceOfferController@index');
    Route::post('device-offer-list', 'AssetLite\DeviceOfferController@deviceOfferList')
        ->name('deviceoffer.list.ajax');

    Route::post('upload-device-offer-excel', 'AssetLite\DeviceOfferController@uploadOfferByExcel')
        ->name('device.offer.excel.save');

    Route::get('device-offer-status-change', 'AssetLite\DeviceOfferController@offerStatusChange')
        ->name('offer.status.change');
    Route::get('delete-device-offer/{id?}', 'AssetLite\DeviceOfferController@deleteDeviceOffer');


    // PARTNERS ====================================
    Route::resource('partners', 'AssetLite\PartnerController')->except(['show', 'destroy', 'update']);
    Route::post('partners/{id}', 'AssetLite\PartnerController@update');
    Route::get('partner/destroy/{id}', 'AssetLite\PartnerController@destroy');

    Route::get('partner-offer/{partner_id}/{type}', 'AssetLite\PartnerOfferController@index')->name('partner-offer');
    Route::get('partner-offer/{partner_id}/{partner}/offer/create', 'AssetLite\PartnerOfferController@create');
    Route::post('partner-offer/{partner_id}/{partner}/offer/store', 'AssetLite\PartnerOfferController@store')
        ->name('partner_offer_store');
    Route::get('partner-offer/{partner_id}/{partner}/offer/{id}/{campaign?}', 'AssetLite\PartnerOfferController@edit')
        ->name('partner_offer_edit');
    Route::put('partner-offer/{partner_id}/{partner}/offer/{id}/update/', 'AssetLite\PartnerOfferController@update')
        ->name('partner_offer_update');
    Route::get('partner-offer/search-data-sync', 'AssetLite\PartnerOfferController@syncSearchData');

    #Using this type of route because of this route is overriding by edit route
    Route::get('partner-offer/{partner_id}/{partner}/offer/{id}/destroy/destroy', 'AssetLite\PartnerOfferController@destroy');
    Route::get('/partner-offer-home/sortable', 'AssetLite\PartnerOfferController@partnerOfferSortable');
    Route::get('partner-offers-home', 'AssetLite\PartnerOfferController@partnerOffersHome')->name('partner-offer-home');
    Route::get('campaign-offers', "AssetLite\PartnerOfferController@campaignOfferList")->name('campaign-offers.list');
    Route::get('campaign-offer/sortable', "AssetLite\PartnerOfferController@campaignOfferSortable");

    Route::get('partner-offers/{partner}/{id}/details', 'AssetLite\PartnerOfferController@offerDetailsEdit')
        ->name('offer.details');
    Route::post('partner-offers/{partner}/details/update', 'AssetLite\PartnerOfferController@offerDetailsUpdate')
        ->name('offer.details-update');

    // LMS About Pages ================================
    Route::get('about-page/{slug}', 'AssetLite\LmsAboutPageController@index')->name('about-page');
    Route::put('about-page/update', 'AssetLite\LmsAboutPageController@aboutPageUpdate')->name('about-page.update');

    Route::get('about-page/component/create', 'AssetLite\LmsAboutPageController@componentCreate')
        ->name('about-page.component.create');
    Route::post('about-page/component/store', 'AssetLite\LmsAboutPageController@componentStore')
        ->name('about-page.component.store');
    Route::get('about-page/component/edit/{comId}', 'AssetLite\LmsAboutPageController@componentEdit')
        ->name('about-page.component.edit');
    Route::post('about-page/component/update/{comId}', 'AssetLite\LmsAboutPageController@componentUpdate')
        ->name('about-page.component.update');
    Route::get('about-page/component/destroy/{comId}', 'AssetLite\LmsAboutPageController@componentDestroy')
        ->name('about-page.component.destroy');
    Route::get('about-page-component-sort', 'AssetLite\LmsAboutPageController@componentSortable');

    // LMS Tier
    Route::resource('loyalty/tier', 'AssetLite\LoyaltyTierController')->except(['show', 'destroy']);
    Route::get('loyalty-tier-sort', 'AssetLite\LoyaltyTierController@tierSort');
    Route::get('loyalty/tier/destroy/{id}', 'AssetLite\LoyaltyTierController@destroy');

    // LMS About Pages Banner Image ================================
    Route::get('lms-about-page/banner-image', 'AssetLite\LmsAboutBannerController@viewBannerImage');
//    Route::post('about-page/banner-image/upload', 'AssetLite\LmsAboutBannerController@bannerUpload');

    Route::post('about-page/banner-image/upload', 'AssetLite\LmsAboutPageController@bannerUpload');

//    Route::get('ethics-compliance', 'AssetLite\LmsAboutPageController@index');
//    Route::post('ethics/update-page-info', 'AssetLite\LmsAboutPageController@updatePageInfo');
    Route::post('lms/benefit-save/{slug}', 'AssetLite\LmsAboutPageController@saveBenefit');
    Route::get('about-page/benefit-edit/{id}', 'AssetLite\LmsAboutPageController@benefitEdit');
//    Route::get('about-page/sort-benefit-file', 'AssetLite\LmsAboutPageController@sortFiles');
    Route::get('about-page/benefit-status-change/{id}', 'AssetLite\LmsAboutPageController@chanbgeStatus');
    Route::get('about-page/benefit-delete/{slug}/{id}', 'AssetLite\LmsAboutPageController@fileDelete');


    // Dynamic Pages ================================
    Route::get('dynamic-pages/', 'AssetLite\DynamicPageController@index');
    Route::get('dynamic-pages/create', 'AssetLite\DynamicPageController@create');
    Route::get('dynamic-pages/edit/{id}', 'AssetLite\DynamicPageController@edit');
    Route::post('dynamic-pages/save', 'AssetLite\DynamicPageController@savePage');
    Route::get('dynamic-pages/delete/{id}', 'AssetLite\DynamicPageController@deletePage');

    #Dynamic Page's Components
    // Route::get('dynamic-pages/{pageId}/components', 'AssetLite\DynamicPageController@componentList')
    //     ->name('other-components');
    // Route::get('dynamic-pages/{pageId}/component/create', 'AssetLite\DynamicPageController@componentCreateForm')
    //     ->name('other_component_create');
    // Route::post('dynamic-pages/{pageId}/component/store', 'AssetLite\DynamicPageController@componentStore')
    //     ->name('other_component_store');
    // Route::get('dynamic-pages/{pageId}/component/{id}/edit', 'AssetLite\DynamicPageController@componentEditForm')
    //     ->name('other_component_edit');
    // Route::put('dynamic-pages/{pageId}/component/{id}/update', 'AssetLite\DynamicPageController@componentUpdate')
    //     ->name('other_component_update');
    // Route::get('dynamic-pages/{pageId}/component/{id}/delete', 'AssetLite\DynamicPageController@componentDestroy')
    //     ->name('other_component_delete');
    // Route::get('dynamic-pages/component-sortable', 'AssetLite\DynamicPageController@componentSortable');

    Route::get('dynamic-pages/{other_dynamic_page_id}/components', 'AssetLite\DynamicPageController@componentList')
        ->name('other-components');
    Route::get('dynamic-pages/component/create', 'AssetLite\DynamicPageController@componentCreateForm')
        ->name('other-component-create');
    // Route::post('dynamic-pages/{pageId}/component/store', 'AssetLite\DynamicPageController@componentStore')
    //     ->name('other_component_store');

    Route::post('dynamic-pages/component/store', 'AssetLite\DynamicPageController@componentStore')
        ->name('other-component-store');
    Route::get('dynamic-pages/component/edit/{comId}', 'AssetLite\DynamicPageController@componentEditForm')
        ->name('other-component-edit');
    Route::post('dynamic-pages/component/update/{comId}', 'AssetLite\DynamicPageController@componentUpdate')
        ->name('other-component-update');
    Route::get('dynamic-pages/component/delete/{comId}', 'AssetLite\DynamicPageController@componentDestroy')
        ->name('other-component-delete');
    Route::get('dynamic-pages/component-sortable', 'AssetLite\DynamicPageController@componentSortable');


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
    Route::get('home-page/component', 'AssetLite\FixedPageController@homeComponent')->name('home_page.components');
    Route::get('fixed-pages', 'AssetLite\FixedPageController@fixedPageList');
    Route::get('fixed-pages/create', 'AssetLite\FixedPageController@fixedPageCreate');
    Route::post('fixed-pages/store', 'AssetLite\FixedPageController@fixedPageStore');
    Route::get('fixed-pages/edit/{id}', 'AssetLite\FixedPageController@fixedPageEdit');
    Route::post('fixed-pages/update/{id}', 'AssetLite\FixedPageController@fixedPageUpdate');
    Route::get('fixed-pages/delete/{id}', 'AssetLite\FixedPageController@deleteFixedPage');

    Route::get('fixed-page/{id}/components', 'AssetLite\FixedPageController@components')->name('fixed-page-components');
    Route::get('fixed-page/{id}/components/{short_code}/edit', 'AssetLite\FixedPageController@editComponents')->name('fixed-page-components-edit');
    Route::patch('fixed-page/{id}/components/{short_code}/update', 'AssetLite\FixedPageController@updateComponents')->name('fixed-page-components-update');
    Route::get('fixed-pages/{id}/meta-tags', 'AssetLite\FixedPageController@metaTagsEdit')->name('fixed-page-metatags');
    Route::post('fixed-pages/{id}/meta-tag/{metaId}/update', 'AssetLite\FixedPageController@metaTagsUpdate');
    Route::get('fixed-pages/{pageId}/component/{componentId}', 'AssetLite\FixedPageController@fixedPageStatusUpdate')
        ->name('update-component-status');

    Route::get('/fixed-page-component-sortable', 'AssetLite\FixedPageController@componentSortable');
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


    // Search ======================================================
    Route::get('popular-search', 'AssetLite\SearchController@index');
    Route::get('save-search-limit', 'AssetLite\SearchController@saveLimit')->name('save.search.limit');
    Route::get('popular-search-create', 'AssetLite\SearchController@popularSearchCreate');
    Route::get('search-product-list', 'AssetLite\SearchController@getProductList')->name('search.get.product.list');

    Route::post('popular-search-save', 'AssetLite\SearchController@popularSearchSave')->name('popular.search.save');

    Route::get('search-popular-edit/{keywordId}', 'AssetLite\SearchController@popularSearchEdit');
    Route::post('popular-search-update', 'AssetLite\SearchController@popularSearchUpdate')
        ->name('popular.search.update');

    Route::post('search-ad-tech/store', 'AssetLite\SearchController@adTechStore')->name('search.adtech.store');

    // Popular Search
    Route::get('popular-status-change/{keywordId}', 'AssetLite\SearchController@popularSearchStatus');
    Route::get('popular-search-sort-change', 'AssetLite\SearchController@popularSortChange');
    Route::get('popular-search-delete/{keywordId}', 'AssetLite\SearchController@deletePopularSearch');

    // Single Search Page
    Route::resource('search-single-page', 'AssetLite\SearchController');
    Route::get('search-single-page/destroy/{id}', 'AssetLite\SearchController@destroy');

    // Product core ============================================
    Route::get('product-core', 'AssetLite\ProductCoreController@index')->name('product.core.list');
    Route::get('product-core/{id}/edit/', 'AssetLite\ProductCoreController@edit')->name('product.core.edit');


    // Search ======================================================
    Route::get('popular-search', 'AssetLite\SearchController@index');
    Route::get('save-search-limit', 'AssetLite\SearchController@saveLimit')->name('save.search.limit');
    Route::get('popular-search-create', 'AssetLite\SearchController@popularSearchCreate');
    Route::get('search-product-list', 'AssetLite\SearchController@getProductList')->name('search.get.product.list');

    Route::post('popular-search-save', 'AssetLite\SearchController@popularSearchSave')->name('popular.search.save');

    Route::get('search-popular-edit/{keywordId}', 'AssetLite\SearchController@popularSearchEdit');
    Route::post('popular-search-update',
        'AssetLite\SearchController@popularSearchUpdate')->name('popular.search.update');

    Route::get('popular-status-change/{keywordId}', 'AssetLite\SearchController@popularSearchStatus');
    Route::get('popular-search-delete/{keywordId}', 'AssetLite\SearchController@deletePopularSearch');

    // Easy Payment Card ============================================
    Route::get('easy-payment-card', 'AssetLite\EasyPaymentCardController@index');
    Route::post('easy-payment-card-list',
        'AssetLite\EasyPaymentCardController@getEasyPaymentCardList')->name('easypaymentcard.list.ajax');
    Route::post('upload-payment-card-excel', 'AssetLite\EasyPaymentCardController@uploadCardByExcel')
        ->name('payment.card.excel.save');
    Route::get('payment-card-status-change', 'AssetLite\EasyPaymentCardController@cardStatusChange')
        ->name('payment.card.status.change');
    Route::get('delete-easy-payment-card/{id?}', 'AssetLite\EasyPaymentCardController@deletePaymentCard');


    // Business Module ============================================
    Route::get('business-general', 'AssetLite\BusinessGeneralController@index')->name('business.general');


    //__category
    Route::get('business-category-get/{catId}', 'AssetLite\BusinessGeneralController@getCategory');
    Route::post('business/update-category', 'AssetLite\BusinessGeneralController@updateCategory');
    Route::get('business-category-name-change',
        'AssetLite\BusinessGeneralController@categoryNameChange')->name('business.category.name.save');
    Route::get('business-category-home-status-change',
        'AssetLite\BusinessGeneralController@categoryStatusChange')->name('business.category.home.status.change');
    Route::post('business-category-banner-save', 'AssetLite\BusinessGeneralController@categoryBannerSave')
        ->name('business.category.banner.save');


    Route::get('business-category-sort-change',
        'AssetLite\BusinessGeneralController@categorySortChange')->name('business.category.sort.save');

    //sliding speed

    Route::get('business-save-sliding-speed', 'AssetLite\BusinessGeneralController@saveSlidingSpeed')
        ->name('business.sliding.speed.save');

    //__banner
    Route::post('business-banner-photo-upload',
        'AssetLite\BusinessGeneralController@bannerPhotoSave')->name('business.banner.photo.save');

    //__news
    Route::post('business-news-save', 'AssetLite\BusinessGeneralController@homeNewsSave')->name('business.news.save');
    Route::get('get-single-news/{newsId}', 'AssetLite\BusinessGeneralController@getNewsById')->name('get.news.by.id');
    Route::get('business-news-sort', 'AssetLite\BusinessGeneralController@newsSortChange');
    Route::get('business-news-status-change/{id}', 'AssetLite\BusinessGeneralController@newsStatusChange');
    Route::get('business-news-delete/{id}', 'AssetLite\BusinessGeneralController@newsDelete');

    //__features
    Route::post('business-feature-save',
        'AssetLite\BusinessGeneralController@featureSave')->name('business.feature.save');
    Route::get('get-single-feature/{featureId}', 'AssetLite\BusinessGeneralController@getFeatureById');
    Route::get('business-feature-sort', 'AssetLite\BusinessGeneralController@featureSortChange');
    Route::get('business-feature-status-change/{id}', 'AssetLite\BusinessGeneralController@featureStatusChange');
    Route::get('business-feature-delete/{id}', 'AssetLite\BusinessGeneralController@featureDelete');

    //__Category Package
    Route::get('business-package', 'AssetLite\BusinessPackageController@index');
    Route::get('business-package-sort-change', 'AssetLite\BusinessPackageController@sortChange');
    Route::get('business-package-home-status-change/{packageId}', 'AssetLite\BusinessPackageController@homeShow');
    Route::get('business-package-active/{packageId}', 'AssetLite\BusinessPackageController@activationStatus');

    Route::get('business-package/create', 'AssetLite\BusinessPackageController@create');
    Route::post('business-package/save', 'AssetLite\BusinessPackageController@store')->name('business.package.save');

    Route::get('business-package-edit/{packageId}', 'AssetLite\BusinessPackageController@edit');
    Route::put('business-package/update',
        'AssetLite\BusinessPackageController@update')->name('business.package.update');
    Route::get('business-package-delete/{packageId}', 'AssetLite\BusinessPackageController@delete');

    /**
     * Business package landing components
     *
     */
    Route::get('business-package-component/list', 'AssetLite\BusinessPackageController@index')
        ->name('business-package-component.list');
    Route::get('business-package-component/create', 'AssetLite\BusinessPackageController@componentCreate')
        ->name('business-package-component.create');
    Route::post('business-package-component/store', 'AssetLite\BusinessPackageController@componentStore')
        ->name('business-package-component.store');
    Route::get('business-package-component/edit/{comId}', 'AssetLite\BusinessPackageController@componentEdit')
        ->name('business-package-component.edit');
    Route::post('business-package-component/update/{comId}', 'AssetLite\BusinessPackageController@componentUpdate')
        ->name('business-package-component.update');
    Route::get('business-package-component/destroy/{comId}', 'AssetLite\BusinessPackageController@componentDestroy')
        ->name('business-package-component.destroy');
    Route::get('business-package-component-sort', 'AssetLite\BusinessPackageController@componentSortable');

    /**
     * Business package details components
     *
     */
    Route::get('business-package-details-component/{business_package_details_id}/list', 'AssetLite\BusinessPackageDetailsController@index')
        ->name('business-package-details-component.list');
    Route::get('business-package-details-component/create', 'AssetLite\BusinessPackageDetailsController@componentCreate')
        ->name('business-package-details-component.create');
    Route::post('business-package-details-component/store', 'AssetLite\BusinessPackageDetailsController@componentStore')
        ->name('business-package-details-component.store');
    Route::get('business-package-details-component/edit/{comId}', 'AssetLite\BusinessPackageDetailsController@componentEdit')
        ->name('business-package-details-component.edit');
    Route::post('business-package-details-component/update/{comId}', 'AssetLite\BusinessPackageDetailsController@componentUpdate')
        ->name('business-package-details-component.update');
    Route::get('business-package-details-component/destroy/{comId}', 'AssetLite\BusinessPackageDetailsController@componentDestroy')
        ->name('business-package-details-component.destroy');
    Route::get('business-package-details-component-sort', 'AssetLite\BusinessPackageDetailsController@componentSortable');

    //__Category Internet Package
    Route::get('business-internet', 'AssetLite\BusinessInternetController@index');
    Route::get('business-internet-create', 'AssetLite\BusinessInternetController@internetCreate');
    Route::post('business-internet-save', 'AssetLite\BusinessInternetController@saveInternetPackage');
    Route::get('business-internet-edit/{internetId}', 'AssetLite\BusinessInternetController@internetEdit');
    Route::put('business-internet-update', 'AssetLite\BusinessInternetController@updateInternetPackage');
    Route::post('business-internet-package-list',
        'AssetLite\BusinessInternetController@internetPackageList')->name("business.internet.list.ajax");
    Route::post('business-internet-excel', 'AssetLite\BusinessInternetController@uploadInternetExcel')
        ->name('business.internet.excel.save');
    Route::get('business-internet-status-change/{pakcageId}',
        'AssetLite\BusinessInternetController@packageStatusChange');
    Route::get('business-internet-home-show/{pakcageId}', 'AssetLite\BusinessInternetController@packageHomeShow');
    Route::get('delete-business-internet-package/{pakcageId?}', 'AssetLite\BusinessInternetController@deletePackage');
    Route::get('business-internet/search-data-sync', 'AssetLite\BusinessInternetController@searchDataSync');

    //Category B. Solution, IOT & Others
    Route::get('business-other-services', 'AssetLite\BusinessOthersController@index')->name('business.other.services');
    Route::get('business-others/create', 'AssetLite\BusinessOthersController@create');
    Route::get('business-others-home-show/{serviceId}', 'AssetLite\BusinessOthersController@homeShow');
    Route::get('business-others-home-slider/{serviceId}', 'AssetLite\BusinessOthersController@homeSlider');
    Route::get('business-others-active/{serviceId}', 'AssetLite\BusinessOthersController@activationStatus');
    Route::get('business-others-sort-change', 'AssetLite\BusinessOthersController@sortChange');
    Route::get('business-others-service-delete/{serviceId}', 'AssetLite\BusinessOthersController@deleteService');
    Route::get('business-others-service-edit/{serviceId}/{type?}', 'AssetLite\BusinessOthersController@edit');
    Route::put('business-others-update', 'AssetLite\BusinessOthersController@update')->name("business.other.update");

    Route::get('business-others-components/{serviceId}', 'AssetLite\BusinessOthersController@addComponent');
    Route::post('business-others-save', 'AssetLite\BusinessOthersController@saveService')->name("business.other.save");
    Route::post('business-component-save',
        'AssetLite\BusinessOthersController@saveComponents')->name("business.component.save");
    Route::get('business-others-components-list/{serviceId}/{type?}',
        'AssetLite\BusinessOthersController@componentList');

    Route::get('business-others-component-edit/{serviceId}/{position}/{type}',
        'AssetLite\BusinessOthersController@editComponent');
    Route::post('business-others-component-update', 'AssetLite\BusinessOthersController@updateComponents')
        ->name("business.component.update");

    Route::get('business-others-component-delete/{serviceId}/{position}/{type}',
        'AssetLite\BusinessOthersController@deleteComponent');
    Route::get('business-other-component-sort', 'AssetLite\BusinessOthersController@sortComponent');


    // Roaming Module ============================================
    Route::get('roaming-general', 'AssetLite\RoamingGeneralController@index');
    Route::get('roaming/get-single-category/{catId}', 'AssetLite\RoamingGeneralController@getSingleCategory');
    Route::post('roaming/update-category', 'AssetLite\RoamingGeneralController@updateCategory');
    Route::get('roaming/category-sort', 'AssetLite\RoamingGeneralController@categorySortChange');


    Route::get('roaming/general-page-component/{type}/{pageId?}', 'AssetLite\RoamingGeneralController@editPage');
    Route::post('roaming/update-general-page', 'AssetLite\RoamingGeneralController@updatePage');
    Route::get('roaming/page-component-sort', 'AssetLite\RoamingGeneralController@componentSortChange');
    Route::get('roaming/page-component-delete/{pageId}/{comId}', 'AssetLite\RoamingGeneralController@componentDelete');


    //offer
    Route::get('roaming-offers', 'AssetLite\RoamingOfferController@index');
    Route::get('roaming/get-offer-single-category/{catId}', 'AssetLite\RoamingOfferController@getSingleCategory');
    Route::post('roaming/save-offer-category', 'AssetLite\RoamingOfferController@saveCategory');
    Route::get('roaming/offer-category-sort', 'AssetLite\RoamingOfferController@categorySortChange');
    Route::get('roaming/offer-product-create', 'AssetLite\RoamingOfferController@createOffer');
    Route::get('roaming/edit-other-offer/{offerId}', 'AssetLite\RoamingOfferController@editOffer');
    Route::post('roaming/save-other-offer', 'AssetLite\RoamingOfferController@saveOffer');
    Route::get('roaming/delete-other-offer/{offerId}', 'AssetLite\RoamingOfferController@deleteOffer');

    Route::get('roaming/edit-other-offer-component/{offerId}', 'AssetLite\RoamingOfferController@editComponent');
    Route::post('roaming/update-offer-component/', 'AssetLite\RoamingOfferController@updateComponent');
    Route::get('roaming/offer-component-sort', 'AssetLite\RoamingOfferController@componentSortChange');
    Route::get('roaming/offer-component-delete/{offerId}/{comId}', 'AssetLite\RoamingOfferController@componentDelete');

    // Operator
    Route::get('roaming/operators', 'AssetLite\RoamingOperatorController@index');
    Route::get('roaming/operator/create', 'AssetLite\RoamingOperatorController@operatorCreate');
    Route::post('roaming/operator/store', 'AssetLite\RoamingOperatorController@saveOperator')
        ->name('operator.store');
    Route::get('roaming/operator/edit/{id}', 'AssetLite\RoamingOperatorController@operatorEdit');
    Route::put('roaming/operator/update', 'AssetLite\RoamingOperatorController@saveOperator')
        ->name('operator.update');
    Route::post('roaming-operator-list', 'AssetLite\RoamingOperatorController@roamingOperatorList')
        ->name('roaming.operator.list.ajax');
    Route::post('roaming/operator-excel', 'AssetLite\RoamingOperatorController@uploadOperatorExcel')
        ->name('roaming.operator-excel.save');
    Route::get('roaming-operator-status-change/{operatorId}',
        'AssetLite\RoamingOperatorController@operatorStatusChange');
    Route::get('roaming-operator/destroy/{operatorId?}', 'AssetLite\RoamingOperatorController@deleteOperator');

    // Rate
    Route::get('roaming/rates', 'AssetLite\RoamingRateController@index');
    Route::get('roaming/rates/create', 'AssetLite\RoamingRateController@ratesCreate');
    Route::post('roaming/rates/store', 'AssetLite\RoamingRateController@ratesStore')
        ->name('rates.store');
    Route::get('roaming/rates/edit/{id}', 'AssetLite\RoamingRateController@ratesEdit');
    Route::put('roaming/rates/update/{ratesId}', 'AssetLite\RoamingRateController@updateRates')
        ->name('rates.update');
    Route::post('roaming-rates-list', 'AssetLite\RoamingRateController@roamingRatesList')
        ->name('roaming.rates.list.ajax');
    Route::post('roaming/rates-excel', 'AssetLite\RoamingRateController@uploadRatesExcel')
        ->name('roaming.rates-excel.save');
    Route::get('roaming-rates-status-change/{rateId}', 'AssetLite\RoamingRateController@ratesStatusChange');
    Route::get('roaming-rates/destroy/{rateId?}', 'AssetLite\RoamingRateController@deleteRates');

    // Bundle
    Route::get('roaming/bundle', 'AssetLite\RoamingBundleController@index');
    Route::get('roaming/bundle/create', 'AssetLite\RoamingBundleController@bundleCreate');
    Route::post('roaming/bundle/store', 'AssetLite\RoamingBundleController@bundleStore')
        ->name('bundle.store');
    Route::get('roaming/bundle/details/{id}', 'AssetLite\RoamingBundleController@bundleEdit');
    Route::put('roaming/bundle/update/{bundleId}', 'AssetLite\RoamingBundleController@updateBundle')
        ->name('bundle.update');
    Route::post('roaming-bundle-list', 'AssetLite\RoamingBundleController@roamingBundleList')
        ->name('roaming.bundle.list.ajax');
    Route::post('roaming/bundle-excel', 'AssetLite\RoamingBundleController@uploadBundleExcel')
        ->name('roaming.bundle-excel.save');
    Route::get('roaming-bundle-status-change/{rateId}', 'AssetLite\RoamingBundleController@bundleStatusChange');
    Route::get('roaming-bundle/destroy/{rateId?}', 'AssetLite\RoamingBundleController@deleteBundle');

    //info & Tips
    Route::get('roaming-info-tips', 'AssetLite\RoamingInfoController@index');
    Route::get('roaming/get-info-single-category/{catId}', 'AssetLite\RoamingInfoController@getSingleCategory');
    Route::post('roaming/save-info-category', 'AssetLite\RoamingInfoController@saveCategory');
    Route::get('roaming/info-category-sort', 'AssetLite\RoamingInfoController@categorySortChange');

    Route::get('roaming/info-tips-create', 'AssetLite\RoamingInfoController@createInfo');
    Route::get('roaming/edit-info/{infoId}', 'AssetLite\RoamingInfoController@editInfo');
    Route::post('roaming/save-info-tips', 'AssetLite\RoamingInfoController@saveInfo');
    Route::get('roaming/delete-info/{infoId}', 'AssetLite\RoamingInfoController@deleteInfo');
    Route::get('roaming/edit-info-component/{infoId}', 'AssetLite\RoamingInfoController@editComponent');
    Route::post('roaming/update-info-component/', 'AssetLite\RoamingInfoController@updateComponent');
    Route::get('roaming/info-component-sort', 'AssetLite\RoamingInfoController@componentSortChange');
    Route::get('roaming/info-component-delete/{infoId}/{comId}', 'AssetLite\RoamingInfoController@componentDelete');


    // eCarrer ============================================
    // Route::get('life-at-banglalink/general',
    //     'AssetLite\EcareerController@generalIndex')->name('life.at.banglalink.general');
    // Route::get('life-at-banglalink/general/create',
    //     'AssetLite\EcareerController@generalCreate')->name('life.at.banglalink.general.create');
    // Route::post('life-at-banglalink/general/store',
    //     'AssetLite\EcareerController@generalStore')->name('life.at.banglalink.general.store');
    // Route::get('life-at-banglalink/general/{id}/edit',
    //     'AssetLite\EcareerController@generalEdit')->name('life.at.banglalink.general.edit');
    // Route::post('life-at-banglalink/general/{id}/update',
    //     'AssetLite\EcareerController@generalUpdate')->name('life.at.banglalink.general.update');
    // Route::get('life-at-banglalink/general/destroy/{id}',
    //     'AssetLite\EcareerController@generalDestroy')->name('life.at.banglalink.general.destroy');
    require __DIR__.'/asset-lite/eCareer/ecarrer_general.php';
    // University
    Route::get('university', 'AssetLite\UniversityController@index')
        ->name('university.index');
    Route::post('university-list', 'AssetLite\UniversityController@universityList')
        ->name('university.list.ajax');
    Route::post('university-excel/uploader', 'AssetLite\UniversityController@uploadUniversityExcel')
        ->name('university.uploader');

    Route::get('university/destroy/{university_id?}', 'AssetLite\UniversityController@deleteUniversity');


    // eCarrer Items ============================================
    Route::get('ecarrer-items/{parent_id}/list', 'AssetLite\EcareerItemController@index')->name('ecarrer.items.list');
    Route::get('ecarrer-items/{parent_id}/create',
        'AssetLite\EcareerItemController@create')->name('ecarrer.items.create');
    Route::post('ecarrer-items/{parent_id}/store',
        'AssetLite\EcareerItemController@store')->name('ecarrer.items.store');
    Route::get('ecarrer-items/{parent_id}/{id}/edit',
        'AssetLite\EcareerItemController@edit')->name('ecarrer.items.edit');

    Route::post('ecarrer-items/{parent_id}/{id}/update',
        'AssetLite\EcareerItemController@update')->name('ecarrer.items.update');
    Route::get('ecarrer-items/{parent_id}/destroy/{id}',
        'AssetLite\EcareerItemController@destroy')->name('ecarrer.items.destroy');
    Route::get('ecarrer-items/photo-delete/{id}', 'AssetLite\EcareerItemController@deletePhoto');

    // eCarrer Life at banglalink teams =========================================================
    Route::get('life-at-banglalink/teams', 'AssetLite\EcareerController@teamsIndex')->name('life.at.banglalink.teams');
    Route::get('life-at-banglalink/teams/create',
        'AssetLite\EcareerController@teamsCreate')->name('life.at.banglalink.teams.create');
    Route::post('life-at-banglalink/teams/store',
        'AssetLite\EcareerController@teamsStore')->name('life.at.banglalink.teams.store');

    Route::get('life-at-banglalink/teams/{id}/edit',
        'AssetLite\EcareerController@teamsEdit')->name('life.at.banglalink.teams.edit');

    Route::post('life-at-banglalink/teams/{id}/update',
        'AssetLite\EcareerController@teamsUpdate')->name('life.at.banglalink.teams.update');
    Route::get('life-at-banglalink/teams/destroy/{id}',
        'AssetLite\EcareerController@teamsDestroy')->name('life.at.banglalink.teams.destroy');


    // eCarrer Life at banglalink diversity =========================================================
    Route::get('life-at-banglalink/diversity',
        'AssetLite\EcareerController@diversityIndex')->name('life.at.banglalink.diversity');
    Route::get('life-at-banglalink/diversity/create',
        'AssetLite\EcareerController@diversityCreate')->name('life.at.banglalink.diversity.create');
    Route::post('life-at-banglalink/diversity/store',
        'AssetLite\EcareerController@diversityStore')->name('life.at.banglalink.diversity.store');

    Route::get('life-at-banglalink/diversity/{id}/edit',
        'AssetLite\EcareerController@diversityEdit')->name('life.at.banglalink.diversity.edit');

    Route::post('life-at-banglalink/diversity/{id}/update',
        'AssetLite\EcareerController@diversityUpdate')->name('life.at.banglalink.diversity.update');
    Route::get('life-at-banglalink/diversity/destroy/{id}',
        'AssetLite\EcareerController@diversityDestroy')->name('life.at.banglalink.diversity.destroy');


    // eCarrer Life at banglalink Events & Activities =========================================================
    Route::get('life-at-banglalink/events',
        'AssetLite\EcareerController@eventsIndex')->name('life.at.banglalink.events');
    Route::get('life-at-banglalink/events/create',
        'AssetLite\EcareerController@eventsCreate')->name('life.at.banglalink.events.create');
    Route::post('life-at-banglalink/events/store',
        'AssetLite\EcareerController@eventsStore')->name('life.at.banglalink.events.store');

    Route::get('life-at-banglalink/events/{id}/edit',
        'AssetLite\EcareerController@eventsEdit')->name('life.at.banglalink.events.edit');

    Route::post('life-at-banglalink/events/{id}/update',
        'AssetLite\EcareerController@eventsUpdate')->name('life.at.banglalink.events.update');
    Route::get('life-at-banglalink/events/destroy/{id}',
        'AssetLite\EcareerController@eventsDestroy')->name('life.at.banglalink.events.destroy');


    // eCarrer Life at banglalink Top Banner menu =========================================================
    Route::get('life-at-banglalink/topbanner',
        'AssetLite\EcareerController@topbannerIndex')->name('life.at.banglalink.topbanner');
    Route::get('life-at-banglalink/topbanner/create',
        'AssetLite\EcareerController@topbannerCreate')->name('life.at.banglalink.topbanner.create');
    Route::post('life-at-banglalink/topbanner/store',
        'AssetLite\EcareerController@topbannerStore')->name('life.at.banglalink.topbanner.store');

    Route::get('life-at-banglalink/topbanner/{id}/edit',
        'AssetLite\EcareerController@topbannerEdit')->name('life.at.banglalink.topbanner.edit');

    Route::post('life-at-banglalink/topbanner/{id}/update',
        'AssetLite\EcareerController@topbannerUpdate')->name('life.at.banglalink.topbanner.update');
    Route::get('life-at-banglalink/topbanner/destroy/{id}',
        'AssetLite\EcareerController@topbannerDestroy')->name('life.at.banglalink.topbanner.destroy');

    // eCarrer Contact us  =========================================================
    Route::get('life-at-banglalink/contact',
        'AssetLite\EcareerController@contactIndex')->name('life.at.banglalink.contact');
    Route::get('life-at-banglalink/contact/create',
        'AssetLite\EcareerController@contactCreate')->name('life.at.banglalink.contact.create');
    Route::post('life-at-banglalink/contact/store',
        'AssetLite\EcareerController@contactStore')->name('life.at.banglalink.contact.store');

    Route::get('life-at-banglalink/contact/{id}/edit',
        'AssetLite\EcareerController@contactEdit')->name('life.at.banglalink.contact.edit');

    Route::post('life-at-banglalink/contact/{id}/update',
        'AssetLite\EcareerController@contactUpdate')->name('life.at.banglalink.contact.update');
    Route::get('life-at-banglalink/contact/destroy/{id}',
        'AssetLite\EcareerController@contactDestroy')->name('life.at.banglalink.contact.destroy');


    // eCarrer Vacancy  =========================================================
    Route::get('vacancy/pioneer', 'AssetLite\EcareerController@pioneerIndex')->name('vacancy.pioneer');
    Route::get('vacancy/pioneer/create', 'AssetLite\EcareerController@pioneerCreate')->name('vacancy.pioneer.create');
    Route::post('vacancy/pioneer/store', 'AssetLite\EcareerController@pioneerStore')->name('vacancy.pioneer.store');

    Route::get('vacancy/pioneer/{id}/edit', 'AssetLite\EcareerController@pioneerEdit')->name('vacancy.pioneer.edit');

    Route::post('vacancy/pioneer/{id}/update',
        'AssetLite\EcareerController@pioneerUpdate')->name('vacancy.pioneer.update');
    Route::get('vacancy/pioneer/destroy/{id}',
        'AssetLite\EcareerController@pioneerDestroy')->name('vacancy.pioneer.destroy');


    // eCarrer Vacancy icon box =========================================================
    Route::get('vacancy/viconbox', 'AssetLite\EcareerController@viconboxIndex')->name('vacancy.viconbox');
    Route::get('vacancy/viconbox/create',
        'AssetLite\EcareerController@viconboxCreate')->name('vacancy.viconbox.create');
    Route::post('vacancy/viconbox/store', 'AssetLite\EcareerController@viconboxStore')->name('vacancy.viconbox.store');

    Route::get('vacancy/viconbox/{id}/edit', 'AssetLite\EcareerController@viconboxEdit')->name('vacancy.viconbox.edit');

    Route::post('vacancy/viconbox/{id}/update',
        'AssetLite\EcareerController@viconboxUpdate')->name('vacancy.viconbox.update');
    Route::get('vacancy/viconbox/destroy/{id}',
        'AssetLite\EcareerController@viconboxDestroy')->name('vacancy.viconbox.destroy');

    // eCarrer Programs general =========================================================
    Route::get('programs/progeneral/{type}/create',
        'AssetLite\EcareerController@progeneralCreate')->name('programs.progeneral.create');
    Route::post('programs/progeneral/store',
        'AssetLite\EcareerController@progeneralStore')->name('programs.progeneral.store');

    Route::get('programs/progeneral/{id}/{type}/edit',
        'AssetLite\EcareerController@progeneralEdit')->name('programs.progeneral.edit');
    Route::post('programs/progeneral/{id}/update',
        'AssetLite\EcareerController@progeneralUpdate')->name('programs.progeneral.update');
    Route::get('programs/progeneral/destroy/{id}',
        'AssetLite\EcareerController@progeneralDestroy')->name('programs.progeneral.destroy');

    Route::get('programs/progeneral/{type}',
        'AssetLite\EcareerController@progeneralIndex')->name('programs.progeneral');


    // eCarrer Programs icon box =========================================================
    Route::get('programs/proiconbox', 'AssetLite\EcareerController@proiconboxIndex')->name('programs.proiconbox');
    Route::get('programs/proiconbox/create',
        'AssetLite\EcareerController@proiconboxCreate')->name('programs.proiconbox.create');
    Route::post('programs/proiconbox/store',
        'AssetLite\EcareerController@proiconboxStore')->name('programs.proiconbox.store');

    Route::get('programs/proiconbox/{id}/edit',
        'AssetLite\EcareerController@proiconboxEdit')->name('programs.proiconbox.edit');

    Route::post('programs/proiconbox/{id}/update',
        'AssetLite\EcareerController@proiconboxUpdate')->name('programs.proiconbox.update');
    Route::get('programs/proiconbox/destroy/{id}',
        'AssetLite\EcareerController@proiconboxDestroy')->name('programs.proiconbox.destroy');

    // eCarrer Programs Photo gallery =========================================================
    Route::get('programs/photogallery', 'AssetLite\EcareerController@photogalleryIndex')->name('programs.photogallery');
    Route::get('programs/photogallery/create',
        'AssetLite\EcareerController@photogalleryCreate')->name('programs.photogallery.create');
    Route::post('programs/photogallery/store',
        'AssetLite\EcareerController@photogalleryStore')->name('programs.photogallery.store');

    Route::get('programs/photogallery/{id}/edit',
        'AssetLite\EcareerController@photogalleryEdit')->name('programs.photogallery.edit');

    Route::post('programs/photogallery/{id}/update',
        'AssetLite\EcareerController@photogalleryUpdate')->name('programs.photogallery.update');
    Route::get('programs/photogallery/destroy/{id}',
        'AssetLite\EcareerController@photogalleryDestroy')->name('programs.photogallery.destroy');

    // eCarrer Programs SAP Previous Batches =========================================================
    Route::get('programs/sapbatches', 'AssetLite\EcareerController@sapbatchesIndex')->name('programs.sapbatches');
    Route::get('programs/sapbatches/create',
        'AssetLite\EcareerController@sapbatchesCreate')->name('programs.sapbatches.create');
    Route::post('programs/sapbatches/store',
        'AssetLite\EcareerController@sapbatchesStore')->name('programs.sapbatches.store');

    Route::get('programs/sapbatches/{id}/edit',
        'AssetLite\EcareerController@sapbatchesEdit')->name('programs.sapbatches.edit');

    Route::post('programs/sapbatches/{id}/update',
        'AssetLite\EcareerController@sapbatchesUpdate')->name('programs.sapbatches.update');
    Route::get('programs/sapbatches/destroy/{id}',
        'AssetLite\EcareerController@sapbatchesDestroy')->name('programs.sapbatches.destroy');
    // eCarrer Programs Ennovators Previous Batches =========================================================
    Route::get('programs/ennovatorbatches',
        'AssetLite\EcareerController@ennovatorbatchesIndex')->name('programs.ennovatorbatches');
    Route::get('programs/ennovatorbatches/create',
        'AssetLite\EcareerController@ennovatorbatchesCreate')->name('programs.ennovatorbatches.create');
    Route::post('programs/ennovatorbatches/store',
        'AssetLite\EcareerController@ennovatorbatchesStore')->name('programs.ennovatorbatches.store');

    Route::get('programs/ennovatorbatches/{id}/edit',
        'AssetLite\EcareerController@ennovatorbatchesEdit')->name('programs.ennovatorbatches.edit');

    Route::post('programs/ennovatorbatches/{id}/update',
        'AssetLite\EcareerController@ennovatorbatchesUpdate')->name('programs.ennovatorbatches.update');
    Route::get('programs/ennovatorbatches/destroy/{id}',
        'AssetLite\EcareerController@ennovatorbatchesDestroy')->name('programs.ennovatorbatches.destroy');

    # ecareer programs top tab
    Route::get('programs/tab-title', 'AssetLite\EcareerController@tabTitleIndex')->name('programs.tab.title');
    Route::get('programs/tab-title/{id}/edit',
        'AssetLite\EcareerController@tabTitleEdit')->name('programs.tab.title.edit');
    Route::post('programs/tab-title/{id}/update',
        'AssetLite\EcareerController@tabTitleUpdate')->name('programs.tab.title.update');
    // Route::get('life-at-banglalink/topbanner/create', 'AssetLite\EcareerController@topbannerCreate')->name('life.at.banglalink.topbanner.create');
    // Route::post('programs/tab-title/store', 'AssetLite\EcareerController@topbannerStore')->name('life.at.banglalink.topbanner.store');
    // Route::get('programs/tab-title/destroy/{id}', 'AssetLite\EcareerController@topbannerDestroy')->name('life.at.banglalink.topbanner.destroy');

    Route::get('/ecarrer-items-sortable', 'AssetLite\EcareerItemController@ecarrerItemSortable');

    // App & Service Tab =========================================================
    Route::resource('app-service/tabs', 'AssetLite\AppServiceTabController')
        ->except('create', 'store', 'show', 'destroy');
    Route::get('app-service/tabs/destroy/{id}', 'AssetLite\AppServiceTabController@destroy');

    // App & Service Category =========================================================
    Route::resource('app-service/category', 'AssetLite\AppServiceCategoryController')->except('show', 'destroy');
    Route::get('app-service/category/destroy/{id}', 'AssetLite\AppServiceCategoryController@destroy');

    // App & Service Vendor API =========================================================
    Route::resource('app-service/vendor-api', 'AssetLite\AppServiceVendorApiController')->except('show', 'destroy');
    Route::get('app-service/vendor-api/destroy/{id}', 'AssetLite\AppServiceVendorApiController@destroy');

    // App & Service Product =========================================================
    Route::resource('app-service-product', 'AssetLite\AppServiceProductController')->except('show', 'destroy');
    Route::get('app-service/product/destroy/{id}', 'AssetLite\AppServiceProductController@destroy');
    Route::get('app-service/search-data-sync', 'AssetLite\AppServiceProductController@searchDataSync')
    ->name('app-service-search-sync');

    Route::get('app-service/category-find/{id}', 'AssetLite\AppServiceProductController@tabWiseCategory');

    # App & Service details page
    Route::get('app-service/details/{type}/{id}', 'AssetLite\AppServiceProductDetailsController@productDetails')
        ->name('app_service.details.list');
    Route::get('app-service/details/{type}/{productID}/create', 'AssetLite\AppServiceProductDetailsController@create')
        ->name('app_service.details.create');
    Route::post('app-service/details/{type}/{id}/store', 'AssetLite\AppServiceProductDetailsController@store')
        ->name('app_service.details.store');
    Route::get('app-service/details/{type}/{id}/edit/{sectionID}', 'AssetLite\AppServiceProductDetailsController@edit')
        ->name('app_service.details.edit');
    Route::put('app-service/details/{type}/{id}/update/{sectionID}',
        'AssetLite\AppServiceProductDetailsController@update')
        ->name('app_service.details.update');
    Route::get('app-service/sections/{type}/{id}/destroy/{sectionID}',
        'AssetLite\AppServiceProductDetailsController@destroy')->name('app_service.sections.destroy');
    Route::post('app-service/details/{type}/{id}/fixed-section/',
        'AssetLite\AppServiceProductDetailsController@fixedSectionUpdate')
        ->name('app_service.details.fixed-section');
    Route::get('/app-service-sections-sortable', 'AssetLite\AppServiceProductDetailsController@sectionsSortable');
    Route::get('/app-service-component-attribute-sortable', 'AssetLite\ComponentController@multiAttributeSortable');

    # App & Service component
    Route::get('app-service/{type}/component/{id}/edit',
        'AssetLite\ComponentController@conponentEdit')->name('appservice.component.edit');
    Route::get('app-service/component/{type}/{id}',
        'AssetLite\ComponentController@conponentList')->name('appservice.component.list');
    Route::get('app-service/component/create',
        'AssetLite\ComponentController@conponentCreate')->name('appservice.component.create');
    Route::post('app-service/component/store',
        'AssetLite\ComponentController@conponentStore')->name('appservice.component.store');
    // Get component multi attr
    Route::get('app-service/component/itemattr',
        'AssetLite\ComponentController@conponentItemAttr')->name('appservice.component.itemattr');
    Route::post('app-service/component/itemattr/store',
        'AssetLite\ComponentController@conponentItemAttrStore')->name('appservice.component.itemattr.store');
    Route::post('app-service/component/itemattr/destory',
        'AssetLite\ComponentController@conponentItemAttrDestroy')->name('appservice.component.itemattr.destory');

    // Lead Management
    Route::get('lead-requested-list', 'AssetLite\LeadManagementController@index')
        ->name('lead-list');

    Route::get('lead-product-permission-form', 'AssetLite\LeadManagementController@productPermissionForm')
        ->name("permission.form");
    Route::post('lead-product-permission-save', 'AssetLite\LeadManagementController@productPermissionSave')
        ->name("permission.save");

    Route::get('lead-product-permission-edit/{user_id}', 'AssetLite\LeadManagementController@productPermissionEditForm')
        ->name("permission.edit");

    Route::post('lead-product-permission-update/{user_id}',
        'AssetLite\LeadManagementController@productPermissionUpdate')
        ->name("permission.update");

    Route::get('lead-product-permission/destroy/{id}', 'AssetLite\LeadManagementController@permissionDelete');

    Route::get('lead-product-permission', 'AssetLite\LeadManagementController@permittedUsersList');

    Route::get('lead-requested/details/{id}', 'AssetLite\LeadManagementController@viewDetails')
        ->name('lead.details');
    Route::put('lead-requested/change-status/{id}', 'AssetLite\LeadManagementController@changeStatus')
        ->name('lead.change_status');

//    Route::get('lead-requested/send-mail-form', 'AssetLite\LeadManagementController@sendMailForm')
//        ->name('lead.send_mail_form');

    //TODO:: Not use delete later
//    Route::post('lead-requested/send-mail', 'AssetLite\LeadManagementController@sendMail')
//        ->name('lead.send_mail');

    Route::get('download-pdf/{lead_id}', 'AssetLite\LeadManagementController@downloadPDF')
        ->name('download.pdf');

    Route::post('lead-data/excel-export', 'AssetLite\LeadManagementController@excelExport')
        ->name('lead_data.excel_export');

    Route::post('download/file', 'AssetLite\LeadManagementController@downloadFile');

    // Product Price Slab
    Route::get('product-price/slabs', 'AssetLite\ProductPriceSlabController@index');
    Route::get('product-price/slab/create', 'AssetLite\ProductPriceSlabController@priceSlabCreate');
    Route::post('product-price/slab/store', 'AssetLite\ProductPriceSlabController@priceSlabStore')
        ->name('priceSlab.store');
    Route::get('product-price/slab/details/{id}', 'AssetLite\ProductPriceSlabController@priceSlabEdit');
    Route::put('product-price/slab/update/{priceSlabId}', 'AssetLite\ProductPriceSlabController@updatePriceSlab')
        ->name('priceSlab.update');
    Route::post('product-price-slab-list', 'AssetLite\ProductPriceSlabController@priceSlabList')
        ->name('priceSlab.list.ajax');
    Route::post('product-price/slab-excel', 'AssetLite\ProductPriceSlabController@uploadPriceSlabExcel')
        ->name('priceSlab-excel.save');
    Route::get('product-price-slab-status-change/{rateId}',
        'AssetLite\ProductPriceSlabController@priceSlabStatusChange');
    Route::get('product-price-slab/destroy/{rateId?}', 'AssetLite\ProductPriceSlabController@deletePriceSlab');


    //Module Ethicks & complains
    Route::get('ethics-compliance', 'AssetLite\EthicsController@index');
    Route::post('ethics/update-page-info', 'AssetLite\EthicsController@updatePageInfo');
    Route::post('ethics/save-ethics-file', 'AssetLite\EthicsController@saveFile');
    Route::get('ethics/sort-ethics-file', 'AssetLite\EthicsController@sortFiles');
    Route::get('ethics/status-change/{id}', 'AssetLite\EthicsController@chanbgeStatus');
    Route::get('ethics/get-file-data/{id}', 'AssetLite\EthicsController@getFileData');
    Route::get('ethics/file-delete/{id}', 'AssetLite\EthicsController@fileDelete');

    // Faq
    Route::get('faq-categories', 'AssetLite\AlFaqController@categoryList');
    Route::get('faq-category/{id}/edit', 'AssetLite\AlFaqController@catEdit');
    Route::put('faq-category/{id}/update', 'AssetLite\AlFaqController@catUpdate')
        ->name('category.update');
    Route::get('faq/{cat_slug}', 'AssetLite\AlFaqController@index');
    Route::get('faq/{cat_slug}/create', 'AssetLite\AlFaqController@create');
    Route::post('faq/{cat_slug}/store', 'AssetLite\AlFaqController@store');
    Route::get('faq/{cat_slug}/{id}/edit', 'AssetLite\AlFaqController@edit');
    Route::put('faq/{cat_slug}/{id}/update', 'AssetLite\AlFaqController@update')
        ->name('faq.update');
    Route::get('faq/{cat_slug}/destroy/{id}', 'AssetLite\AlFaqController@destroy');

    Route::get('faq-sort', 'AssetLite\AlFaqController@faqSortable');


    // Media Press News Event
    Route::resource('press-news-event', 'AssetLite\MediaPressNewsEventController')->except(['show', 'destroy']);
    Route::get('faq/destroy/{id}', 'AssetLite\AlFaqController@destroy');

    //Customer Feedback List
    Route::get('customer-feedback/list', 'AssetLite\CustomerFeedbackController@index');
    Route::get('customer-feedback/get-data', 'AssetLite\CustomerFeedbackController@getFeedbacks')
        ->name('feedback.list');

    Route::get('customer-feedback/details/{feedbackId}', 'AssetLite\CustomerFeedbackController@feedbacksDetails')
        ->name('feedback.details');

    Route::get('customer-feedback/page-groping', 'AssetLite\CustomerFeedbackController@pageWiseRating')
        ->name('feedback.page-groping');


    //Customer Feedback Question
    Route::get('customer-feedback/questions', 'AssetLite\CustomerFeedbackQuesController@questions');
    Route::get('customer-feedback/add-question', 'AssetLite\CustomerFeedbackQuesController@addQuestion');
    Route::get('customer-feedback/edit-question/{id}', 'AssetLite\CustomerFeedbackQuesController@editQuestion');
    Route::post('customer-feedback/save-question', 'AssetLite\CustomerFeedbackQuesController@saveQuestion');
    Route::get('customer-feedback/question-delete/{id}', 'AssetLite\CustomerFeedbackQuesController@destroy');
    Route::get('customer-feedback/question-sortable', 'AssetLite\CustomerFeedbackQuesController@questionSortable');

    Route::get('press-news-event/destroy/{id}', 'AssetLite\MediaPressNewsEventController@destroy');

    // Media TVC Video
    Route::resource('tvc-video', 'AssetLite\MediaTvcVideoController')->except(['show', 'destroy']);
    Route::get('tvc-video/destroy/{id}', 'AssetLite\MediaTvcVideoController@destroy');

    // Media Landing Page
    Route::resource('landing-page-component', 'AssetLite\MediaLandingPageController')->except(['show', 'destroy']);
    Route::get('landing-page-component/destroy/{id}', 'AssetLite\MediaLandingPageController@destroy');
    Route::get('media-item-find/{type}', 'AssetLite\MediaLandingPageController@itemsFind');
    Route::get('/landing-page-sortable', 'AssetLite\MediaLandingPageController@landingPageSortable');

    Route::post('media-banner-image-landing/upload', 'AssetLite\MediaLandingPageController@bannerUpload')
        ->name('banner_image_landing.upload');
    Route::post('media-banner-image-tvc-video/upload', 'AssetLite\MediaTvcVideoController@bannerUpload')
        ->name('banner_image_tvc_video.upload');
    Route::post('media-banner-image-press-news/upload', 'AssetLite\MediaPressNewsEventController@bannerUpload')
        ->name('banner_image_press_news.upload');

    // 4g Campaign
    Route::resource('bl-4g-campaign', 'AssetLite\FourGCampaignController')->except(['show', 'destroy']);
    Route::get('bl-4g-campaign/destroy/{id}', 'AssetLite\FourGCampaignController@destroy');

    // 4G Landing Page
    Route::resource('bl-4g-landing-page', 'AssetLite\FourGLandingPageController')->except(['store', 'show', 'destroy']);
    Route::post('bl-4g-banner-image', 'AssetLite\FourGLandingPageController@bannerUpload')
        ->name('four_g_banner_image.upload');

    // 4G Devices
    Route::resource('bl-4g-devices', 'AssetLite\FourGDevicesController')->except(['show', 'destroy']);
    Route::get('bl-4g-devices/destroy/{id}', 'AssetLite\FourGDevicesController@destroy');

    // 4G Devices Tags
    Route::resource('bl-4g-device-tag', 'AssetLite\FourGDeviceTagController')->except(['show', 'destroy']);
    Route::get('bl-4g-device-tag/destroy/{id}', 'AssetLite\FourGDeviceTagController@destroy');

    // 4G Devices elegibility Message
    Route::resource('bl-4g-eligibility-msg', 'AssetLite\FourGEligibilityController')->except(['show', 'destroy']);
    Route::get('bl-4g-eligibility-msg/destroy/{id}', 'AssetLite\FourGEligibilityController@destroy');

    // Banglalink 3G
    Route::resource('bl-3g-landing-page', 'AssetLite\BanglalinkThreeGController')->except(['store', 'show', 'destroy']);
    Route::post('bl-3g-banner-image', 'AssetLite\BanglalinkThreeGController@bannerUpload')
        ->name('three_g_banner_image.upload');

    // Be A Partner
    Route::get('be-a-partner', 'AssetLite\BeAPartnerController@getBeAPartner');
    Route::get('be-a-partner/edit/{id}', 'AssetLite\BeAPartnerController@beAPartnerEdit')
        ->name('be-a-partner.edit');
    Route::post('be-a-partner/save/{id}', 'AssetLite\BeAPartnerController@beAPartnerSave');
    Route::get('be-a-partner/component-create', 'AssetLite\BeAPartnerController@componentCreateForm');
    Route::post('be-a-partner/component-store', 'AssetLite\BeAPartnerController@componentStore');
    Route::get('be-a-partner/component-edit/{id}', 'AssetLite\BeAPartnerController@componentEditForm');
    Route::put('be-a-partner/component-update/{id}', 'AssetLite\BeAPartnerController@componentUpdate')
        ->name('be_a_partner.component.update');
    Route::get('be-a-partner/component-delete/{id}', 'AssetLite\BeAPartnerController@componentDelete')
        ->name('be_a_partner.component.delete');

    //Access Logs
    Route::get('access-logs', 'AccessLogController@index');

    //Activity Logs
    Route::get('activity-logs', 'ActivityLogController@index');
    Route::get('activity-logs/{activityLogId}', 'ActivityLogController@show')->name('activity-logs.show');
    Route::post('activity-logs/search', 'ActivityLogController@search')->name('activity-logs.search');

    // Corporate Responsibility
    Route::resource('corporate-resp-section', 'AssetLite\CorporateRespSectionController')
        ->except('show', 'destroy', 'store');

    // Corporate Responsibility CR Strategy
    Route::resource('corporate/cr-strategy-section', 'AssetLite\CorporateCrStrategySectionController')
        ->except('show', 'destroy');
    Route::get('corporate/cr-strategy-section/destroy/{id}', 'AssetLite\CorporateCrStrategySectionController@destroy');
    Route::get('corporate/cr-strategy-section-sort', 'AssetLite\CorporateCrStrategySectionController@sectionSortable');

    //Section Component Corporate Responsibility
    Route::get('corporate/cr-strategy-component/{section_id}/list', 'AssetLite\CorpCrStrategyComponentController@index')
        ->name('cr-strategy-component.index');
    Route::get('corporate/cr-strategy-component/{section_id}/create',
        'AssetLite\CorpCrStrategyComponentController@create')
        ->name('cr-strategy-component.create');
    Route::post('corporate/cr-strategy-component/{section_id}/store',
        'AssetLite\CorpCrStrategyComponentController@store')
        ->name('cr-strategy-component.store');
    Route::get('corporate/cr-strategy-component/{section_id}/edit/{id}',
        'AssetLite\CorpCrStrategyComponentController@edit')
        ->name('cr-strategy-component.edit');
    Route::put('corporate/cr-strategy-component/{section_id}/update/{id}',
        'AssetLite\CorpCrStrategyComponentController@update')
        ->name('cr-strategy-component.update');
    Route::get('corporate/cr-strategy-component/{section_id}/destroy/{id}',
        'AssetLite\CorpCrStrategyComponentController@destroy');
    Route::get('corporate/cr-strategy-component-sort', 'AssetLite\CorpCrStrategyComponentController@sectionSortable');

    //CR-Strategy Details Component Corporate Responsibility
    Route::get('corporate/cr-strategy/component/{com_id}/details/list',
        'AssetLite\CorpCrStrategyComponentDetailsController@componentList')
        ->name('cr-strategy-details.index');
    Route::get('corporate/cr-strategy/component/{com_id}/details/create',
        'AssetLite\CorpCrStrategyComponentDetailsController@componentCreateForm')
        ->name('cr-strategy-details.create');
    Route::post('corporate/cr-strategy/component/{com_id}/details/store',
        'AssetLite\CorpCrStrategyComponentDetailsController@componentStore')
        ->name('cr-strategy-details.store');
    Route::get('corporate/cr-strategy/component/{com_id}/details/edit/{id}',
        'AssetLite\CorpCrStrategyComponentDetailsController@componentEditForm')
        ->name('cr-strategy-details.edit');
    Route::put('corporate/cr-strategy/component/{com_id}/details/update/{id}',
        'AssetLite\CorpCrStrategyComponentDetailsController@componentUpdate')
        ->name('cr-strategy-details.update');
    Route::get('corporate/cr-strategy/component/{com_id}/details/destroy/{id}',
        'AssetLite\CorpCrStrategyComponentDetailsController@componentDestroy')
        ->name('cr-strategy-details.destroy');
    Route::get('corporate/cr-strategy-details-sort',
        'AssetLite\CorpCrStrategyComponentDetailsController@componentSortable');

    Route::post('corporate/cr-strategy/component/details/banner-upload',
        'AssetLite\CorpCrStrategyComponentDetailsController@detailsBannerUpload')
        ->name('cr-strategy-details-banner-image.upload');


    // Case Study Corporate Responsibility Section
    Route::resource('corporate/case-study-section', 'AssetLite\CorpCaseStudySectionController')
        ->except('show', 'destroy');
    Route::get('corporate/case-study-section/destroy/{id}', 'AssetLite\CorpCaseStudySectionController@destroy');
    Route::get('corporate/case-study-section-sort', 'AssetLite\CorpCaseStudySectionController@sectionSortable');

    //Case Study Component Corporate Responsibility Component
    Route::get('corporate/case-study-component/{section_id}/list', 'AssetLite\CorpCaseStudyComponentController@index')
        ->name('case-study-component.index');
    Route::get('corporate/case-study-component/{section_id}/create',
        'AssetLite\CorpCaseStudyComponentController@create')
        ->name('case-study-component.create');
    Route::post('corporate/case-study-component/{section_id}/store', 'AssetLite\CorpCaseStudyComponentController@store')
        ->name('case-study-component.store');
    Route::get('corporate/case-study-component/{section_id}/edit/{id}',
        'AssetLite\CorpCaseStudyComponentController@edit')
        ->name('case-study-component.edit');
    Route::put('corporate/case-study-component/{section_id}/update/{id}',
        'AssetLite\CorpCaseStudyComponentController@update')
        ->name('case-study-component.update');
    Route::get('corporate/case-study-component/{section_id}/destroy/{id}',
        'AssetLite\CorpCaseStudyComponentController@destroy');
    Route::get('corporate/case-study-component-sort', 'AssetLite\CorpCaseStudyComponentController@sectionSortable');

    //Case Study Details Corporate Responsibility
    Route::get('corporate/case-study/component/{com_id}/details/list',
        'AssetLite\CorpCaseStudyComponentDetailsController@componentList')
        ->name('case-study-details.index');
    Route::get('corporate/case-study/component/{com_id}/details/create',
        'AssetLite\CorpCaseStudyComponentDetailsController@componentCreateForm')
        ->name('case-study-details.create');
    Route::post('corporate/case-study/component/{com_id}/details/store',
        'AssetLite\CorpCaseStudyComponentDetailsController@componentStore')
        ->name('case-study-details.store');
    Route::get('corporate/case-study/component/{com_id}/details/edit/{id}',
        'AssetLite\CorpCaseStudyComponentDetailsController@componentEditForm')
        ->name('case-study-details.edit');
    Route::put('corporate/case-study/component/{com_id}/details/update/{id}',
        'AssetLite\CorpCaseStudyComponentDetailsController@componentUpdate')
        ->name('case-study-details.update');
    Route::get('corporate/case-study/component/{com_id}/details/destroy/{id}',
        'AssetLite\CorpCaseStudyComponentDetailsController@componentDestroy')
        ->name('case-study-details.destroy');
    Route::get('corporate/case-study-details-sort',
        'AssetLite\CorpCaseStudyComponentDetailsController@componentSortable');

    Route::post('corporate/case-study/component/details/banner-upload',
        'AssetLite\CorpCaseStudyComponentDetailsController@detailsBannerUpload')
        ->name('case-study-details-banner-image.upload');

    // Initiative Tab Corporate Responsibility
    Route::resource('corporate/initiative-tab', 'AssetLite\CorpInitiativeTabController')
        ->except('show', 'destroy');
    Route::get('corporate/initiative-tab/destroy/{id}', 'AssetLite\CorpInitiativeTabController@destroy');
    Route::get('corporate/initiative-tab-sort', 'AssetLite\CorpInitiativeTabController@tabSortable');

    // Initiative Tab Component Corporate Responsibility
    Route::get('corporate/initiative-tab/{tab_id}/component/list',
        'AssetLite\CorpInitiativeTabComponentController@componentList')
        ->name('initiative_component.index');
    Route::get('corporate/initiative-tab/{tab_id}/component/create',
        'AssetLite\CorpInitiativeTabComponentController@componentCreateForm')
        ->name('initiative_component.create');
    Route::post('corporate/initiative-tab/{tab_id}/component/store',
        'AssetLite\CorpInitiativeTabComponentController@componentStore')
        ->name('initiative_component.store');
    Route::get('corporate/initiative-tab/{tab_id}/component/edit/{id}',
        'AssetLite\CorpInitiativeTabComponentController@componentEditForm')
        ->name('initiative_component.edit');
    Route::put('corporate/initiative-tab/{tab_id}/component/update/{id}',
        'AssetLite\CorpInitiativeTabComponentController@componentUpdate')
        ->name('initiative_component.update');
    Route::get('corporate/initiative-tab/{tab_id}/component/destroy/{id}',
        'AssetLite\CorpInitiativeTabComponentController@componentDestroy')
        ->name('initiative_component.destroy');
    Route::get('corporate/initiative-tab-component-sort',
        'AssetLite\CorpInitiativeTabComponentController@componentSortable');

    // Corporate Responsibility Contact Us page
    Route::resource('corporate-resp/contact-us-page-info', 'AssetLite\CorporateRespContactUsController')
        ->except('show', 'destroy', 'store');

    // Corporate Responsibility Contact Us Field
    Route::get('corporate/contact-us-field/{section_id}/list', 'AssetLite\CorpContactUsFieldController@index')
        ->name('contact-us-field.index');
    Route::get('corporate/contact-us-field/{section_id}/create', 'AssetLite\CorpContactUsFieldController@create')
        ->name('contact-us-field.create');
    Route::post('corporate/contact-us-field/{section_id}/store', 'AssetLite\CorpContactUsFieldController@store')
        ->name('contact-us-field.store');
    Route::get('corporate/contact-us-field/{section_id}/edit/{id}', 'AssetLite\CorpContactUsFieldController@edit')
        ->name('contact-us-field.edit');
    Route::put('corporate/contact-us-field/{section_id}/update/{id}', 'AssetLite\CorpContactUsFieldController@update')
        ->name('contact-us-field.update');
    Route::get('corporate/contact-us-field/{section_id}/destroy/{id}',
        'AssetLite\CorpContactUsFieldController@destroy');
//    Route::get('corporate/case-study-component-sort', 'AssetLite\CorpContactUsFieldController@sectionSortable');

    // Corporate Responsibility Contact Us Info List
    Route::get('corporate/contact-us-info', 'AssetLite\CorporateRespContactUsController@customerContactInfoList')
        ->name('contact-us-info.list');
    Route::get('corporate/contact-us/more-details/{id}',
        'AssetLite\CorporateRespContactUsController@showCustomerDetails')
        ->name('contact-us.more_details');

    // Referral List
    Route::get('referral-list', 'AssetLite\ReferralListController@index');

    // Dynamic Routes
    Route::resource('dynamic-routes', 'AssetLite\DynamicRouteController')->except('show', 'destroy');
    Route::get('dynamic-routes/destroy/{id}', 'AssetLite\DynamicRouteController@destroy');

    Route::get('component-multiple-data/{imgName}', "AssetLite\ComponentMultiDataController@findSingleData");

    // Ad Tech banner Store
    Route::post('ad-tech/store', 'AssetLite\MenuController@adTechStore')->name('adtech.store');

    // Business Types
    Route::resource('business-types', 'AssetLite\BusinessTypesController')->except(['show', 'destroy']);
    Route::get('business-types-sort', 'AssetLite\BusinessTypesController@typeSort');
    Route::get('business-types/destroy/{id}', 'AssetLite\BusinessTypesController@destroy');

    // Business Types Items
    Route::get('business-types-items-sort', 'AssetLite\BusinessTypesDatasController@typeSort');
    Route::get('business-types-items/{id}', 'AssetLite\BusinessTypesDatasController@index');
    Route::get('business-types-items/{id}/create', 'AssetLite\BusinessTypesDatasController@create');
    Route::post('business-types-items/{id}', 'AssetLite\BusinessTypesDatasController@store')->name('business-types-datas.store');
    Route::get('business-types-items/{business_type_id}/{id}/edit', 'AssetLite\BusinessTypesDatasController@edit')->name('business-types-datas.edit');
    Route::put('business-types-items/{business_type_id}/{id}/update', 'AssetLite\BusinessTypesDatasController@update')->name('business-types-datas.update');
    Route::get('business-types-items/{business_type_id}/destroy/{id}', 'AssetLite\BusinessTypesDatasController@destroy')->name('business-types-datas.delete');

    // Network Types
    Route::resource('network-types','AssetLite\NetworkTypesController')->except(['show', 'destroy']);
    Route::get('network-types-sort', 'AssetLite\NetworkTypesController@typeSort');
    Route::get('network-types/destroy/{id}', 'AssetLite\NetworkTypesController@destroy');
    // Blogs Details
    Route::resource('blog-post', 'AssetLite\BlogController')->except(['show', 'destroy']);
    Route::get('blog-post/destroy/{id}', 'AssetLite\BlogController@destroy');

    // Blog Search Data Sync
    Route::get('blog-post/search-data-sync', 'AssetLite\BlogController@searchDataSync');

    Route::resource('blog-categories', 'AssetLite\BlogCategoryController')->except(['show', 'destroy']);
    Route::get('blog-categories/destroy/{id}', 'AssetLite\BlogCategoryController@destroy');
    # Blogs Components
    Route::get('blog-component/{blog_id}/list', 'AssetLite\BlogDetailsController@index')
        ->name('blog-component.list');
    Route::get('blog-component/create', 'AssetLite\BlogDetailsController@componentCreate')
        ->name('blog-component.create');
    Route::post('blog-component/store', 'AssetLite\BlogDetailsController@componentStore')
        ->name('blog-component.store');
    Route::get('blog-component/edit/{comId}', 'AssetLite\BlogDetailsController@componentEdit')
        ->name('blog-component.edit');
    Route::post('blog-component/update/{comId}', 'AssetLite\BlogDetailsController@componentUpdate')
        ->name('blog-component.update');
    Route::get('blog-component/destroy/{comId}', 'AssetLite\BlogDetailsController@componentDestroy')
        ->name('blog-component.destroy');
    Route::get('blog-component-sort', 'AssetLite\BlogDetailsController@componentSortable');
    Route::post('blog-ad-tech/store', 'AssetLite\BlogDetailsController@adTechStore')->name('blog.adtech.store');

    // Blog Landing Page
    Route::resource('blog/landing-page-component', 'AssetLite\BlogLandingPageController')->except(['show', 'destroy']);
    Route::get('blog/landing-page-component/destroy/{id}', 'AssetLite\BlogLandingPageController@destroy');
    Route::get('blog-landing-page-sortable', 'AssetLite\BlogLandingPageController@landingPageSortable');

    // Ad Tech banner Store
    Route::post('ad-tech/store', 'AssetLite\MenuController@adTechStore')->name('adtech.store');

    // CSR Page
    Route::resource('csr-landing-page-component', 'AssetLite\CSRLandingPageController')->except(['show', 'destroy']);
    Route::get('csr-landing-page-component/destroy/{id}', 'AssetLite\CSRLandingPageController@destroy');
    Route::get('csr-landing-page-sortable', 'AssetLite\CSRLandingPageController@landingPageSortable');
    # CSR Post Components
    Route::resource('csr-post', 'AssetLite\CsrController')->except(['show', 'destroy']);
    Route::get('csr-post/destroy/{id}', 'AssetLite\CsrController@destroy');
    Route::resource('csr-categories', 'AssetLite\CsrCategoryController')->except(['show', 'destroy']);
    Route::get('csr-categories/destroy/{id}', 'AssetLite\CsrCategoryController@destroy');
    # CSR details Components
    Route::get('csr-component/{blog_id}/list', 'AssetLite\CsrDetailsController@index')
        ->name('csr-component.list');
    Route::get('csr-component/create', 'AssetLite\CsrDetailsController@componentCreate')
        ->name('csr-component.create');
    Route::post('csr-component/store', 'AssetLite\CsrDetailsController@componentStore')
        ->name('csr-component.store');
    Route::get('csr-component/edit/{comId}', 'AssetLite\CsrDetailsController@componentEdit')
        ->name('csr-component.edit');
    Route::post('csr-component/update/{comId}', 'AssetLite\CsrDetailsController@componentUpdate')
        ->name('csr-component.update');
    Route::get('csr-component/destroy/{comId}', 'AssetLite\CsrDetailsController@componentDestroy')
        ->name('csr-component.destroy');
    Route::get('csr-component-sort', 'AssetLite\CsrDetailsController@componentSortable');

    /*
     * terms and conditions
     */
    Route::get('al-terms-conditions/{featureName}', 'AssetLite\TermsAndConditionsController@show')->name('al-terms-conditions.show');
    Route::post('al-terms-conditions', 'AssetLite\TermsAndConditionsController@store')->name('al-terms-conditions.store');

    // BL Lab
    Route::group(['prefix' => 'bl-labs' ], function () {
        // Application List
        Route::get('application-list', 'AssetLite\BlLab\BlLabApplicationController@applicationList')
            ->name('application.list');
        Route::get('application-details/{application_id}', 'AssetLite\BlLab\BlLabApplicationController@applicationDetails')
            ->name('application.details');

        Route::get('banners', 'AssetLite\BlLab\BlLabApplicationController@banner');

        // Program
        Route::resource('program', 'AssetLite\BlLab\BlLabProgramController')->except('show', 'destroy');
        Route::get('program/destroy/{id}', 'AssetLite\BlLab\BlLabProgramController@destroy');
        // Industry
        Route::resource('industry', 'AssetLite\BlLab\BlLabIndustryController')->except('show', 'destroy');
        Route::get('industry/destroy/{id}', 'AssetLite\BlLab\BlLabIndustryController@destroy');
        // Profession
        Route::resource('profession', 'AssetLite\BlLab\BlLabProfessionController')->except('show', 'destroy');
        Route::get('profession/destroy/{id}', 'AssetLite\BlLab\BlLabProfessionController@destroy');
        // Institute/Organization
        Route::resource('institute-or-org', 'AssetLite\BlLab\BlLabInstituteOrgController')->except('show', 'destroy');
        Route::get('institute-or-org/destroy/{id}', 'AssetLite\BlLab\BlLabInstituteOrgController@destroy');
        // Education
        Route::resource('education', 'AssetLite\BlLab\BlLabEducationController')->except('show', 'destroy');
        Route::get('education/destroy/{id}', 'AssetLite\BlLab\BlLabEducationController@destroy');
        // Startup-Stage
        Route::resource('startup-stage', 'AssetLite\BlLab\BlLabStartupStageController')->except('show', 'destroy');
        Route::get('startup-stage/destroy/{id}', 'AssetLite\BlLab\BlLabStartupStageController@destroy');
    });

    // Site Map Generator
    Route::get('sitemap', 'AssetLite\SitemapController@showSiteMap');
    Route::get('generate-sitemap', 'AssetLite\SitemapController@generateSitemap');
});
