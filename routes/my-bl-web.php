<?php

//$serve = "mysql-5";
//$user = "root";
//$password = "root";
//$db = "bl_cms";
//try {
//    $con = mysqli_connect($serve, $user, $password, $db);
//
//    $query = ' Select id, referrer from cs_selfcare_referrers where code_type = "retailer" AND is_active = 1';
//    $result = $con->query($query);
//
//    foreach ($result as $value) {
//        $msisdn = substr($value->referrer->msisdn, -9);
//        $newCode = decoct($msisdn);
//        $updateQuery = "update cs_selfcare_referrers set referral_code = '$newCode' where id = value->id";
//        $con->query($updateQuery);
//    }
//}catch (PDOException $e){
//
//    echo $sql . "<br>" . $e->getMessage();
//}

/*
|--------------------------------------------------------------------------
| Web Routes for MY BL
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use App\Services\NewCampaignModality\MyBlCampaignWinnerSelectionService;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['appAdmin', 'authorize', 'auth', 'CheckFistLogin']], function () {

    //------ shortcuts -----------//

    // Route::resource('short_cuts','CMS\ShortCutController');
    // Route::resource('UserShortcut','CMS\UserShortcutController');

    //shortcuts
    Route::put('shortcuts/SerialUpdate/{id}', 'CMS\UserShortcutController@serialUpdate')->name('serial.update');
    Route::get('shortcuts/destroy/{id}', 'CMS\ShortCutController@destroy');

    Route::get('shortcuts', 'CMS\ShortCutController@index')->name('short_cuts.index');
    Route::post('shortcuts', 'CMS\ShortCutController@store')->name('short_cuts.store');
    Route::get('shortcuts/create', 'CMS\ShortCutController@create')->name('short_cuts.create');
    Route::get('shortcuts/{short_cut}/edit', 'CMS\ShortCutController@edit')->name('short_cuts.edit');
    Route::put('shortcuts/{short_cut}', 'CMS\ShortCutController@update')->name('short_cuts.update');
    Route::get('shortcuts-sortable', 'CMS\ShortCutController@shortcutSortable')->name('short_cuts.sort');;

    //------ shortcuts -----------//

    // Banner
    Route::resource('banner', 'CMS\BannerController');
    Route::get('banner/destroy/{id}', 'CMS\BannerController@destroy');

    // welcomeInfo
    Route::get('welcomeInfo', 'CMS\WelcomeInfoController@index')->name('welcomeInfo.index');
    Route::post('welcomeInfo', 'CMS\WelcomeInfoController@store')->name('welcomeInfo.store');
    Route::post('welcomeInfo/update/{id}', 'CMS\WelcomeInfoController@update')->name('welcomeInfo.update');

    //settings
    Route::resource('setting', 'CMS\SettingController');
    Route::get('setting_limit/store', 'CMS\SettingController@Addlimit');
    Route::get('setting/destroy/{id}', 'CMS\SettingController@destroy')->name('setting.destroy');

    // Logde a Complain
    Route::get('mybl/settings/lodge/complaints', 'CMS\SettingController@lodgeComplain')->name('lodge_complaints');
    Route::Post('mybl/settings/lodge/complain/store',
        'CMS\SettingController@sotreLodgeComplain')->name('store_lodge_complaints');


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
    )->name('myblslider.active-products'); //getMyblProducts

    Route::get('myblslider/destroy/{id}', 'CMS\MyblSliderController@destroy');
    //Route::get('myblslider/edit/{slider-other-attr}','CMS\MyblSliderController@edit')->name('slider-other-attr.edit');
    // Slider

    // Slider Image
    /*Route::resource('myblsliderImage','CMS\MyblSliderImageController');*/
    Route::get('myblslider/{id}/images', 'CMS\MyblSliderImageController@index');
    Route::get('myblsliderImage/addImage/update-position', 'CMS\MyblSliderImageController@updatePosition');
    Route::get('myblslider/addImage/{sliderId}', 'CMS\MyblSliderImageController@index')->name('myblsliderImage.index');
    // Slider Image

    // Base Msisdn
    Route::get('mybl-slider/base-msisdn-list', 'CMS\BaseMsisdnController@index')
        ->name('myblslider.baseMsisdnList.index');

    Route::get('mybl-slider/base-msisdn-list-table/{id}', 'CMS\BaseMsisdnController@getBaseMsisdn')
        ->name('myblslider.baseMsisdnList.table');

    Route::get('mybl-slider/base-msisdn-excel-export/{id}', 'CMS\BaseMsisdnController@msisdnExcelExport')
        ->name('myblslider.baseMsisdn.excel-export');

    Route::get('mybl-slider/base-msisdn-create', 'CMS\BaseMsisdnController@create')
        ->name('myblslider.base.msisdn.create');

    Route::post('mybl-slider/base-msisdn-store', 'CMS\BaseMsisdnController@store')
        ->name('myblslider.base.msisdn.store');

    Route::get('mybl-slider/base-msisdn-edit/{id}', 'CMS\BaseMsisdnController@edit')
        ->name('myblslider.base.msisdn.edit');

    Route::put('mybl-slider/base-msisdn-update/{id}', 'CMS\BaseMsisdnController@update')
        ->name('myblslider.base.msisdn.update');

    // minute
    Route::resource('minuteOffer', 'CMS\MinuteOfferController');
    Route::get('minuteOffer/destroy/{id}', 'CMS\MinuteOfferController@destroy');

    // sms offer
    Route::resource('smsOffer', 'CMS\SmsOfferController');
    Route::get('smsOffer/destroy/{id}', 'CMS\SmsOfferController@destroy');

    // internet
    Route::resource('internetOffer', 'CMS\InternetOfferController');
    Route::get('internetOffer/destroy/{id}', 'CMS\InternetOfferController@destroy');

    // Mixed Bundle
    Route::resource('mixedBundleOffer', 'CMS\MixedBundleOfferController');
    Route::get('mixedBundleOffer/destroy/{id}', 'CMS\MixedBundleOfferController@destroy');

    // Near By Offer
    Route::resource('nearByOffer', 'CMS\NearbyOfferController');
    Route::get('nearByOffer/destroy/{id}', 'CMS\NearbyOfferController@destroy');

    // Near By Offer
    Route::resource('nearByOffer', 'CMS\NearbyOfferController');
    Route::get('nearByOffer/destroy/{id}', 'CMS\NearbyOfferController@destroy');

    // Amar Offer
    Route::resource('amarOffer', 'CMS\AmarOfferController');
    Route::get('amarOffer/destroy/{id}', 'CMS\AmarOfferController@destroy');

    // mybl internet offer category
    Route::get('mybl-internet-offer-category', 'CMS\MyBlInternetOffersCategoryController@index')->name('mybl-internet-offer-category');
    Route::POST('mybl-internet-offer-category', 'CMS\MyBlInternetOffersCategoryController@saveSortFilter')->name('mybl-internet-offer-category.store');
    Route::get('mybl-internet-offer-category/create', 'CMS\MyBlInternetOffersCategoryController@create')->name('mybl.internetOffer.category.create');
    Route::get('mybl-internet-offer-category/edit/{id}', 'CMS\MyBlInternetOffersCategoryController@edit')->name('mybl.internetOffer.category.edit');
    Route::put('mybl-internet-offer-category/update/{id}', 'CMS\MyBlInternetOffersCategoryController@update')->name('mybl.internetOffer.category.update');
    Route::get('mybl-internet-offer-category/delete/{id}', 'CMS\MyBlInternetOffersCategoryController@destroy')->name('mybl.internetOffer.category.delete');

    // ussd code
    Route::resource('ussd', 'CMS\UssdController');
    Route::get('ussd/destroy/{id}', 'CMS\UssdController@destroy');

    // help center
    Route::resource('helpCenter', 'CMS\HelpCenterController');
    Route::get('helpCenter/destroy/{id}', 'CMS\HelpCenterController@destroy');
    Route::get('help_Center/update-position', 'CMS\HelpCenterController@changeSequece');

    // contextual cards
    Route::resource('contextualcard', 'CMS\ContextualCardController');
    Route::get('card/destroy/{id}', 'CMS\ContextualCardController@destroy');

    // Notification categorys
    Route::resource('notificationCategory', 'CMS\NotificationCategoryController');
    Route::get('notificationCategory/destroy/{id}', 'CMS\NotificationCategoryController@destroy');

    // Notification
    Route::resource('notification', 'CMS\NotificationController');
    Route::get('notification-duplicate/{notificationId}', 'CMS\NotificationController@duplicateNotification')->name('notification.duplicate');
    Route::get('quick-notification', 'CMS\NotificationController@quickNotificationIndex')->name('quick-notification.index');
    Route::get('quick-notification/create', 'CMS\NotificationController@quickNotificationCreate')->name('quick-notification.create');
    Route::post('quick-notification/store', 'CMS\PushNotificationController@quickNotificationStoreAndSend')->name('quick-notification.store');
    Route::get('quick-notification/all/{id}', 'CMS\NotificationController@quickNotificationShowAll')->name('quick-notification.show-all');

    Route::get('notification/productlist/dropdown', 'CMS\NotificationController@getProductList')->name('notification.productlist.dropdown');
    Route::get('notification/destroy/{id}', 'CMS\NotificationController@destroy');
    Route::get('notification/all/{id}', 'CMS\NotificationController@showAll')->name('notification.show-all');
    Route::get('notification-report', 'CMS\NotificationController@getNotificationReport')->name('notification.report');

    // Push Notification
    Route::post('push-notification', 'CMS\PushNotificationController@sendNotification')->name('notification.send');
    Route::post('push-notification-schedule', 'CMS\PushNotificationController@sendScheduledNotification')
        ->name('notification-schedule.send');
    Route::post('target-wise-push-notification',
        'CMS\PushNotificationController@targetWiseNotificationSend')->name('target_wise_notification.send');
    Route::get('target-wise-notification-report',
        'CMS\NotificationController@getTargetWiseNotificationReport')->name('target-wise-notification-report.report');
    Route::get('target-wise-notification-report-details/{titel}',
        'CMS\NotificationController@getTargetWiseNotificationReportDetails')->name('target-wise-notification-report.report-details');

    // Get push notification purchase report
    Route::get('purchase/from-notification/list',
        'CMS\PushNotificationProductPurchaseController@index')->name('purchase.from_notification.list');
    Route::get('purchase/from-notification/details/{id}',
        'CMS\PushNotificationProductPurchaseController@details')->name('push.notification.purchase.report.details');


    Route::post(
        'push-notification-all',
        'CMS\PushNotificationController@sendNotificationToAll'
    )->name('notification.send-all');

    // Store category
    Route::resource('storeCategory', 'CMS\StoreCategoryController');
    Route::get('storeCategory/destroy/{id}', 'CMS\StoreCategoryController@destroy');
    Route::get('myblCategory-sortable', 'CMS\StoreCategoryController@myblCategorySortable')->name('myblCategory.sort');


    // Support Messages
    Route::get('support-message', 'CMS\SupportMessageRatingController@index')->name('support-message');
    Route::post('support-message', 'CMS\SupportMessageRatingController@index')->name('support.message.list');


    // Store sub-category
    Route::resource('subStore', 'CMS\StoreSubCategoryController');
    Route::get('subStore/destroy/{id}', 'CMS\StoreSubCategoryController@destroy');
    Route::get('subStore/subcategory-find/{id}', 'CMS\StoreSubCategoryController@getSubCategoryByCatId');

    // Store
    Route::resource('myblStore', 'CMS\StoreController');
    Route::get('myblStore/destroy/{id}', 'CMS\StoreController@destroy');
    Route::get('myblStore-sortable', 'CMS\StoreController@myblStoreSortable')->name('myblStore.sort');

    // App
    Route::resource('appStore', 'CMS\StoreAppController');
    Route::get('appStore/destroy/{id}', 'CMS\StoreAppController@destroy');
    Route::get('appStore-sortable', 'CMS\StoreAppController@appStoreSortable')->name('appStore.sort');

    // Store App Slider Image
    Route::get('appslider/{id}/images', 'CMS\StoreAppSliderImageController@index');
    Route::get('appsliderImage/addImage/update-position', 'CMS\StoreAppSliderImageController@updatePosition');
    Route::get('appslider/addImage/{sliderId}',
        'CMS\StoreAppSliderImageController@index')->name('appsliderImage.index');

    Route::get('appslider/{id}/images', 'CMS\StoreAppSliderImageController@index')->name('appslider.images.index');
    Route::get('appslider/{id}/images/create',
        'CMS\StoreAppSliderImageController@create')->name('appslider.images.create');
    Route::post('appslider/images/store', 'CMS\StoreAppSliderImageController@store')->name('appslider.images.store');
    Route::get('appslider/images/{id}/edit', 'CMS\StoreAppSliderImageController@edit')->name('appslider.images.edit');
    Route::put('appslider/images/{id}/update',
        'CMS\StoreAppSliderImageController@update')->name('appslider.images.update');
    Route::put('appslider/images/{id}/update',
        'CMS\StoreAppSliderImageController@update')->name('appslider.images.update');
    Route::delete('appslider/images/{id}/delete',
        'CMS\StoreAppSliderImageController@destroy')->name('appslider.images.destroy');


    /*
     * terms and conditions
     */
    Route::get('terms-conditions/{featureName}', 'CMS\TermsAndConditionsController@show')->name('terms-conditions.show');
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

    /*
     *  Product Routes
     */

    Route::get('mybl/core-product', 'CMS\MyblProductEntryController@index')->name('mybl.product.index');
    Route::get('mybl/core-product/create', 'CMS\MyblProductEntryController@create')->name('mybl.product.create');
    Route::post('mybl/core-product/store', 'CMS\MyblProductEntryController@store')->name('mybl.product.store');
    Route::post('mybl/core-product/redis', 'CMS\MyblProductEntryController@resetRedisProductKey')->name('mybl.product.redis');

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
    Route::get('mybl/inactive-products', 'CMS\MyblProductEntryController@inactiveProducts')
        ->name('mybl.products.inactive-products');
    Route::get('mybl/products/activate/{productCode}', 'CMS\MyblProductEntryController@activateProduct')
        ->name('mybl.products.activate');

    Route::put('mybl/products/{product_code}', 'CMS\MyblProductEntryController@updateMyblProducts')
        ->name('mybl.product.update');
    Route::get('store-locations/entry', 'StoreLocatorEntryController@create');
    Route::post('store-locations', 'StoreLocatorEntryController@uploadStoresByExcel')->name('store-locations.save');

    Route::get('core-product/test', 'ProductEntryController@test');

    Route::get('product-image-remove/{id}', 'CMS\MyblProductEntryController@imageRemove')
        ->name('product.img.remove');

    /*
     * Product Tags Routes
     */
    Route::get('mybl/product/tags', 'ProductTagController@index')->name('product-tags.index');
    Route::get('mybl/product/tags/{tag}/edit', 'ProductTagController@edit')->name('product-tags.edit');
    Route::put('mybl/product/tags/{id}', 'ProductTagController@update')->name('product-tags.update');
    Route::post('mybl/product/tags', 'ProductTagController@store')->name('product-tags.store');
    Route::delete('mybl/product/tags/{id}', 'ProductTagController@destroy')->name('product-tags.destroy');

    //Deep link
    Route::get('mybl-products-deep-link-create/{product_code}',
        'CMS\ProductDeepLinkController@create')->name('mybl-products-deep-link-create');
    Route::get('product-deep-link-report', 'CMS\ProductDeepLinkController@index')->name('products-deep-link-report');
    Route::get('product-deeplink-list', 'CMS\ProductDeepLinkController@data')->name('product-deeplink-list');
    Route::get('deeplink-product-purchase-details',
        'CMS\ProductDeepLinkController@getDetails')->name('deeplink-product-purchase-details');
    Route::get('deeplink-product-purchase-details/{product_purchase_id}', 'CMS\ProductDeepLinkController@getDetails');


    /*
     *  Recharge prefill amounts
     */

    Route::get('recharge/prefill-amounts', 'CMS\PrefillRechargeController@show')
        ->name('recharge.prefill-amounts.index');
    Route::post('recharge/prefill-amounts', 'CMS\PrefillRechargeController@update')
        ->name('recharge.prefill-amounts.update');

    Route::get('recharge/prefill-amounts/order', 'CMS\PrefillRechargeController@updatePosition');

    /*
    *  Balance Transfer
    */

    Route::get('balance-transfer/prefill-amounts', 'BalanceTransferController@createPrefillAmounts')
        ->name('balance-transfer.prefill-amounts.create');
    Route::post('balance-transfer/prefill-amounts', 'BalanceTransferController@storePrefillAmounts')
        ->name('balance-transfer.prefill-amounts.store');

    Route::get('balance-transfer/prefill-amounts/order', 'CMS\PrefillRechargeController@updatePosition');

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

    Route::get('app-launch/popup/report', 'CMS\AppLaunchPopupController@report')->name('app-launch.report');
    Route::get('app-launch/popup/report/{popupId}', 'CMS\AppLaunchPopupController@reportDetail')
        ->name('app-launch.report-detail');

    Route::resource('recurring-schedule-hours', 'CMS\RecurringScheduleHourController');

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


    //RECHARGE OFFER
    Route::get('recharge-pack/filter/create', 'CMS\RechargePackFilterController@create')
        ->name('recharge-pack.filter.create');

    Route::post('recharge-pack/price/save', 'CMS\RechargePackFilterController@savePriceFilter')
        ->name('recharge-pack.filter.price.save');
    Route::get('recharge-pack/filter/price', 'CMS\RechargePackFilterController@getPriceFilter')
        ->name('recharge-pack.filter.price.list');
    Route::post('recharge-pack/filter/delete', 'CMS\RechargePackFilterController@deleteFilter')
        ->name('recharge-pack.filter.delete');

    Route::post('recharge-internet-pack/filter/internet/save', 'CMS\RechargePackFilterController@saveInternetFilter')
        ->name('recharge-internet-pack.filter.internet.save');
    Route::get('recharge-internet-pack/filter/internet', 'CMS\RechargePackFilterController@getInternetFilter')
        ->name('recharge-internet-pack.filter.internet.list');


    Route::post('recharge-internet-pack/filter/validity/save', 'CMS\RechargePackFilterController@saveValidityFilter')
        ->name('recharge-internet-pack.filter.validity.save');
    Route::get('recharge-internet-pack/filter/validity', 'CMS\RechargePackFilterController@getValidityFilter')
        ->name('recharge-internet-pack.filter.validity.list');


    Route::post('recharge-pack/filter/minutes/save', 'CMS\RechargePackFilterController@saveMinutesFilter')
        ->name('recharge-pack.filter.minutes.save');
    Route::get('recharge-pack/filter/minutes', 'CMS\RechargePackFilterController@getMinutesFilter')
        ->name('recharge-pack.filter.minutes.list');

    Route::post('recharge-pack/filter/sms/save', 'CMS\RechargePackFilterController@saveSmsFilter')
        ->name('recharge-pack.filter.sms.save');
    Route::get('recharge-pack/filter/sms', 'CMS\RechargePackFilterController@getSmsFilter')
        ->name('recharge-pack.filter.sms.list');

    Route::post('recharge-pack/filter/sort/save', 'CMS\RechargePackFilterController@saveSortFilter')
        ->name('recharge-pack.filter.sort.save');

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

    // SPECIAL CALL RATE FILTER
    Route::get('special-pack/filter/create', 'CMS\SpecialCallRateFilterController@create')
        ->name('special-pack.filter.create');
    Route::post('special-pack/price/save', 'CMS\SpecialCallRateFilterController@savePriceFilter')
        ->name('special-pack.filter.price.save');
    Route::get('special-pack/filter/price', 'CMS\SpecialCallRateFilterController@getPriceFilter')
        ->name('special-pack.filter.price.list');

    Route::post('special-pack/filter/delete', 'CMS\SpecialCallRateFilterController@deleteFilter')
        ->name('special-pack.filter.delete');
