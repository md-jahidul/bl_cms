
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
    Route::post('config/update', 'AssetLite\ConfigController@update');

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


    // OFFER SUB MENU =====================================
    Route::get('offer-categories/{id}/{type}', 'AssetLite\OfferCategoryController@index')->name('child_menu');



    // Product Offers  ======================================
    Route::get('offers/{type}', 'AssetLite\ProductController@index')->name('product.list');
    Route::get('offers/{type}/create', 'AssetLite\ProductController@create')->name('product.create');
    Route::post('offers/{type}/store', 'AssetLite\ProductController@store')->name('product.store');
    Route::get('offers/{type}/{id}/edit/', 'AssetLite\ProductController@edit')->name('product.edit');
    Route::put('offers/{type}/{id}/update', 'AssetLite\ProductController@update')->name('product.update');
    Route::get('offers/{type}/{id}/show', 'AssetLite\ProductController@show')->name('product.show');

    // Product Offers Details  ======================================
    Route::get('offers/{type}/{id}/{offerType}/details', 'AssetLite\ProductController@productDetailsEdit')
        ->name('product.details');
    Route::put('offers/{type}/{id}/details/update', 'AssetLite\ProductController@productDetailsUpdate')
        ->name('product.details-update');

    Route::post('product-details/{simType}/{productId}/banner-image/related-product', 'AssetLite\ProductDetailsController@bannerImgRelatedPro')
        ->name('bannerImg-relatedPro');

    Route::get('product-details/{simType}/{productDetailsId}/section', 'AssetLite\ProductDetailsController@sectionList')
        ->name('section-list');

    Route::get('product-details/{type}/{productDetailsId}/section-create', 'AssetLite\ProductDetailsController@create')
        ->name('section-create');

    Route::post('product-details/{simType}/{productDetailsId}/section-store', 'AssetLite\ProductDetailsController@storeSection')
        ->name('section-store');

    Route::get('product-details/{simType}/{productDetailsId}/section-edit/{id}', 'AssetLite\ProductDetailsController@editSection')
        ->name('section-edit');

    Route::post('product-details/{simType}/{productDetailsId}/section-update/{id}', 'AssetLite\ProductDetailsController@updateSection')
        ->name('section-update');

    Route::get('product-details/{simType}/{productDetailsId}/section-delete/{id}', 'AssetLite\ProductDetailsController@sectionDestroy')
        ->name('section-destroy');

    Route::get('product-details/section-sortable', 'AssetLite\ProductDetailsController@sectionSortable');

    Route::get(
        'product-details/{productDetailsId}/section/{sid}/components-list',
        'AssetLite\ProductDetailsController@componentList'
    )->name('component-list');


    Route::get(
        'product-details/{productDetailsId}/section/{SectionId}/components-create',
        'AssetLite\ProductDetailsController@componentCreate'
    )->name('component-create');

    Route::post('product-details/{productDetailsId}/components-store/{SectionId}', 'AssetLite\ProductDetailsController@componentStore')
        ->name('component-store');

    Route::get(
        'product-details/{productDetailsId}/section/{sid}/component/{id}/edit',
        'AssetLite\ProductDetailsController@componentEdit'
    )->name('component-edit');

    Route::put('product-details/{productDetailsId}/section/{sid}/component/{id}/update', 'AssetLite\ProductDetailsController@componentUpdate')
        ->name('component-update');

    Route::get('product-details/{productDetailsId}/section/{sid}/component/{id}/delete', 'AssetLite\ProductDetailsController@componentDestroy')
        ->name('component-delete');

    Route::get('component-sortable', 'AssetLite\ProductDetailsController@componentSortable');

    Route::get('offers/{type}/{id}', 'AssetLite\ProductController@destroy');
    Route::get('trending-home', 'AssetLite\ProductController@trendingOfferHome')->name('trending-home');
