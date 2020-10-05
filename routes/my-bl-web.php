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

Route::group(['middleware' => ['appAdmin', 'authorize', 'auth', 'CheckFistLogin']], function () {

    //------ shortcuts -----------//

    // route::resource('short_cuts','CMS\ShortCutController');
    // route::resource('UserShortcut','CMS\UserShortcutController');

    //shortcuts
    Route::put('shortcuts/SerialUpdate/{id}', 'CMS\UserShortcutController@serialUpdate')->name('serial.update');
    Route::get('shortcuts/destroy/{id}', 'CMS\ShortCutController@destroy');

    Route::get('shortcuts', 'CMS\ShortCutController@index')->name('short_cuts.index');
    Route::post('shortcuts', 'CMS\ShortCutController@store')->name('short_cuts.store');
    Route::get('shortcuts/create', 'CMS\ShortCutController@create')->name('short_cuts.create');
    Route::get('shortcuts/{short_cut}/edit', 'CMS\ShortCutController@edit')->name('short_cuts.edit');
    Route::put('shortcuts/{short_cut}', 'CMS\ShortCutController@update')->name('short_cuts.update');
    Route::get('shortcuts-sortable', 'CMS\ShortCutController@shortcutSortable')->name('short_cuts.sort');
    ;

    //------ shortcuts -----------//


    // Banner
    route::resource('banner', 'CMS\BannerController');
    Route::get('banner/destroy/{id}', 'CMS\BannerController@destroy');

    // welcomeInfo
    route::get('welcomeInfo', 'CMS\WelcomeInfoController@index')->name('welcomeInfo.index');
    route::post('welcomeInfo', 'CMS\WelcomeInfoController@store')->name('welcomeInfo.store');
    route::post('welcomeInfo/update/{id}', 'CMS\WelcomeInfoController@update')->name('welcomeInfo.update');

    //settings
    route::resource('setting', 'CMS\SettingController');
    Route::get('setting_limit/store', 'CMS\SettingController@Addlimit');
    Route::get('setting/destroy/{id}', 'CMS\SettingController@destroy')->name('setting.destroy');


    //App Version
    Route::resource('app-version', 'CMS\AppVersionController');
    Route::get('app-version/destroy/{id}', 'CMS\AppVersionController@destroy');

    //OTP config
    Route::resource('otp-config', 'CMS\OtpController');
    Route::get('otp-config/destroy/{id}', 'CMS\OtpController@destroy');


    //------ Slider -----------//

    // Slider
    Route::resource('myblslider', 'CMS\MyblSliderController');

    Route::get('myblslider/{slider_id}/images', 'CMS\MyblSliderImageController@index')->name('myblslider.images.index');
    Route::get(
        'myblslider/{slider_id}/images/create',
        'CMS\MyblSliderImageController@create'
    )->name('myblslider.images.create');
    Route::post('myblslider/images/store', 'CMS\MyblSliderImageController@store')->name('myblslider.images.store');
    Route::get('myblslider/images/{id}/edit', 'CMS\MyblSliderImageController@edit')->name('myblslider.images.edit');
    Route::put(
        'myblslider/images/{id}/update',
        'CMS\MyblSliderImageController@update'
    )->name('myblslider.images.update');
    Route::put(
        'myblslider/images/{id}/update',
        'CMS\MyblSliderImageController@update'
    )->name('myblslider.images.update');
    Route::delete(
        'myblslider/images/{id}/delete',
        'CMS\MyblSliderImageController@destroy'
    )->name('myblslider.images.destroy');

    Route::get(
        'myblslider/images/get-active-products',
        'CMS\MyblSliderImageController@getMyblProducts'
    )->name('myblslider.active-products');//getMyblProducts

    Route::get('myblslider/destroy/{id}', 'CMS\MyblSliderController@destroy');
    //Route::get('myblslider/edit/{slider-other-attr}','CMS\MyblSliderController@edit')->name('slider-other-attr.edit');
    // Slider

    // Slider Image
    /*route::resource('myblsliderImage','CMS\MyblSliderImageController');*/
    Route::get('myblslider/{id}/images', 'CMS\MyblSliderImageController@index');
    route::get('myblsliderImage/addImage/update-position', 'CMS\MyblSliderImageController@updatePosition');
    Route::get('myblslider/addImage/{sliderId}', 'CMS\MyblSliderImageController@index')->name('myblsliderImage.index');
    // Slider Image


    // minute
    route::resource('minuteOffer', 'CMS\MinuteOfferController');
    Route::get('minuteOffer/destroy/{id}', 'CMS\MinuteOfferController@destroy');

    // sms offer
    route::resource('smsOffer', 'CMS\SmsOfferController');
    Route::get('smsOffer/destroy/{id}', 'CMS\SmsOfferController@destroy');

    // internet
    route::resource('internetOffer', 'CMS\InternetOfferController');
    Route::get('internetOffer/destroy/{id}', 'CMS\InternetOfferController@destroy');

    // Mixed Bundle
    route::resource('mixedBundleOffer', 'CMS\MixedBundleOfferController');
    Route::get('mixedBundleOffer/destroy/{id}', 'CMS\MixedBundleOfferController@destroy');

    // Near By Offer
    route::resource('nearByOffer', 'CMS\NearbyOfferController');
    Route::get('nearByOffer/destroy/{id}', 'CMS\NearbyOfferController@destroy');

    // Near By Offer
    route::resource('nearByOffer', 'CMS\NearbyOfferController');
    Route::get('nearByOffer/destroy/{id}', 'CMS\NearbyOfferController@destroy');


    // Amar Offer
    route::resource('amarOffer', 'CMS\AmarOfferController');
    Route::get('amarOffer/destroy/{id}', 'CMS\AmarOfferController@destroy');


    // ussd code
    route::resource('ussd', 'CMS\UssdController');
    Route::get('ussd/destroy/{id}', 'CMS\UssdController@destroy');

    // help center
    route::resource('helpCenter', 'CMS\HelpCenterController');
    Route::get('helpCenter/destroy/{id}', 'CMS\HelpCenterController@destroy');
    Route::get('help_Center/update-position', 'CMS\HelpCenterController@changeSequece');

    // contextual cards
    route::resource('contextualcard', 'CMS\ContextualCardController');
    Route::get('card/destroy/{id}', 'CMS\ContextualCardController@destroy');

    // Notification categorys
    route::resource('notificationCategory', 'CMS\NotificationCategoryController');
    Route::get('notificationCategory/destroy/{id}', 'CMS\NotificationCategoryController@destroy');

    // Notification
    route::resource('notification', 'CMS\NotificationController');
    Route::get('notification/destroy/{id}', 'CMS\NotificationController@destroy');
    Route::get('notification/all/{id}', 'CMS\NotificationController@showAll')->name('notification.show-all');
    Route::get('notification-report', 'CMS\NotificationController@getNotificationReport')->name('notification.report');


    // Push Notification
    Route::post('push-notification', 'CMS\PushNotificationController@sendNotification')->name('notification.send');
    Route::post(
        'push-notification-all',
        'CMS\PushNotificationController@sendNotificationToAll'
    )->name('notification.send-all');


    // Store category
    route::resource('storeCategory', 'CMS\StoreCategoryController');
    Route::get('storeCategory/destroy/{id}', 'CMS\StoreCategoryController@destroy');


    // Store sub-category
    route::resource('subStore', 'CMS\StoreSubCategoryController');
    Route::get('subStore/destroy/{id}', 'CMS\StoreSubCategoryController@destroy');
    Route::get('subStore/subcategory-find/{id}', 'CMS\StoreSubCategoryController@getSubCategoryByCatId');

    // Store
    route::resource('myblStore', 'CMS\StoreController');
    Route::get('myblStore/destroy/{id}', 'CMS\StoreController@destroy');
    Route::get('myblStore-sortable', 'CMS\StoreController@myblStoreSortable')->name('myblStore.sort');

    // App
    route::resource('appStore', 'CMS\StoreAppController');
    Route::get('appStore/destroy/{id}', 'CMS\StoreAppController@destroy');
    Route::get('appStore-sortable', 'CMS\StoreAppController@appStoreSortable')->name('appStore.sort');

    // Store App Slider Image
    Route::get('appslider/{id}/images', 'CMS\StoreAppSliderImageController@index');
    route::get('appsliderImage/addImage/update-position', 'CMS\StoreAppSliderImageController@updatePosition');
    Route::get('appslider/addImage/{sliderId}', 'CMS\StoreAppSliderImageController@index')->name('appsliderImage.index');


    Route::get('appslider/{id}/images', 'CMS\StoreAppSliderImageController@index')->name('appslider.images.index');
    Route::get('appslider/{id}/images/create',  'CMS\StoreAppSliderImageController@create')->name('appslider.images.create');
    Route::post('appslider/images/store', 'CMS\StoreAppSliderImageController@store')->name('appslider.images.store');
    Route::get('appslider/images/{id}/edit', 'CMS\StoreAppSliderImageController@edit')->name('appslider.images.edit');
    Route::put('appslider/images/{id}/update', 'CMS\StoreAppSliderImageController@update')->name('appslider.images.update');
    Route::put('appslider/images/{id}/update', 'CMS\StoreAppSliderImageController@update')->name('appslider.images.update');
    Route::delete('appslider/images/{id}/delete', 'CMS\StoreAppSliderImageController@destroy')->name('appslider.images.destroy');





    // terms and conditions
    Route::get('terms-conditions', 'CMS\TermsAndConditionsController@show')->name('terms-conditions.show');
    Route::post('terms-conditions', 'CMS\TermsAndConditionsController@store')->name('terms-conditions.store');

    // privacy and policy
    Route::get('privacy-policy', 'CMS\PrivacyPolicyController@show')->name('privacy-policy.show');
    Route::post('privacy-policy', 'CMS\PrivacyPolicyController@store')->name('privacy-policy.store');

    // faq category
    Route::get('faq/category', 'CMS\FaqCategoryController@index')->name('faq.category.index');

    Route::post('faq/category/update', 'CMS\FaqCategoryController@update')->name('faq.category.update');
    Route::post('faq/category', 'CMS\FaqCategoryController@store')->name('faq.category.store');
    Route::post('faq/category/delete', 'CMS\FaqCategoryController@destroy')->name('faq.category.delete');

    // faq questions
    Route::get('faq/questions', 'CMS\FaqQuestionsController@index')->name('faq.questions.index');
    Route::get('faq/questions/create/{id?}', 'CMS\FaqQuestionsController@create')->name('faq.questions.create');
    Route::post('faq/questions/store', 'CMS\FaqQuestionsController@store')->name('faq.questions.store');
    Route::get('faq/questions/{id}', 'CMS\FaqQuestionsController@show')->name('faq.questions.show');
    Route::patch('faq/questions/{id}/update', 'CMS\FaqQuestionsController@update')->name('faq.questions.update');
    Route::delete('faq/questions/delete', 'CMS\FaqQuestionsController@delete')->name('faq.questions.delete');


    Route::get('mybl/core-product', 'CMS\MyblProductEntryController@index')->name('mybl.product.index');
    Route::post(
        'mybl/core-product/download',
        'CMS\MyblProductEntryController@downloadMyblProducts'
    )->name('mybl.product.download');
    Route::post('mybl/core-product', 'CMS\MyblProductEntryController@uploadProductByExcel')
        ->name('mybl.core-product.save');
    Route::get('mybl/products', 'CMS\MyblProductEntryController@getMyblProducts')
        ->name('mybl.products.list');
    Route::get('mybl/core-product/details', 'ProductEntryController@getProductDetails')->name('product.details.info');
    Route::get('mybl/products/{product_code}', 'CMS\MyblProductEntryController@getProductDetails')
        ->name('mybl.products.details');

    Route::put('mybl/products/{product_code}', 'CMS\MyblProductEntryController@updateMyblProducts')
        ->name('mybl.product.update');
    Route::get('store-locations/entry', 'StoreLocatorEntryController@create');
    Route::post('store-locations', 'StoreLocatorEntryController@uploadStoresByExcel')->name('store-locations.save');

    Route::get('core-product/test', 'ProductEntryController@test');

    /*
     *  Recharge prefill amounts
     */

    Route::get('recharge/prefill-amounts', 'CMS\PrefillRechargeController@show')
        ->name('recharge.prefill-amounts.index');
    Route::post('recharge/prefill-amounts', 'CMS\PrefillRechargeController@update')
        ->name('recharge.prefill-amounts.update');

    Route::get('recharge/prefill-amounts/order', 'CMS\PrefillRechargeController@updatePosition');

    // search content
    Route::get('mybl-search/content', 'CMS\Search\InAppSearchContentController@create')
        ->name('mybl-search-content.create');
    Route::get('mybl-search', 'CMS\Search\InAppSearchContentController@index')
        ->name('mybl-search-content.index');
    Route::get('mybl-search/list', 'CMS\Search\InAppSearchContentController@getSearchContents')
        ->name('mybl-search-content.list');
    Route::post('mybl-search/content', 'CMS\Search\InAppSearchContentController@store')
        ->name('mybl-search-content.store');
    Route::get('mybl-search/{search_content}', 'CMS\Search\InAppSearchContentController@edit')
        ->name('mybl-search-content.edit');
    Route::post('mybl-search/{search_content}', 'CMS\Search\InAppSearchContentController@update')
        ->name('mybl-search-content.update');
    Route::delete('mybl-search/{search_content}', 'CMS\Search\InAppSearchContentController@destroy')
        ->name('mybl-search-content.delete');



    Route::get('app-launch/create', 'CMS\AppLaunchPopupController@create')->name('app-launch.new');
    Route::post('app-launch/store', 'CMS\AppLaunchPopupController@store')->name('app-launch.store');
    Route::get('app-launch', 'CMS\AppLaunchPopupController@index')->name('app-launch.index');
    Route::get('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@edit')->name('app-launch.edit');
    Route::post('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@update')->name('app-launch.update');
    Route::delete('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@destroy')->name('app-launch.delete');

    /*
     *  Filters
     */

    Route::get('mixed-bundle-offer/filter/create', 'CMS\MixedBundleFilterController@create')
        ->name('mixed-bundle-offer.filter.create');
    Route::post('mixed-bundle-offer/filter/price/save', 'CMS\MixedBundleFilterController@savePriceFilter')
        ->name('mixed-bundle-offer.filter.price.save');
    Route::get('mixed-bundle-offer/filter/price', 'CMS\MixedBundleFilterController@getPriceFilter')
        ->name('mixed-bundle-offer.filter.price.list');

    Route::post('mixed-bundle-offer/filter/delete', 'CMS\MixedBundleFilterController@deleteFilter')
        ->name('mixed-bundle-offer.filter.delete');

    Route::post('mixed-bundle-offer/filter/internet/save', 'CMS\MixedBundleFilterController@saveInternetFilter')
        ->name('mixed-bundle-offer.filter.internet.save');
    Route::get('mixed-bundle-offer/filter/internet', 'CMS\MixedBundleFilterController@getInternetFilter')
        ->name('mixed-bundle-offer.filter.internet.list');

    Route::post('mixed-bundle-offer/filter/minutes/save', 'CMS\MixedBundleFilterController@saveMinutesFilter')
        ->name('mixed-bundle-offer.filter.minutes.save');
    Route::get('mixed-bundle-offer/filter/minutes', 'CMS\MixedBundleFilterController@getMinutesFilter')
        ->name('mixed-bundle-offer.filter.minutes.list');

    Route::post('mixed-bundle-offer/filter/sms/save', 'CMS\MixedBundleFilterController@saveSmsFilter')
        ->name('mixed-bundle-offer.filter.sms.save');
    Route::get('mixed-bundle-offer/filter/sms', 'CMS\MixedBundleFilterController@getSmsFilter')
        ->name('mixed-bundle-offer.filter.sms.list');

    Route::post('mixed-bundle-offer/filter/validity/save', 'CMS\MixedBundleFilterController@saveValidityFilter')
        ->name('mixed-bundle-offer.filter.validity.save');
    Route::get('mixed-bundle-offer/filter/validity', 'CMS\MixedBundleFilterController@getValidityFilter')
        ->name('mixed-bundle-offer.filter.validity.list');

    Route::post('mixed-bundle-offer/filter/sort/save', 'CMS\MixedBundleFilterController@saveSortFilter')
        ->name('mixed-bundle-offer.filter.sort.save');

    Route::get('/test/test', 'CMS\MixedBundleFilterController@getPriceFilter');


    Route::get('internet-pack/filter/create', 'CMS\InternetPackFilterController@create')
        ->name('internet-pack.filter.create');
    Route::post('internet-pack/price/save', 'CMS\InternetPackFilterController@savePriceFilter')
        ->name('internet-pack.filter.price.save');
    Route::get('internet-pack/filter/price', 'CMS\InternetPackFilterController@getPriceFilter')
        ->name('internet-pack.filter.price.list');

    Route::post('internet-pack/filter/delete', 'CMS\InternetPackFilterController@deleteFilter')
        ->name('internet-pack.filter.delete');

    Route::post('internet-pack/filter/internet/save', 'CMS\InternetPackFilterController@saveInternetFilter')
        ->name('internet-pack.filter.internet.save');
    Route::get('internet-pack/filter/internet', 'CMS\InternetPackFilterController@getInternetFilter')
        ->name('internet-pack.filter.internet.list');

    Route::post('internet-pack/filter/validity/save', 'CMS\InternetPackFilterController@saveValidityFilter')
        ->name('internet-pack.filter.validity.save');
    Route::get('internet-pack/filter/validity', 'CMS\InternetPackFilterController@getValidityFilter')
        ->name('internet-pack.filter.validity.list');

    // MINUTES
    Route::get('minute-pack/filter/create', 'CMS\MinutePackFilterController@create')
        ->name('minute-pack.filter.create');
    Route::post('minute-pack/price/save', 'CMS\MinutePackFilterController@savePriceFilter')
        ->name('minute-pack.filter.price.save');
    Route::get('minute-pack/filter/price', 'CMS\MinutePackFilterController@getPriceFilter')
        ->name('minute-pack.filter.price.list');

    Route::post('minute-pack/filter/delete', 'CMS\MinutePackFilterController@deleteFilter')
        ->name('minute-pack.filter.delete');

    Route::post('minute-pack/filter/minute/save', 'CMS\MinutePackFilterController@saveMinuteFilter')
        ->name('minute-pack.filter.minute.save');
    Route::get('minute-pack/filter/minute', 'CMS\MinutePackFilterController@getMinuteFilter')
        ->name('minute-pack.filter.minute.list');

    Route::post('minute-pack/filter/validity/save', 'CMS\MinutePackFilterController@saveValidityFilter')
        ->name('minute-pack.filter.validity.save');
    Route::get('minute-pack/filter/validity', 'CMS\MinutePackFilterController@getValidityFilter')
        ->name('minute-pack.filter.validity.list');

    Route::post('minute-pack/filter/sort/save', 'CMS\MinutePackFilterController@saveSortFilter')
        ->name('minute.filter.sort.save');

    // SMS

    Route::get('sms-pack/filter/create', 'CMS\SmsPackFilterController@create')
        ->name('sms-pack.filter.create');
    Route::post('sms-pack/price/save', 'CMS\SmsPackFilterController@savePriceFilter')
        ->name('sms-pack.filter.price.save');
    Route::get('sms-pack/filter/price', 'CMS\SmsPackFilterController@getPriceFilter')
        ->name('sms-pack.filter.price.list');

    Route::post('sms-pack/filter/delete', 'CMS\SmsPackFilterController@deleteFilter')
        ->name('sms-pack.filter.delete');

    Route::post('sms-pack/filter/sms/save', 'CMS\SmsPackFilterController@saveSmsFilter')
        ->name('sms-pack.filter.sms.save');
    Route::get('sms-pack/filter/sms', 'CMS\SmsPackFilterController@getSmsFilter')
        ->name('sms-pack.filter.sms.list');

    Route::post('sms-pack/filter/validity/save', 'CMS\SmsPackFilterController@saveValidityFilter')
        ->name('sms-pack.filter.validity.save');
    Route::get('sms-pack/filter/validity', 'CMS\SmsPackFilterController@getValidityFilter')
        ->name('sms-pack.filter.validity.list');

    Route::post('sms-pack/filter/sort/save', 'CMS\SmsPackFilterController@saveSortFilter')
        ->name('sms.filter.sort.save');


    Route::get('mybl/settings/najat', 'CMS\NajatContentsSettingsController@index')->name('mybl.settings.najat.index');
    Route::post('mybl/settings/najat', 'CMS\NajatContentsSettingsController@store')->name('mybl.settings.najat.store');


    /*
     *  API Debug For Developer
     */

    Route::get('developer/api/debug', 'CMS\ApiDebugController@userBalancePanel')->name('mybl.api.debug');
    Route::get('developer/api/debug/balance-summary/{number}', 'CMS\ApiDebugController@getBalanceSummary')
        ->name('mybl.api.debug.balance-summary');
    Route::get('developer/api/debug/balance-details/{number}/{type}', 'CMS\ApiDebugController@getBalanceDetails')
        ->name('mybl.api.debug.balance-details');

    Route::get('developer/api/debug/product/log/{number}', 'CMS\ApiDebugController@getProductLogs')->name('product.api.log');

    Route::get('developer/api/debug/audit_logs/{number}', 'CMS\ApiDebugController@getBrowseHistory');
    Route::get('developer/api/debug/bonus_logs/{number}', 'CMS\ApiDebugController@getLoginBonusHistory');
    Route::get('developer/api/debug/otp-logs/{number}', 'CMS\ApiDebugController@getOtpRequestLogs');

    Route::get('developer/api/debug/otp-login-logs/{number}', 'CMS\ApiDebugController@getOtpLoginRequestLogs');

    Route::get('developer/api/debug/last-login/{number}', 'CMS\ApiDebugController@getLastLogin');

    Route::get('developer/api/debug/usage-summary/{number}', 'CMS\ApiDebugController@getUsageSummary');

    Route::get('developer/api/debug/usage-details/{number}/{type}', 'CMS\ApiDebugController@getUsageDetails');
    Route::get('developer/api/debug/contact-restore-logs/{number}', 'CMS\ApiDebugController@getContactRestoreLogs');

    // Learn Priyojon Sections

    Route::get('mybl/learn-priyojon', 'CMS\LearnPriyojonContentController@show')->name('learn-priyojon.show');
    Route::post('mybl/learn-priyojon', 'CMS\LearnPriyojonContentController@store')->name('learn-priyojon.store');

    // Migrate Plan
    route::resource('migrate-plan', 'CMS\MigratePlanController');
    Route::get('migrate-plan/destroy/{id}', 'CMS\MigratePlanController@destroy');

    /*
     *  Feed routes
     */
    Route::namespace('CMS')->prefix('feeds')->name('feeds.')->group(function () {
        Route::resource('/', 'FeedController')->parameters(['' => 'feed'])->except('show');
        // Category resource
        Route::resource('categories', 'FeedCategoryController')->except('show');
        Route::get('categories/update-position', 'FeedCategoryController@updatePosition')->name('categories.update_position');
    });


});

// 4G Map View Route
Route::view('/4g-map', '4g-map.view');