//
    Route::post('special-pack/filter/minute/save', 'CMS\SpecialCallRateFilterController@saveMinuteFilter')
        ->name('special-pack.filter.minute.save');
    Route::get('special-pack/filter/minute', 'CMS\SpecialCallRateFilterController@getMinuteFilter')
        ->name('special-pack.filter.minute.list');
//
    Route::post('special-pack/filter/validity/save', 'CMS\SpecialCallRateFilterController@saveValidityFilter')
        ->name('special-pack.filter.validity.save');
    Route::get('special-pack/filter/validity', 'CMS\SpecialCallRateFilterController@getValidityFilter')
        ->name('special-pack.filter.validity.list');
//
    Route::post('special-pack/filter/sort/save', 'CMS\SpecialCallRateFilterController@saveSortFilter')
        ->name('special.filter.sort.save');

    Route::post('special-pack/filter/sms/save', 'CMS\SpecialCallRateFilterController@saveSmsFilter')
        ->name('special-pack.filter.sms.save');
    Route::get('special-pack/filter/sms', 'CMS\SpecialCallRateFilterController@getSmsFilter')
        ->name('special-pack.filter.sms.list');

    Route::post('special-pack/filter/internet/save', 'CMS\SpecialCallRateFilterController@saveInternetFilter')
        ->name('special-pack.filter.internet.save');
    Route::get('special-pack/filter/internet', 'CMS\SpecialCallRateFilterController@getInternetFilter')
        ->name('special-pack.filter.internet.list');


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
    * Bandho Sim image
    */
    Route::resource('bandhosimimage', 'CMS\BandhoSimImageController');
    Route::get('bandhosim/index', 'CMS\BandhoSimImageController@index')->name('bandhosim.index');
    Route::post('mybl/settings/bandhosimimage/Store',
        'CMS\BandhoSimImageController@store')->name('mybl.settings.bandho.sim.image.store');
    Route::post('mybl/settings/bandhosimimage/update/{id}',
        'CMS\BandhoSimImageController@update')->name('mybl.settings.bandho.sim.image.update');

    /*
     *  API Debug For Developer
     */

    Route::get('developer/api/debug', 'CMS\ApiDebugController@userBalancePanel')->name('mybl.api.debug');
    Route::get('developer/api/debug/balance-summary/{number}', 'CMS\ApiDebugController@getBalanceSummary')
        ->name('mybl.api.debug.balance-summary');
    Route::get('developer/api/debug/balance-details/{number}/{type}', 'CMS\ApiDebugController@getBalanceDetails')
        ->name('mybl.api.debug.balance-details');

    Route::get('developer/api/debug/product/log/{number}',
        'CMS\ApiDebugController@getProductLogs')->name('product.api.log');

    Route::get('developer/api/debug/audit_logs/{number}', 'CMS\ApiDebugController@getBrowseHistory');
    Route::get('developer/api/debug/bonus_logs/{number}', 'CMS\ApiDebugController@getLoginBonusHistory');
    Route::get('developer/api/debug/otp-logs/{number}', 'CMS\ApiDebugController@getOtpRequestLogs');

    Route::get('developer/api/debug/otp-login-logs/{number}', 'CMS\ApiDebugController@getOtpLoginRequestLogs');

    Route::get('developer/api/debug/last-login/{number}', 'CMS\ApiDebugController@getLastLogin');

    Route::get('developer/api/debug/usage-summary/{number}', 'CMS\ApiDebugController@getUsageSummary');

    Route::get('developer/api/debug/usage-details/{number}/{type}', 'CMS\ApiDebugController@getUsageDetails');
    Route::get('developer/api/debug/contact-restore-logs/{number}', 'CMS\ApiDebugController@getContactRestoreLogs');

    // Agent Deeplink
    //    Route::resource('deeplink/agent', 'CMS\AgentListController');

    Route::get('deeplink/agent/list', 'CMS\AgentListController@index')->name('deeplink.agent.list');
    Route::get('deeplink/agent/create', 'CMS\AgentListController@create')->name('deeplink.agent.create');
    Route::POST('deeplink/agent/store', 'CMS\AgentListController@store')->name('deeplink.agent.store');
    Route::get('deeplink/agent/{id}/edit', 'CMS\AgentListController@edit')->name('deeplink.agent.edit');
    Route::get('deeplink/agent/{id}/change-status', 'CMS\AgentListController@changeStatus')->name('deeplink.agent.statusChange');
    Route::POST('deeplink/agent/{id}/update', 'CMS\AgentListController@update')->name('deeplink.agent.update');
    Route::DELETE('deeplink/agent/destroy/{id}', 'CMS\AgentListController@destroy')->name('deeplink.agent.destroy');

    // Agent deeplink list
    Route::get('deeplink/agent/deeplink/list', 'CMS\AgentListController@index')->name('deeplink.agent.list');
    Route::get('deeplink/agent/deeplink/list/{id}', 'CMS\AgentListController@viewAgentDeeplinkDetails')->name('deeplink.agent.deeplink.list');
    Route::POST('agent/deeplink/store', 'CMS\AgentListController@agentDeeplinkStore')->name('agent.deeplink.store');
    Route::get('agent/deeplink/item/delete/{agentId}/{id}', 'CMS\AgentListController@agentDeeplinkDelete')->name('agent.deeplink.item.delete');
    Route::get('agent/deeplink/report', 'CMS\AgentListController@agentDeeplinkReport')->name('agent.deeplink.report');
    Route::get('agent/deeplink/report/details/{id}', 'CMS\AgentListController@agentDeeplinkReportDetails')->name('agent.deeplink.report.details');
    Route::get('agent/deeplink/report/details', 'CMS\AgentListController@agentDeeplinkReport')->name('agent.deeplink.report');
    Route::POST('agent/deeplink/email-send', 'CMS\AgentListController@agentDeeplinkEmailSend')->name('agent.deeplink.emailsend');

    // Learn Priyojon Sections

    Route::get('mybl/learn-priyojon', 'CMS\LearnPriyojonContentController@show')->name('learn-priyojon.show');
    Route::post('mybl/learn-priyojon', 'CMS\LearnPriyojonContentController@store')->name('learn-priyojon.store');

    // Migrate Plan
    Route::resource('migrate-plan', 'CMS\MigratePlanController');
    Route::get('migrate-plan/destroy/{id}', 'CMS\MigratePlanController@destroy');