//    Route::get('trending-home/{id}/edit', 'AssetLite\ProductController@homeEdit');
    Route::get('trending-home/sortable', 'AssetLite\ProductController@trendingOfferSortable');

    //amar offer details......
    Route::get('amaroffer/details', 'AssetLite\AmarOfferController@amarOfferDetails')->name('amaroffer.list');
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
    Route::get('delete-device-offer/{id}', 'AssetLite\DeviceOfferController@deleteDeviceOffer');



    // PARTNERS ====================================
    Route::resource('partners', 'AssetLite\PartnerController')->except(['show', 'destroy', 'update']);
    Route::post('partners/{id}', 'AssetLite\PartnerController@update');
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
    Route::post('partner-offers/{partner}/details/update', 'AssetLite\PartnerOfferController@offerDetailsUpdate')
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


    // Search ======================================================
    Route::get('popular-search', 'AssetLite\SearchController@index');
    Route::get('save-search-limit', 'AssetLite\SearchController@saveLimit')->name('save.search.limit');
    Route::get('popular-search-create', 'AssetLite\SearchController@popularSearchCreate');
    Route::get('search-product-list', 'AssetLite\SearchController@getProductList')->name('search.get.product.list');

    Route::post('popular-search-save', 'AssetLite\SearchController@popularSearchSave')->name('popular.search.save');

    Route::get('search-popular-edit/{keywordId}', 'AssetLite\SearchController@popularSearchEdit');
    Route::post('popular-search-update', 'AssetLite\SearchController@popularSearchUpdate')->name('popular.search.update');


    Route::get('popular-status-change/{keywordId}', 'AssetLite\SearchController@popularSearchStatus');
    Route::get('popular-search-sort-change', 'AssetLite\SearchController@popularSortChange');
    Route::get('popular-search-delete/{keywordId}', 'AssetLite\SearchController@deletePopularSearch');

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
    Route::post('popular-search-update', 'AssetLite\SearchController@popularSearchUpdate')->name('popular.search.update');

    Route::get('popular-status-change/{keywordId}', 'AssetLite\SearchController@popularSearchStatus');
    Route::get('popular-search-delete/{keywordId}', 'AssetLite\SearchController@deletePopularSearch');

    // Easy Payment Card ============================================
    Route::get('easy-payment-card', 'AssetLite\EasyPaymentCardController@index');
    Route::post('easy-payment-card-list', 'AssetLite\EasyPaymentCardController@getEasyPaymentCardList')->name('easypaymentcard.list.ajax');
    Route::post('upload-payment-card-excel', 'AssetLite\EasyPaymentCardController@uploadCardByExcel')
        ->name('payment.card.excel.save');
    Route::get('payment-card-status-change', 'AssetLite\EasyPaymentCardController@cardStatusChange')
        ->name('payment.card.status.change');
    Route::get('delete-easy-payment-card/{id?}', 'AssetLite\EasyPaymentCardController@deletePaymentCard');


    // Business Module ============================================
    Route::get('business-general', 'AssetLite\BusinessGeneralController@index')->name('business.general');


    //__category
    Route::get('business-category-name-change', 'AssetLite\BusinessGeneralController@categoryNameChange')->name('business.category.name.save');
    Route::get('business-category-home-status-change', 'AssetLite\BusinessGeneralController@categoryStatusChange')->name('business.category.home.status.change');
    Route::post('business-category-banner-save', 'AssetLite\BusinessGeneralController@categoryBannerSave')
        ->name('business.category.banner.save');


    Route::get('business-category-sort-change', 'AssetLite\BusinessGeneralController@categorySortChange')->name('business.category.sort.save');

    //sliding speed

    Route::get('business-save-sliding-speed', 'AssetLite\BusinessGeneralController@saveSlidingSpeed')
        ->name('business.sliding.speed.save');

    //__banner
    Route::post('business-banner-photo-upload', 'AssetLite\BusinessGeneralController@bannerPhotoSave')->name('business.banner.photo.save');

    //__news
    Route::post('business-news-save', 'AssetLite\BusinessGeneralController@homeNewsSave')->name('business.news.save');
    Route::get('get-single-news/{newsId}', 'AssetLite\BusinessGeneralController@getNewsById')->name('get.news.by.id');
    Route::get('business-news-sort', 'AssetLite\BusinessGeneralController@newsSortChange');
    Route::get('business-news-status-change/{id}', 'AssetLite\BusinessGeneralController@newsStatusChange');
    Route::get('business-news-delete/{id}', 'AssetLite\BusinessGeneralController@newsDelete');

    //__features
    Route::post('business-feature-save', 'AssetLite\BusinessGeneralController@featureSave')->name('business.feature.save');
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
    Route::post('business-package/update', 'AssetLite\BusinessPackageController@update')->name('business.package.update');
    Route::get('business-package-delete/{packageId}', 'AssetLite\BusinessPackageController@delete');

    //__Category Internet Package
    Route::get('business-internet', 'AssetLite\BusinessInternetController@index');
    Route::get('business-internet-create', 'AssetLite\BusinessInternetController@internetCreate');
    Route::post('business-internet-save', 'AssetLite\BusinessInternetController@saveInternetPackage');
    Route::get('business-internet-edit/{internetId}', 'AssetLite\BusinessInternetController@internetEdit');
    Route::post('business-internet-update', 'AssetLite\BusinessInternetController@updateInternetPackage');
    Route::post('business-internet-package-list', 'AssetLite\BusinessInternetController@internetPackageList')->name("business.internet.list.ajax");
    Route::post('business-internet-excel', 'AssetLite\BusinessInternetController@uploadInternetExcel')
        ->name('business.internet.excel.save');
    Route::get('business-internet-status-change/{pakcageId}', 'AssetLite\BusinessInternetController@packageStatusChange');
    Route::get('business-internet-home-show/{pakcageId}', 'AssetLite\BusinessInternetController@packageHomeShow');
    Route::get('delete-business-internet-package/{pakcageId?}', 'AssetLite\BusinessInternetController@deletePackage');

    //Category B. Solution, IOT & Others
    Route::get('business-other-services', 'AssetLite\BusinessOthersController@index')->name('business.other.services');
    Route::get('business-others/create', 'AssetLite\BusinessOthersController@create');
    Route::get('business-others-home-show/{serviceId}', 'AssetLite\BusinessOthersController@homeShow');
    Route::get('business-others-home-slider/{serviceId}', 'AssetLite\BusinessOthersController@homeSlider');
    Route::get('business-others-active/{serviceId}', 'AssetLite\BusinessOthersController@activationStatus');
    Route::get('business-others-sort-change', 'AssetLite\BusinessOthersController@sortChange');
    Route::get('business-others-service-delete/{serviceId}', 'AssetLite\BusinessOthersController@deleteService');
    Route::get('business-others-service-edit/{serviceId}', 'AssetLite\BusinessOthersController@edit');
    Route::post('business-others-update', 'AssetLite\BusinessOthersController@update')->name("business.other.update");

    Route::get('business-others-components/{serviceId}', 'AssetLite\BusinessOthersController@addComponent');
    Route::post('business-others-save', 'AssetLite\BusinessOthersController@saveService')->name("business.other.save");
    Route::post('business-component-save', 'AssetLite\BusinessOthersController@saveComponents')->name("business.component.save");
    Route::get('business-others-components-list/{serviceId}', 'AssetLite\BusinessOthersController@componentList');

    Route::get('business-others-component-edit/{serviceId}/{position}/{type}', 'AssetLite\BusinessOthersController@editComponent');
    Route::post('business-others-component-update', 'AssetLite\BusinessOthersController@updateComponents')
        ->name("business.component.update");

    Route::get('business-others-component-delete/{serviceId}/{position}/{type}', 'AssetLite\BusinessOthersController@deleteComponent');
    Route::get('business-other-component-sort', 'AssetLite\BusinessOthersController@sortComponent');


    // Roaming Module ============================================
    Route::get('roaming-general', 'AssetLite\RoamingGeneralController@index');
    Route::get('roaming/get-single-category/{catId}', 'AssetLite\RoamingGeneralController@getSingleCategory');
    Route::post('roaming/update-category', 'AssetLite\RoamingGeneralController@updateCategory');
    Route::get('roaming/category-sort', 'AssetLite\RoamingGeneralController@categorySortChange');

    Route::get('roaming/general-page-component/{type}/{pageId?}', 'AssetLite\RoamingGeneralController@editPage');
    Route::post('roaming/update-general-page', 'AssetLite\RoamingGeneralController@updatePage');
    Route::get('roaming/page-component-sort', 'AssetLite\RoamingGeneralController@componentSortChange');

    // Operator
    Route::get('roaming/operators', 'AssetLite\RoamingOperatorController@index');
    Route::get('roaming/operator/create', 'AssetLite\RoamingOperatorController@operatorCreate');
    Route::post('roaming/operator/store', 'AssetLite\RoamingOperatorController@operatorStore')
        ->name('operator.store');
    Route::get('roaming/operator/edit/{id}', 'AssetLite\RoamingOperatorController@operatorEdit');
    Route::put('roaming/operator/update/{operatorId}', 'AssetLite\RoamingOperatorController@updateOperator')
        ->name('operator.update');
    Route::post('roaming-operator-list', 'AssetLite\RoamingOperatorController@roamingOperatorList')
        ->name('roaming.operator.list.ajax');
    Route::post('roaming/operator-excel', 'AssetLite\RoamingOperatorController@uploadOperatorExcel')
        ->name('roaming.operator-excel.save');
    Route::get('roaming-operator-status-change/{operatorId}', 'AssetLite\RoamingOperatorController@operatorStatusChange');
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
    Route::get('roaming/bundle/edit/{id}', 'AssetLite\RoamingBundleController@bundleEdit');
    Route::put('roaming/bundle/update/{bundleId}', 'AssetLite\RoamingBundleController@updateBundle')
        ->name('bundle.update');
    Route::post('roaming-bundle-list', 'AssetLite\RoamingBundleController@roamingBundleList')
        ->name('roaming.bundle.list.ajax');
    Route::post('roaming/bundle-excel', 'AssetLite\RoamingBundleController@uploadBundleExcel')
        ->name('roaming.bundle-excel.save');
    Route::get('roaming-bundle-status-change/{rateId}', 'AssetLite\RoamingBundleController@bundleStatusChange');
    Route::get('roaming-bundle/destroy/{rateId?}', 'AssetLite\RoamingBundleController@deleteBundle');


    // eCarrer ============================================
    Route::get('life-at-banglalink/general', 'AssetLite\EcareerController@generalIndex')->name('life.at.banglalink.general');
    Route::get('life-at-banglalink/general/create', 'AssetLite\EcareerController@generalCreate')->name('life.at.banglalink.general.create');
    Route::post('life-at-banglalink/general/store', 'AssetLite\EcareerController@generalStore')->name('life.at.banglalink.general.store');
    Route::get('life-at-banglalink/general/{id}/edit', 'AssetLite\EcareerController@generalEdit')->name('life.at.banglalink.general.edit');
    Route::post('life-at-banglalink/general/{id}/update', 'AssetLite\EcareerController@generalUpdate')->name('life.at.banglalink.general.update');
    Route::get('life-at-banglalink/general/destroy/{id}', 'AssetLite\EcareerController@generalDestroy')->name('life.at.banglalink.general.destroy');


    // eCarrer Items ============================================
    Route::get('ecarrer-items/{parent_id}/list', 'AssetLite\EcareerItemController@index')->name('ecarrer.items.list');
    Route::get('ecarrer-items/{parent_id}/create', 'AssetLite\EcareerItemController@create')->name('ecarrer.items.create');
    Route::post('ecarrer-items/{parent_id}/store', 'AssetLite\EcareerItemController@store')->name('ecarrer.items.store');
    Route::get('ecarrer-items/{parent_id}/{id}/edit', 'AssetLite\EcareerItemController@edit')->name('ecarrer.items.edit');

    Route::post('ecarrer-items/{parent_id}/{id}/update', 'AssetLite\EcareerItemController@update')->name('ecarrer.items.update');
    Route::get('ecarrer-items/{parent_id}/destroy/{id}', 'AssetLite\EcareerItemController@destroy')->name('ecarrer.items.destroy');

    // eCarrer Life at banglalink teams =========================================================
    Route::get('life-at-banglalink/teams', 'AssetLite\EcareerController@teamsIndex')->name('life.at.banglalink.teams');
    Route::get('life-at-banglalink/teams/create', 'AssetLite\EcareerController@teamsCreate')->name('life.at.banglalink.teams.create');
    Route::post('life-at-banglalink/teams/store', 'AssetLite\EcareerController@teamsStore')->name('life.at.banglalink.teams.store');

    Route::get('life-at-banglalink/teams/{id}/edit', 'AssetLite\EcareerController@teamsEdit')->name('life.at.banglalink.teams.edit');

    Route::post('life-at-banglalink/teams/{id}/update', 'AssetLite\EcareerController@teamsUpdate')->name('life.at.banglalink.teams.update');
    Route::get('life-at-banglalink/teams/destroy/{id}', 'AssetLite\EcareerController@teamsDestroy')->name('life.at.banglalink.teams.destroy');


    // eCarrer Life at banglalink diversity =========================================================
    Route::get('life-at-banglalink/diversity', 'AssetLite\EcareerController@diversityIndex')->name('life.at.banglalink.diversity');
    Route::get('life-at-banglalink/diversity/create', 'AssetLite\EcareerController@diversityCreate')->name('life.at.banglalink.diversity.create');
    Route::post('life-at-banglalink/diversity/store', 'AssetLite\EcareerController@diversityStore')->name('life.at.banglalink.diversity.store');

    Route::get('life-at-banglalink/diversity/{id}/edit', 'AssetLite\EcareerController@diversityEdit')->name('life.at.banglalink.diversity.edit');

    Route::post('life-at-banglalink/diversity/{id}/update', 'AssetLite\EcareerController@diversityUpdate')->name('life.at.banglalink.diversity.update');
    Route::get('life-at-banglalink/diversity/destroy/{id}', 'AssetLite\EcareerController@diversityDestroy')->name('life.at.banglalink.diversity.destroy');


    // eCarrer Life at banglalink Events & Activities =========================================================
    Route::get('life-at-banglalink/events', 'AssetLite\EcareerController@eventsIndex')->name('life.at.banglalink.events');
    Route::get('life-at-banglalink/events/create', 'AssetLite\EcareerController@eventsCreate')->name('life.at.banglalink.events.create');
    Route::post('life-at-banglalink/events/store', 'AssetLite\EcareerController@eventsStore')->name('life.at.banglalink.events.store');

    Route::get('life-at-banglalink/events/{id}/edit', 'AssetLite\EcareerController@eventsEdit')->name('life.at.banglalink.events.edit');

    Route::post('life-at-banglalink/events/{id}/update', 'AssetLite\EcareerController@eventsUpdate')->name('life.at.banglalink.events.update');
    Route::get('life-at-banglalink/events/destroy/{id}', 'AssetLite\EcareerController@eventsDestroy')->name('life.at.banglalink.events.destroy');


    // eCarrer Life at banglalink Top Banner menu =========================================================
    Route::get('life-at-banglalink/topbanner', 'AssetLite\EcareerController@topbannerIndex')->name('life.at.banglalink.topbanner');
    Route::get('life-at-banglalink/topbanner/create', 'AssetLite\EcareerController@topbannerCreate')->name('life.at.banglalink.topbanner.create');
    Route::post('life-at-banglalink/topbanner/store', 'AssetLite\EcareerController@topbannerStore')->name('life.at.banglalink.topbanner.store');

    Route::get('life-at-banglalink/topbanner/{id}/edit', 'AssetLite\EcareerController@topbannerEdit')->name('life.at.banglalink.topbanner.edit');

    Route::post('life-at-banglalink/topbanner/{id}/update', 'AssetLite\EcareerController@topbannerUpdate')->name('life.at.banglalink.topbanner.update');
    Route::get('life-at-banglalink/topbanner/destroy/{id}', 'AssetLite\EcareerController@topbannerDestroy')->name('life.at.banglalink.topbanner.destroy');

    // eCarrer Contact us  =========================================================
    Route::get('life-at-banglalink/contact', 'AssetLite\EcareerController@contactIndex')->name('life.at.banglalink.contact');
    Route::get('life-at-banglalink/contact/create', 'AssetLite\EcareerController@contactCreate')->name('life.at.banglalink.contact.create');
    Route::post('life-at-banglalink/contact/store', 'AssetLite\EcareerController@contactStore')->name('life.at.banglalink.contact.store');

    Route::get('life-at-banglalink/contact/{id}/edit', 'AssetLite\EcareerController@contactEdit')->name('life.at.banglalink.contact.edit');

    Route::post('life-at-banglalink/contact/{id}/update', 'AssetLite\EcareerController@contactUpdate')->name('life.at.banglalink.contact.update');
    Route::get('life-at-banglalink/contact/destroy/{id}', 'AssetLite\EcareerController@contactDestroy')->name('life.at.banglalink.contact.destroy');


    // eCarrer Vacancy  =========================================================
    Route::get('vacancy/pioneer', 'AssetLite\EcareerController@pioneerIndex')->name('vacancy.pioneer');
    Route::get('vacancy/pioneer/create', 'AssetLite\EcareerController@pioneerCreate')->name('vacancy.pioneer.create');
    Route::post('vacancy/pioneer/store', 'AssetLite\EcareerController@pioneerStore')->name('vacancy.pioneer.store');

    Route::get('vacancy/pioneer/{id}/edit', 'AssetLite\EcareerController@pioneerEdit')->name('vacancy.pioneer.edit');

    Route::post('vacancy/pioneer/{id}/update', 'AssetLite\EcareerController@pioneerUpdate')->name('vacancy.pioneer.update');
    Route::get('vacancy/pioneer/destroy/{id}', 'AssetLite\EcareerController@pioneerDestroy')->name('vacancy.pioneer.destroy');


    // eCarrer Vacancy icon box =========================================================
    Route::get('vacancy/viconbox', 'AssetLite\EcareerController@viconboxIndex')->name('vacancy.viconbox');
    Route::get('vacancy/viconbox/create', 'AssetLite\EcareerController@viconboxCreate')->name('vacancy.viconbox.create');
    Route::post('vacancy/viconbox/store', 'AssetLite\EcareerController@viconboxStore')->name('vacancy.viconbox.store');

    Route::get('vacancy/viconbox/{id}/edit', 'AssetLite\EcareerController@viconboxEdit')->name('vacancy.viconbox.edit');

    Route::post('vacancy/viconbox/{id}/update', 'AssetLite\EcareerController@viconboxUpdate')->name('vacancy.viconbox.update');
    Route::get('vacancy/viconbox/destroy/{id}', 'AssetLite\EcareerController@viconboxDestroy')->name('vacancy.viconbox.destroy');

    // eCarrer Programs general =========================================================
    Route::get('programs/progeneral/{type}/create', 'AssetLite\EcareerController@progeneralCreate')->name('programs.progeneral.create');
    Route::post('programs/progeneral/store', 'AssetLite\EcareerController@progeneralStore')->name('programs.progeneral.store');

    Route::get('programs/progeneral/{id}/{type}/edit', 'AssetLite\EcareerController@progeneralEdit')->name('programs.progeneral.edit');
    Route::post('programs/progeneral/{id}/update', 'AssetLite\EcareerController@progeneralUpdate')->name('programs.progeneral.update');
    Route::get('programs/progeneral/destroy/{id}', 'AssetLite\EcareerController@progeneralDestroy')->name('programs.progeneral.destroy');

    Route::get('programs/progeneral/{type}', 'AssetLite\EcareerController@progeneralIndex')->name('programs.progeneral');



    // eCarrer Programs icon box =========================================================
    Route::get('programs/proiconbox', 'AssetLite\EcareerController@proiconboxIndex')->name('programs.proiconbox');
    Route::get('programs/proiconbox/create', 'AssetLite\EcareerController@proiconboxCreate')->name('programs.proiconbox.create');
    Route::post('programs/proiconbox/store', 'AssetLite\EcareerController@proiconboxStore')->name('programs.proiconbox.store');

    Route::get('programs/proiconbox/{id}/edit', 'AssetLite\EcareerController@proiconboxEdit')->name('programs.proiconbox.edit');

    Route::post('programs/proiconbox/{id}/update', 'AssetLite\EcareerController@proiconboxUpdate')->name('programs.proiconbox.update');
    Route::get('programs/proiconbox/destroy/{id}', 'AssetLite\EcareerController@proiconboxDestroy')->name('programs.proiconbox.destroy');

    // eCarrer Programs Photo gallery =========================================================
    Route::get('programs/photogallery', 'AssetLite\EcareerController@photogalleryIndex')->name('programs.photogallery');
    Route::get('programs/photogallery/create', 'AssetLite\EcareerController@photogalleryCreate')->name('programs.photogallery.create');
    Route::post('programs/photogallery/store', 'AssetLite\EcareerController@photogalleryStore')->name('programs.photogallery.store');

    Route::get('programs/photogallery/{id}/edit', 'AssetLite\EcareerController@photogalleryEdit')->name('programs.photogallery.edit');

    Route::post('programs/photogallery/{id}/update', 'AssetLite\EcareerController@photogalleryUpdate')->name('programs.photogallery.update');
    Route::get('programs/photogallery/destroy/{id}', 'AssetLite\EcareerController@photogalleryDestroy')->name('programs.photogallery.destroy');

    // eCarrer Programs SAP Previous Batches =========================================================
    Route::get('programs/sapbatches', 'AssetLite\EcareerController@sapbatchesIndex')->name('programs.sapbatches');
    Route::get('programs/sapbatches/create', 'AssetLite\EcareerController@sapbatchesCreate')->name('programs.sapbatches.create');
    Route::post('programs/sapbatches/store', 'AssetLite\EcareerController@sapbatchesStore')->name('programs.sapbatches.store');

    Route::get('programs/sapbatches/{id}/edit', 'AssetLite\EcareerController@sapbatchesEdit')->name('programs.sapbatches.edit');

    Route::post('programs/sapbatches/{id}/update', 'AssetLite\EcareerController@sapbatchesUpdate')->name('programs.sapbatches.update');
    Route::get('programs/sapbatches/destroy/{id}', 'AssetLite\EcareerController@sapbatchesDestroy')->name('programs.sapbatches.destroy');
    // eCarrer Programs Ennovators Previous Batches =========================================================
    Route::get('programs/ennovatorbatches', 'AssetLite\EcareerController@ennovatorbatchesIndex')->name('programs.ennovatorbatches');
    Route::get('programs/ennovatorbatches/create', 'AssetLite\EcareerController@ennovatorbatchesCreate')->name('programs.ennovatorbatches.create');
    Route::post('programs/ennovatorbatches/store', 'AssetLite\EcareerController@ennovatorbatchesStore')->name('programs.ennovatorbatches.store');

    Route::get('programs/ennovatorbatches/{id}/edit', 'AssetLite\EcareerController@ennovatorbatchesEdit')->name('programs.ennovatorbatches.edit');

    Route::post('programs/ennovatorbatches/{id}/update', 'AssetLite\EcareerController@ennovatorbatchesUpdate')->name('programs.ennovatorbatches.update');
    Route::get('programs/ennovatorbatches/destroy/{id}', 'AssetLite\EcareerController@ennovatorbatchesDestroy')->name('programs.ennovatorbatches.destroy');

    # ecareer programs top tab
    Route::get('programs/tab-title', 'AssetLite\EcareerController@tabTitleIndex')->name('programs.tab.title');
    Route::get('programs/tab-title/{id}/edit', 'AssetLite\EcareerController@tabTitleEdit')->name('programs.tab.title.edit');
    Route::post('programs/tab-title/{id}/update', 'AssetLite\EcareerController@tabTitleUpdate')->name('programs.tab.title.update');
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

    Route::get('app-service/category-find/{id}', 'AssetLite\AppServiceProductController@tabWiseCategory');


    # App & Service details page
    Route::get('app-service/details/{type}/{id}', 'AssetLite\AppServiceProductDetailsController@productDetails')
        ->name('app_service.details.list');

    Route::post('app-service/details/{type}/{id}/store', 'AssetLite\AppServiceProductDetailsController@store')
        ->name('app_service.details.store');

    Route::get('app-service/details/{type}/{id}/edit/{sectionID}', 'AssetLite\AppServiceProductDetailsController@edit')
        ->name('app_service.details.edit');

    Route::put('app-service/details/{type}/{id}/update/{sectionID}', 'AssetLite\AppServiceProductDetailsController@update')
        ->name('app_service.details.update');

    Route::get('app-service/sections/{type}/{id}/destroy/{sectionID}', 'AssetLite\AppServiceProductDetailsController@destroy')->name('app_service.sections.destroy');



    Route::post('app-service/details/{type}/{id}/fixed-section/', 'AssetLite\AppServiceProductDetailsController@fixedSectionUpdate')
        ->name('app_service.details.fixed-section');

    Route::get('/app-service-sections-sortable', 'AssetLite\AppServiceProductDetailsController@sectionsSortable');
    Route::get('/app-service-component-attribute-sortable', 'AssetLite\ComponentController@multiAttributeSortable');

    # App & Service component
    Route::get('app-service/{type}/component/{id}/edit', 'AssetLite\ComponentController@conponentEdit')->name('appservice.component.edit');
    Route::get('app-service/component/{type}/{id}', 'AssetLite\ComponentController@conponentList')->name('appservice.component.list');
    Route::get('app-service/component/create', 'AssetLite\ComponentController@conponentCreate')->name('appservice.component.create');
    Route::post('app-service/component/store', 'AssetLite\ComponentController@conponentStore')->name('appservice.component.store');
    // Get component multi attr
    Route::get('app-service/component/itemattr', 'AssetLite\ComponentController@conponentItemAttr')->name('appservice.component.itemattr');
    Route::post('app-service/component/itemattr/store', 'AssetLite\ComponentController@conponentItemAttrStore')->name('appservice.component.itemattr.store');
    Route::post('app-service/component/itemattr/destory', 'AssetLite\ComponentController@conponentItemAttrDestroy')->name('appservice.component.itemattr.destory');


    // Lead Management ======================================================
    Route::get('lead-requested-list', 'AssetLite\LeadManagementController@leadRequestedList')
        ->name('lead-list');
    Route::get('lead-requested/details/{id}', 'AssetLite\LeadManagementController@viewDetails')
        ->name('lead.details');
    Route::put('lead-requested/change-status/{id}', 'AssetLite\LeadManagementController@changeStatus')
        ->name('lead.change_status');
});
