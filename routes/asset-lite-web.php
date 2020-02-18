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
    Route::get('about-us/destroy/{id}', 'AssetLite\AboutUsController@destroy');

    Route::resource('management', 'AssetLite\ManagementController')->except(['show', 'destroy']);
    Route::get('management/destroy/{id}', 'AssetLite\ManagementController@destroy');
    Route::get('management-sortable', 'AssetLite\ManagementController@managementSortable');



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
    Route::get('business-category-sort-change', 'AssetLite\BusinessGeneralController@categorySortChange')->name('business.category.sort.save');

    //__banner
    Route::post('business-banner-photo-upload', 'AssetLite\BusinessGeneralController@bannerPhotoSave')->name('business.banner.photo.save');

    //__news
    Route::post('business-news-save', 'AssetLite\BusinessGeneralController@homeNewsSave')->name('business.news.save');
    Route::get('get-single-news/{newsId}', 'AssetLite\BusinessGeneralController@getNewsById')->name('get.news.by.id');
    Route::get('business-news-status-change/{id}', 'AssetLite\BusinessGeneralController@newsStatusChange');
    Route::get('business-news-delete/{id}', 'AssetLite\BusinessGeneralController@newsDelete');

    //__features
    Route::post('business-feature-save', 'AssetLite\BusinessGeneralController@featureSave')->name('business.feature.save');
    Route::get('get-single-feature/{featureId}', 'AssetLite\BusinessGeneralController@getFeatureById');
    Route::get('business-feature-sort', 'AssetLite\BusinessGeneralController@featureSortChange')->name('business.feature.sort.save');
    Route::get('business-feature-status-change/{id}', 'AssetLite\BusinessGeneralController@featureStatusChange');
    Route::get('business-feature-delete/{id}', 'AssetLite\BusinessGeneralController@featureDelete');





    // eCarrer ============================================
    Route::get('life-at-banglalink/general', 'AssetLite\EcarrerController@generalIndex')->name('life.at.banglalink.general');
    Route::get('life-at-banglalink/general/create', 'AssetLite\EcarrerController@generalCreate')->name('life.at.banglalink.general.create');
    Route::post('life-at-banglalink/general/store', 'AssetLite\EcarrerController@generalStore')->name('life.at.banglalink.general.store');
    Route::get('life-at-banglalink/general/{id}/edit', 'AssetLite\EcarrerController@generalEdit')->name('life.at.banglalink.general.edit');
    Route::post('life-at-banglalink/general/{id}/update', 'AssetLite\EcarrerController@generalUpdate')->name('life.at.banglalink.general.update');
    Route::get('life-at-banglalink/general/destroy/{id}', 'AssetLite\EcarrerController@generalDestroy')->name('life.at.banglalink.general.destroy');


    // eCarrer Items ============================================
    Route::get('ecarrer-items/{parent_id}/list', 'AssetLite\EcarrerItemController@index')->name('ecarrer.items.list');
    Route::get('ecarrer-items/{parent_id}/create', 'AssetLite\EcarrerItemController@create')->name('ecarrer.items.create');
    Route::post('ecarrer-items/{parent_id}/store', 'AssetLite\EcarrerItemController@store')->name('ecarrer.items.store');
    Route::get('ecarrer-items/{parent_id}/{id}/edit', 'AssetLite\EcarrerItemController@edit')->name('ecarrer.items.edit');

    Route::post('ecarrer-items/{parent_id}/{id}/update', 'AssetLite\EcarrerItemController@update')->name('ecarrer.items.update');
    Route::get('ecarrer-items/{parent_id}/destroy/{id}', 'AssetLite\EcarrerItemController@destroy')->name('ecarrer.items.destroy');

    // eCarrer Life at banglalink teams =========================================================
    Route::get('life-at-banglalink/teams', 'AssetLite\EcarrerController@teamsIndex')->name('life.at.banglalink.teams');
    Route::get('life-at-banglalink/teams/create', 'AssetLite\EcarrerController@teamsCreate')->name('life.at.banglalink.teams.create');
    Route::post('life-at-banglalink/teams/store', 'AssetLite\EcarrerController@teamsStore')->name('life.at.banglalink.teams.store');

    Route::get('life-at-banglalink/teams/{id}/edit', 'AssetLite\EcarrerController@teamsEdit')->name('life.at.banglalink.teams.edit');

    Route::post('life-at-banglalink/teams/{id}/update', 'AssetLite\EcarrerController@teamsUpdate')->name('life.at.banglalink.teams.update');
    Route::get('life-at-banglalink/teams/destroy/{id}', 'AssetLite\EcarrerController@teamsDestroy')->name('life.at.banglalink.teams.destroy');


    // eCarrer Life at banglalink diversity =========================================================
    Route::get('life-at-banglalink/diversity', 'AssetLite\EcarrerController@diversityIndex')->name('life.at.banglalink.diversity');
    Route::get('life-at-banglalink/diversity/create', 'AssetLite\EcarrerController@diversityCreate')->name('life.at.banglalink.diversity.create');
    Route::post('life-at-banglalink/diversity/store', 'AssetLite\EcarrerController@diversityStore')->name('life.at.banglalink.diversity.store');

    Route::get('life-at-banglalink/diversity/{id}/edit', 'AssetLite\EcarrerController@diversityEdit')->name('life.at.banglalink.diversity.edit');

    Route::post('life-at-banglalink/diversity/{id}/update', 'AssetLite\EcarrerController@diversityUpdate')->name('life.at.banglalink.diversity.update');
    Route::get('life-at-banglalink/diversity/destroy/{id}', 'AssetLite\EcarrerController@diversityDestroy')->name('life.at.banglalink.diversity.destroy');


    // eCarrer Life at banglalink Events & Activities =========================================================
    Route::get('life-at-banglalink/events', 'AssetLite\EcarrerController@eventsIndex')->name('life.at.banglalink.events');
    Route::get('life-at-banglalink/events/create', 'AssetLite\EcarrerController@eventsCreate')->name('life.at.banglalink.events.create');
    Route::post('life-at-banglalink/events/store', 'AssetLite\EcarrerController@eventsStore')->name('life.at.banglalink.events.store');

    Route::get('life-at-banglalink/events/{id}/edit', 'AssetLite\EcarrerController@eventsEdit')->name('life.at.banglalink.events.edit');

    Route::post('life-at-banglalink/events/{id}/update', 'AssetLite\EcarrerController@eventsUpdate')->name('life.at.banglalink.events.update');
    Route::get('life-at-banglalink/events/destroy/{id}', 'AssetLite\EcarrerController@eventsDestroy')->name('life.at.banglalink.events.destroy');


    // eCarrer Life at banglalink Events & Activities =========================================================
    Route::get('life-at-banglalink/topbanner', 'AssetLite\EcarrerController@topbannerIndex')->name('life.at.banglalink.topbanner');
    Route::get('life-at-banglalink/topbanner/create', 'AssetLite\EcarrerController@topbannerCreate')->name('life.at.banglalink.topbanner.create');
    Route::post('life-at-banglalink/topbanner/store', 'AssetLite\EcarrerController@topbannerStore')->name('life.at.banglalink.topbanner.store');

    Route::get('life-at-banglalink/topbanner/{id}/edit', 'AssetLite\EcarrerController@topbannerEdit')->name('life.at.banglalink.topbanner.edit');

    Route::post('life-at-banglalink/topbanner/{id}/update', 'AssetLite\EcarrerController@topbannerUpdate')->name('life.at.banglalink.topbanner.update');
    Route::get('life-at-banglalink/topbanner/destroy/{id}', 'AssetLite\EcarrerController@topbannerDestroy')->name('life.at.banglalink.topbanner.destroy');

    // eCarrer Contact us  =========================================================
    Route::get('life-at-banglalink/contact', 'AssetLite\EcarrerController@contactIndex')->name('life.at.banglalink.contact');
    Route::get('life-at-banglalink/contact/create', 'AssetLite\EcarrerController@contactCreate')->name('life.at.banglalink.contact.create');
    Route::post('life-at-banglalink/contact/store', 'AssetLite\EcarrerController@contactStore')->name('life.at.banglalink.contact.store');

    Route::get('life-at-banglalink/contact/{id}/edit', 'AssetLite\EcarrerController@contactEdit')->name('life.at.banglalink.contact.edit');

    Route::post('life-at-banglalink/contact/{id}/update', 'AssetLite\EcarrerController@contactUpdate')->name('life.at.banglalink.contact.update');
    Route::get('life-at-banglalink/contact/destroy/{id}', 'AssetLite\EcarrerController@contactDestroy')->name('life.at.banglalink.contact.destroy');


    // eCarrer Vacancy  =========================================================
    Route::get('vacancy/pioneer', 'AssetLite\EcarrerController@pioneerIndex')->name('vacancy.pioneer');
    Route::get('vacancy/pioneer/create', 'AssetLite\EcarrerController@pioneerCreate')->name('vacancy.pioneer.create');
    Route::post('vacancy/pioneer/store', 'AssetLite\EcarrerController@pioneerStore')->name('vacancy.pioneer.store');

    Route::get('vacancy/pioneer/{id}/edit', 'AssetLite\EcarrerController@pioneerEdit')->name('vacancy.pioneer.edit');

    Route::post('vacancy/pioneer/{id}/update', 'AssetLite\EcarrerController@pioneerUpdate')->name('vacancy.pioneer.update');
    Route::get('vacancy/pioneer/destroy/{id}', 'AssetLite\EcarrerController@pioneerDestroy')->name('vacancy.pioneer.destroy');


    // eCarrer Vacancy icon box =========================================================
    Route::get('vacancy/viconbox', 'AssetLite\EcarrerController@viconboxIndex')->name('vacancy.viconbox');
    Route::get('vacancy/viconbox/create', 'AssetLite\EcarrerController@viconboxCreate')->name('vacancy.viconbox.create');
    Route::post('vacancy/viconbox/store', 'AssetLite\EcarrerController@viconboxStore')->name('vacancy.viconbox.store');

    Route::get('vacancy/viconbox/{id}/edit', 'AssetLite\EcarrerController@viconboxEdit')->name('vacancy.viconbox.edit');

    Route::post('vacancy/viconbox/{id}/update', 'AssetLite\EcarrerController@viconboxUpdate')->name('vacancy.viconbox.update');
    Route::get('vacancy/viconbox/destroy/{id}', 'AssetLite\EcarrerController@viconboxDestroy')->name('vacancy.viconbox.destroy');


    // eCarrer Programs general =========================================================
    Route::get('programs/progeneral', 'AssetLite\EcarrerController@progeneralIndex')->name('programs.progeneral');
    Route::get('programs/progeneral/create', 'AssetLite\EcarrerController@progeneralCreate')->name('programs.progeneral.create');
    Route::post('programs/progeneral/store', 'AssetLite\EcarrerController@progeneralStore')->name('programs.progeneral.store');

    Route::get('programs/progeneral/{id}/edit', 'AssetLite\EcarrerController@progeneralEdit')->name('programs.progeneral.edit');

    Route::post('programs/progeneral/{id}/update', 'AssetLite\EcarrerController@progeneralUpdate')->name('programs.progeneral.update');
    Route::get('programs/progeneral/destroy/{id}', 'AssetLite\EcarrerController@progeneralDestroy')->name('programs.progeneral.destroy');


    // eCarrer Programs icon box =========================================================
    Route::get('programs/proiconbox', 'AssetLite\EcarrerController@proiconboxIndex')->name('programs.proiconbox');
    Route::get('programs/proiconbox/create', 'AssetLite\EcarrerController@proiconboxCreate')->name('programs.proiconbox.create');
    Route::post('programs/proiconbox/store', 'AssetLite\EcarrerController@proiconboxStore')->name('programs.proiconbox.store');

    Route::get('programs/proiconbox/{id}/edit', 'AssetLite\EcarrerController@proiconboxEdit')->name('programs.proiconbox.edit');

    Route::post('programs/proiconbox/{id}/update', 'AssetLite\EcarrerController@proiconboxUpdate')->name('programs.proiconbox.update');
    Route::get('programs/proiconbox/destroy/{id}', 'AssetLite\EcarrerController@proiconboxDestroy')->name('programs.proiconbox.destroy');


    // eCarrer Programs Photo gallery =========================================================
    Route::get('programs/photogallery', 'AssetLite\EcarrerController@photogalleryIndex')->name('programs.photogallery');
    Route::get('programs/photogallery/create', 'AssetLite\EcarrerController@photogalleryCreate')->name('programs.photogallery.create');
    Route::post('programs/photogallery/store', 'AssetLite\EcarrerController@photogalleryStore')->name('programs.photogallery.store');

    Route::get('programs/photogallery/{id}/edit', 'AssetLite\EcarrerController@photogalleryEdit')->name('programs.photogallery.edit');

    Route::post('programs/photogallery/{id}/update', 'AssetLite\EcarrerController@photogalleryUpdate')->name('programs.photogallery.update');
    Route::get('programs/photogallery/destroy/{id}', 'AssetLite\EcarrerController@photogalleryDestroy')->name('programs.photogallery.destroy');


    // eCarrer Programs SAP Previous Batches =========================================================
    Route::get('programs/sapbatches', 'AssetLite\EcarrerController@sapbatchesIndex')->name('programs.sapbatches');
    Route::get('programs/sapbatches/create', 'AssetLite\EcarrerController@sapbatchesCreate')->name('programs.sapbatches.create');
    Route::post('programs/sapbatches/store', 'AssetLite\EcarrerController@sapbatchesStore')->name('programs.sapbatches.store');

    Route::get('programs/sapbatches/{id}/edit', 'AssetLite\EcarrerController@sapbatchesEdit')->name('programs.sapbatches.edit');

    Route::post('programs/sapbatches/{id}/update', 'AssetLite\EcarrerController@sapbatchesUpdate')->name('programs.sapbatches.update');
    Route::get('programs/sapbatches/destroy/{id}', 'AssetLite\EcarrerController@sapbatchesDestroy')->name('programs.sapbatches.destroy');


    // eCarrer Programs Ennovators Previous Batches =========================================================
    Route::get('programs/ennovatorbatches', 'AssetLite\EcarrerController@ennovatorbatchesIndex')->name('programs.ennovatorbatches');
    Route::get('programs/ennovatorbatches/create', 'AssetLite\EcarrerController@ennovatorbatchesCreate')->name('programs.ennovatorbatches.create');
    Route::post('programs/ennovatorbatches/store', 'AssetLite\EcarrerController@ennovatorbatchesStore')->name('programs.ennovatorbatches.store');

    Route::get('programs/ennovatorbatches/{id}/edit', 'AssetLite\EcarrerController@ennovatorbatchesEdit')->name('programs.ennovatorbatches.edit');

    Route::post('programs/ennovatorbatches/{id}/update', 'AssetLite\EcarrerController@ennovatorbatchesUpdate')->name('programs.ennovatorbatches.update');
    Route::get('programs/ennovatorbatches/destroy/{id}', 'AssetLite\EcarrerController@ennovatorbatchesDestroy')->name('programs.ennovatorbatches.destroy');


    // App & Service Tab =========================================================
    Route::resource('app-service/tabs', 'AssetLite\AppServiceTabController')
        ->except('create', 'store', 'show', 'destroy');
    Route::get('app-service/tabs/destroy/{id}', 'AssetLite\AppServiceTabController@destroy');

    // App & Service Category =========================================================
    Route::resource('app-service/category', 'AssetLite\AppServiceCategoryController')->except('show', 'destroy');
    Route::get('app-service/category/destroy/{id}', 'AssetLite\AppServiceCategoryController@destroy');

    // App & Service Product =========================================================
    Route::resource('app-service-product', 'AssetLite\AppServiceProductController')->except('show', 'destroy');
    Route::get('app-service/product/destroy/{id}', 'AssetLite\AppServiceProductController@destroy');

    Route::get('app-service/category-find/{id}', 'AssetLite\AppServiceProductController@tabWiseCategory');

    # App & Service details page
    Route::get('app-service/details/{type}/{id}', 'AssetLite\AppServiceProductDetailsController@index')->name('app_service.details.list');
    Route::post('app-service/details/{type}/{id}/store', 'AssetLite\AppServiceProductDetailsController@store')->name('app_service.details.store');

});
