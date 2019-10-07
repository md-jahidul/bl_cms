<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Model\MixedBundleFilter;
use App\Models\Shortcut;

Route::get('/', function () {
    return view('admin.admin-auth.login');
})->name('test');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['webAdmin']], function () {

    Route::resource('questions', 'CMS\QuestionController');
    Route::resource('prize', 'CMS\PrizeController');
    // Route::resource('tags','CMS\TagController');
    Route::resource('campaigns','CMS\CampaignController');

Route::resource('questions', 'CMS\QuestionController');
Route::resource('campaigns','CMS\CampaignController');

});

Route::get('mixed-bundle-offer/filter/create','CMS\MixedBundleFilterController@create')->name('mixed-bundle-offer.filter.create');
Route::post('mixed-bundle-offer/filter/price/save','CMS\MixedBundleFilterController@savePriceFilter')->name('mixed-bundle-offer.filter.price.save');
Route::get('mixed-bundle-offer/filter/price','CMS\MixedBundleFilterController@getPriceFilter')->name('mixed-bundle-offer.filter.price.list');

Route::post('mixed-bundle-offer/filter/delete','CMS\MixedBundleFilterController@deleteFilter')->name('mixed-bundle-offer.filter.delete');

Route::post('mixed-bundle-offer/filter/internet/save','CMS\MixedBundleFilterController@saveInternetFilter')->name('mixed-bundle-offer.filter.internet.save');
Route::get('mixed-bundle-offer/filter/internet','CMS\MixedBundleFilterController@getInternetFilter')->name('mixed-bundle-offer.filter.internet.list');

Route::post('mixed-bundle-offer/filter/minutes/save','CMS\MixedBundleFilterController@saveMinutesFilter')->name('mixed-bundle-offer.filter.minutes.save');
Route::get('mixed-bundle-offer/filter/minutes','CMS\MixedBundleFilterController@getMinutesFilter')->name('mixed-bundle-offer.filter.minutes.list');

Route::post('mixed-bundle-offer/filter/sms/save','CMS\MixedBundleFilterController@saveSmsFilter')->name('mixed-bundle-offer.filter.sms.save');
Route::get('mixed-bundle-offer/filter/sms','CMS\MixedBundleFilterController@getSmsFilter')->name('mixed-bundle-offer.filter.sms.list');

Route::post('mixed-bundle-offer/filter/validity/save','CMS\MixedBundleFilterController@saveValidityFilter')->name('mixed-bundle-offer.filter.validity.save');
Route::get('mixed-bundle-offer/filter/validity','CMS\MixedBundleFilterController@getValidityFilter')->name('mixed-bundle-offer.filter.validity.list');

Route::post('mixed-bundle-offer/filter/sort/save','CMS\MixedBundleFilterController@saveSortFilter')->name('mixed-bundle-offer.filter.sort.save');

Route::get('/test/test','CMS\MixedBundleFilterController@getPriceFilter');


Route::get('internet-pack/filter/create','CMS\InternetPackFilterController@create')->name('internet-pack.filter.create');
Route::post('internet-pack/price/save','CMS\InternetPackFilterController@savePriceFilter')->name('internet-pack.filter.price.save');
Route::get('internet-pack/filter/price','CMS\InternetPackFilterController@getPriceFilter')->name('internet-pack.filter.price.list');

Route::post('internet-pack/filter/delete','CMS\MixedBundleFilterController@deleteFilter')->name('internet-pack.filter.delete');

Route::post('internet-pack/filter/internet/save','CMS\InternetPackFilterController@saveInternetFilter')->name('internet-pack.filter.internet.save');
Route::get('internet-pack/filter/internet','CMS\InternetPackFilterController@getInternetFilter')->name('internet-pack.filter.internet.list');

Route::post('internet-pack/filter/validity/save','CMS\InternetPackFilterController@saveValidityFilter')->name('internet-pack.filter.validity.save');
Route::get('internet-pack/filter/validity','CMS\InternetPackFilterController@getValidityFilter')->name('internet-pack.filter.validity.list');


Route::get('/test2/',function (){

    dd (new MixedBundleFilter());
});
