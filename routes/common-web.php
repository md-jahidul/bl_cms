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
    return view('home');
})->middleware('auth');

Auth::routes();
Route::get('/home', 'CMS\HomeController@index')->name('home');
Route::group(['middleware' => ['webAdmin']], function () {

    Route::resource('questions', 'CMS\QuestionController');
//    Route::resource('prize', 'CMS\PrizeController');
    // Route::resource('tags','CMS\TagController');
    Route::resource('campaigns','CMS\CampaignController');

Route::resource('questions', 'CMS\QuestionController');
Route::resource('campaigns','CMS\CampaignController');

});


