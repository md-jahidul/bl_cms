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


Route::group(['middleware' => ['appAdmin', 'authorize', 'auth']], function () {
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
    /*    route::resource('myblsliderImage','CMS\MyblSliderImageController');*/
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


    Route::get('app-launch/create', 'CMS\AppLaunchPopupController@create')->name('app-launch.new');
    Route::post('app-launch/store', 'CMS\AppLaunchPopupController@store')->name('app-launch.store');
    Route::get('app-launch', 'CMS\AppLaunchPopupController@index')->name('app-launch.index');
    Route::get('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@edit')->name('app-launch.edit');
    Route::post('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@update')->name('app-launch.update');
    Route::delete('app-launch/{pop_up}', 'CMS\AppLaunchPopupController@destroy')->name('app-launch.delete');
});