//    Banner Analytic
//    Route::resource('banner-analytic', 'CMS\BannerAnalyticController');
    Route::get('banner-analytic', 'CMS\BannerAnalyticController@index')->name('banner-analytic.index');
    Route::Get('banner-analytic/data', 'CMS\BannerAnalyticController@data')->name('banner-analytic.data');
    Route::Get('banner-analytic/report/details/{id}', 'CMS\BannerAnalyticController@detailreport')->name('banner-analytic.report.details');
    Route::Get('banner-analytic/purchase/report/details/{id}', 'CMS\BannerAnalyticController@purchaseDetailreport')->name('banner-analytic.purchase.report.details');

    /*
    * Refer And Earn
    */
    Route::resource('mybl-refer-and-earn', 'CMS\MyBlReferAndEarnController')->except(['show', 'destroy']);
    Route::get('mybl-refer-and-earn/destroy/{id}', 'CMS\MyBlReferAndEarnController@destroy');
    Route::get('mybl-refer-and-earn/campaign-details/{id}', 'CMS\MyBlReferAndEarnController@campaignDetails')
        ->name('refer-and-earn.campaign.details');
    Route::get('mybl-refer-and-earn/analytics', 'CMS\MyBlReferAndEarnController@getReferAndEarnAnalytics')
        ->name('refer-and-earn.analytics');

    Route::get('mybl-refer-and-earn/referee-details/{id}', 'CMS\MyBlReferAndEarnController@refereeDetails');


    /*
     *  Feed Routes
     */
    Route::namespace('CMS')->prefix('feeds')->name('feeds.')->group(function () {
        Route::resource('/', 'FeedController')->parameters(['' => 'feed'])->except('show');
        // Category resource
        Route::resource('categories', 'FeedCategoryController')->except('show');
        Route::get('categories/update-position',
            'FeedCategoryController@updatePosition')->name('categories.update_position');
    });
    Route::get('feed-list', 'CMS\FeedController@getFeedForAjax')->name('feed.ajax.request');

    /*
     * Product Activities
     */
    Route::get('mybl-product-activities', 'CMS\ProductActivityController@index')
        ->name('product-activities.history');
    Route::get('product-activities-details/{id}', 'CMS\ProductActivityController@show')
        ->name('product-activities.details');

    //App MENU  ====================================
    Route::get('mybl-menu/create', 'CMS\MyblAppMenuController@create');
    Route::get('mybl-menu/{id}/child-menu/create', 'CMS\MyblAppMenuController@create');
    Route::resource('mybl-menu', 'CMS\MyblAppMenuController')->only(['update', 'edit', 'store']);
    Route::get('mybl-menu/{id?}/{child_menu?}', 'CMS\MyblAppMenuController@index');
    Route::get('mybl-menu-auto-save', 'CMS\MyblAppMenuController@parentMenuSortable');
    Route::get('mybl-menu/{parentId}/destroy/{id}', 'CMS\MyblAppMenuController@destroy');
    /*
     * Dynamic Deeplink
     */
    Route::get('store-deeplink/create', 'CMS\DynamicDeeplinkController@storeDeepLinkCreate');
    Route::get('feed-deeplink/create', 'CMS\DynamicDeeplinkController@feedDeepLinkCreate');
    Route::get('mybl-campaign-section-deeplink/create', 'CMS\DynamicDeeplinkController@myblCampaignSectionDeepLinkCreate');
    Route::get('internet-pack-deeplink/create', 'CMS\DynamicDeeplinkController@internetPackDeepLinkCreate');
    Route::get('menu-deeplink/create', 'CMS\DynamicDeeplinkController@menuDeepLinkCreate');
    Route::get('manage-deeplink/create', 'CMS\DynamicDeeplinkController@manageDeepLinkCreate');
    Route::get('deeplink-analytic', 'CMS\DynamicDeeplinkController@analyticData');

    //App Manage  ====================================
    Route::resource('manage-category', 'CMS\MyblManageController')->except('show', 'destroy');
    Route::get('manage-category/destroy/{id}', 'CMS\MyblManageController@destroy')
        ->name('manage-category.destroy');
    Route::get('manage-category/sort-auto-save', 'CMS\MyblManageController@categorySortable');

    Route::prefix('mybl-manage-items/{category_id}')->group(function () {
        Route::get('/', 'CMS\MyblManageController@manageItemsList')->name('mybl-manage-items.index');
        Route::get('/create', 'CMS\MyblManageController@createItem')->name('mybl-manage-items.create');
        Route::post('/store', 'CMS\MyblManageController@storeItem')->name('mybl-manage-items.store');
        Route::get('/edit/{id}', 'CMS\MyblManageController@editItem')->name('mybl-manage-items.edit');
        Route::put('/update/{id}', 'CMS\MyblManageController@updateItem')->name('mybl-manage-items.update');
        Route::get('/destroy/{id}', 'CMS\MyblManageController@destroyItem')->name('mybl-manage-items.destroy');
        Route::get('/sort-auto-save', 'CMS\MyblManageController@itemSortable');
    });
    // Home Component
    Route::get('mybl-home-components', 'CMS\MyblHomeComponentController@index')->name('mybl.home.components');
    Route::get('mybl-home-components/edit/{id}', 'CMS\MyblHomeComponentController@edit')
        ->name('mybl.home.components.edit');
    Route::post('mybl-home-components/store', 'CMS\MyblHomeComponentController@store')
        ->name('mybl.home.components.store');
    Route::post('mybl-home-components/update', 'CMS\MyblHomeComponentController@update')
        ->name('mybl.home.components.update');
    Route::get('mybl-home-components-sort', 'CMS\MyblHomeComponentController@componentSort');
    Route::get('components-status-update/{id}', 'CMS\MyblHomeComponentController@componentStatusUpdate')
        ->name('components.status.update');

    // Flash Hour
    Route::resource('flash-hour-campaign', 'CMS\MyBlFlashHourController')->except(['show', 'destroy']);
    Route::get('flash-hour-campaign-duplicate/{id}', 'CMS\MyBlFlashHourController@duplicateFlashHours')->name('flash-hour-campaign.duplicate');
    Route::get('flash-hour-campaign/destroy/{id}', 'CMS\MyBlFlashHourController@destroy');

    Route::get('flash-hour-analytic/{campaign_id}', 'CMS\MyBlFlashHourController@analyticReport')
        ->name('flash-hour-analytic.report');

    Route::get('flash-hour-purchase-msisdn-list/{campaignId}/{purchaseID}', 'CMS\MyBlFlashHourController@purchaseMsisdnList')
        ->name('mybl-campaign.purchase-msisdn.list');

    Route::get('flash-hour-purchase-msisdn/{id}', 'CMS\MyBlFlashHourController@purchaseDetails');

    // Mybl Campaign
    Route::resource('mybl-campaign', 'CMS\MyBlCampaignController')->except(['show', 'destroy']);
    Route::get('mybl-campaign/destroy/{id}', 'CMS\MyBlCampaignController@destroy');

    Route::get('mybl-campaign-analytic/{campaign_id}', 'CMS\MyBlCampaignController@analyticReport')
        ->name('mybl-campaign-analytic.report');

    Route::get('mybl-campaign-purchase-msisdn-list/{campaignId}/{purchaseID}', 'CMS\MyBlCampaignController@purchaseMsisdnList')
        ->name('purchase-msisdn.list');

    Route::get('mybl-campaign-purchase-msisdn/{id}', 'CMS\MyBlCampaignController@purchaseDetails');

//    Route::get('flash-hour-campaign/analytics', 'CMS\MyBlFlashHourController@getReferAndEarnAnalytics')
//        ->name('refer-and-earn.analytics');

    // Cash Back Campaign
    Route::resource('cash-back-campaign', 'CMS\MyBlCashBackController')->except(['show', 'destroy']);
    Route::get('cash-back-campaign/destroy/{id}', 'CMS\MyBlCashBackController@destroy');

    /*
     * Event Base bonus
     */
    Route::get('event-base-bonus/tasks-del/{id}', 'CMS\EventBaseTaskController@delete');
    Route::resource('event-base-bonus/tasks', 'CMS\EventBaseTaskController')->except(['show']);
    Route::resource('event-base-bonus/campaigns', 'CMS\EventBaseCampaignController')->except(['show']);
    Route::get('event-base-bonus/analytics', 'CMS\EventBaseTaskAnalyticController@index');
    Route::post('event-base-bonus/analytics/find', 'CMS\EventBaseTaskAnalyticController@analytics');
    Route::post('event-base-bonus/analytics/search', 'CMS\EventBaseTaskAnalyticController@analyticsUserDetails');
    Route::get('event-base-bonus/analytics/{campaign}/{task}', 'CMS\EventBaseTaskAnalyticController@viewDetails');

    Route::get('mybl-home-components/destroy/{id}', 'CMS\MyblHomeComponentController@destroy')
        ->name('mybl.home.components.destroy');
    //    Free Product Purchase Report
    Route::get('free-product-purchase-report', 'CMS\MyblProductEntryController@freeProductPurchaseReport')
        ->name('free-product.purchase.report');

    Route::get('free-product-purchase-msisdn/{id}', 'CMS\MyblProductEntryController@purchaseDetails')
        ->name('free-product-purchase-msisdn.list');

    Route::get('product-schedule', 'CMS\MyblProductEntryController@getScheduleProduct')
        ->name('product.schedule');

    Route::get('product-schedule-revert/{id}', 'CMS\MyblProductEntryController@getScheduleProductRevert');

    Route::get('product-schedule-view/{id}', 'CMS\MyblProductEntryController@scheduleProductsView')->name('schedule-product.view');

    /*
     * Event Base bonus V2
     */
    Route::get('event-base-bonus/v2/tasks-del/{id}', 'CMS\EventBaseTaskV2Controller@delete');
    Route::resource('event-base-bonus/v2/tasks', 'CMS\EventBaseTaskV2Controller')->except(['show']);
    Route::resource('event-base-bonus/v2/campaigns', 'CMS\EventBaseCampaignV2Controller')->except(['show']);
    Route::get('event-base-bonus/v2/analytics', 'CMS\EventBaseTaskAnalyticV2Controller@index');
    Route::post('event-base-bonus/v2/analytics/find', 'CMS\EventBaseTaskAnalyticV2Controller@analytics');
    Route::post('event-base-bonus/v2/analytics/search', 'CMS\EventBaseTaskAnalyticV2Controller@analyticsUserDetails');
    Route::get('event-base-bonus/v2/analytics/{campaign}/', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallenges');
    Route::get('event-base-bonus/v2/analytics/{campaign}/{challenge}/', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallengeTasks');
    Route::get('event-base-bonus/v2/analytics/{campaign}/{challenge}/{task}/{msisdn?}', 'CMS\EventBaseTaskAnalyticV2Controller@viewCampaignChallengeTaskMsisdnList');
    Route::resource('event-base-bonus/v2/challenges', 'CMS\EventBaseChallengeV2Controller')->except(['show']);
    Route::get('event-base-bonus/v2/campaign-del/{id}', 'CMS\EventBaseCampaignV2Controller@delete');

    /*
    * Usim Eligibility
    */
    Route::get('usim-eligibility', 'CMS\MyblUsimEligibilityController@index')
        ->name('usim-eligibility.index');
    Route::post('usim-eligibility-update/{id}', 'CMS\MyblUsimEligibilityController@update')
        ->name('usim-eligibility.update');

    Route::get('usim-eligibility-massage', 'CMS\MyblUsimEligibilityController@showMassage')
        ->name('usim-eligibility.show.massage');
    Route::post('usim-eligibility-massage-save', 'CMS\MyblUsimEligibilityController@saveMassage')
        ->name('usim-eligibility.save.massage');

    //Mybl Welcome Banner
    Route::resource('welcome-banner', 'CMS\WelcomeBannerController')->except(['show']);
    Route::post('welcome-banner/set-order', 'CMS\WelcomeBannerController@order');

    // Health Hub
    Route::resource('health-hub', 'CMS\HealthHubController')->except(['show', 'destroy']);
    Route::get('health-hub-auto-save', 'CMS\HealthHubController@itemSortable');
    Route::get('health-hub/destroy/{id}', 'CMS\HealthHubController@destroy')->name('healthHubItem.destroy');
    Route::get('health-hub-analytic-data', 'CMS\HealthHubController@analyticData')->name('health-hub.analytics');
    Route::get('health-hub-item-details/{itemId}', 'CMS\HealthHubController@analyticReportsItem');
    Route::get('health-hub-deeplink/analytic', 'CMS\HealthHubController@deeplinkAnalytic')
        ->name('health-hub-deeplink.analytic');
    Route::get('health-hub-deeplink/analytic-details/{dynamic_deeplink_id}', 'CMS\HealthHubController@deeplinkAnalyticDetails')
        ->name('health-hub-deeplink-analytic-details');



    Route::get('get-feed-data/{cat_id?}', 'CMS\HealthHubController@getFeedsData')->name('feed.data');

    // Guest User Tracking Page Wise
    Route::get('guest-user-track-list', 'CMS\GuestUserTrackController@index')
        ->name('guest-user-track-list');
    Route::post('guest-user-data-export', 'CMS\GuestUserTrackController@dataExport')
        ->name('guest-user-data-export');
    Route::post('guest-user-show-data', 'CMS\GuestUserTrackController@showData')
        ->name('guest-user-show-data');
    Route::get('guest-user-data-download', 'CMS\GuestUserTrackController@downloadFile');

    //Loyality Image Upload
    Route::resource('loyalty-partner-image', 'CMS\LoyaltyPartnerImageController')->except(['show']);
    Route::get('loyalty-partner-images/filter', 'CMS\LoyaltyPartnerImageController@filter');
    Route::get('loyalty-partner-images/report', 'CMS\LoyaltyPartnerImageController@report');

    /**
     * SMS Language Config
     */
    Route::get('sms-languages', 'CMS\SmsLanguageController@index')->name('sms-languages.index');
    Route::get('sms-languages/create', 'CMS\SmsLanguageController@create')->name('sms-languages.create');
    Route::get('sms-languages/edit/{id}', 'CMS\SmsLanguageController@edit')->name('sms-languages.edit');
    Route::post('sms-languages/store', 'CMS\SmsLanguageController@store')->name('sms-languages.store');
    Route::put('sms-languages/update/{id}', 'CMS\SmsLanguageController@update')->name('sms-languages.update');

    /**
     * New Campaign Modality
     */
    Route::resource('new-campaign-modality', 'CMS\MyBlNewCampaignModalityController')->except(['show', 'destroy']);
    Route::get('new-campaign-modality/destroy/{id}', 'CMS\MyBlNewCampaignModalityController@destroy');
    Route::get('new-campaign-analytic/{campaign_id}', 'CMS\MyBlNewCampaignModalityController@analyticReport')
        ->name('new-campaign-analytic.report');
    Route::get('new-campaign-purchase-msisdn-list/{campaignId}/{purchaseID}', 'CMS\MyBlNewCampaignModalityController@purchaseMsisdnList')
        ->name('new-campaign.purchase-msisdn.list');

    Route::resource('mybl-campaign-section', 'CMS\NewCampaignModality\MyBlCampaignSectionController')->except(['show', 'destroy']);
    Route::get('mybl-campaign-section/destroy/{id}', 'CMS\NewCampaignModality\MyBlCampaignSectionController@destroy')->name('mybl-campaign-section.destroy');
    Route::get('mybl-campaign-section/sort-auto-save', 'CMS\NewCampaignModality\MyBlCampaignSectionController@categorySortable');

    Route::resource('mybl-campaign-winners', 'CMS\NewCampaignModality\MyBlCampaignWinnerController')->except(['show', 'destroy']);
    Route::get('mybl-campaign-winners/destroy/{id}', 'CMS\NewCampaignModality\MyBlCampaignWinnerController@destroy')->name('mybl-campaign-winner.destroy');
    /**
     * Home Navigation Rail
     */
    Route::resource('heme-navigation-rail', 'CMS\HomeNavigationRailController');
    Route::get('heme-navigation-rail-sortable', 'CMS\HomeNavigationRailController@navigationMenuSortable')
        ->name('navigation-rail.sort');
    Route::get('heme-navigation-rail/destroy/{id}', 'CMS\HomeNavigationRailController@destroy')
        ->name('heme-navigation-rail.destroy');

    /**
     * FIFA WC
     */
    Route::resource('teams', 'CMS\FIFA\TeamController');
    Route::get('teams/destroy/{id}', 'CMS\FIFA\TeamController@destroy')
        ->name('teams.destroy');

    Route::resource('matches', 'CMS\FIFA\MatchController');
    Route::get('matches/destroy/{id}', 'CMS\FIFA\MatchController@destroy')
        ->name('matches.destroy');

    Route::get('signed-cookie', 'CMS\FIFA\MatchController@signedCookie')->name('signed-cookie');
    Route::get('generate-cookie/{id}', 'CMS\FIFA\MatchController@generateCookie')
        ->name('generate-cookie');

    Route::get('fifa-content', 'CMS\FIFA\FifaContentController@createOrEdit')->name('fifa-content');

    Route::post('fifa-content', 'CMS\FIFA\FifaContentController@store')
        ->name('fifa-content.update');
});

// 4G Map View Route
Route::view('/4g-map', '4g-map.view');

Route::get( 'winner-test', function() {
    $myBlCampaignWinnerSelectionService = resolve(MyBlCampaignWinnerSelectionService::class);
    return $myBlCampaignWinnerSelectionService->processCampaignWinner();
  });
