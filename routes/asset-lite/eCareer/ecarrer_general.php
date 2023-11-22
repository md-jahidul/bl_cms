<?php

use Illuminate\Support\Facades\Route;

Route::get('life-at-banglalink/general',
    'AssetLite\EcareerController@generalIndex')->name('life.at.banglalink.general');
Route::post('life-at-banglalink/general-seo-store','AssetLite\EcareerController@createOrUpdateSeo')->name('life.at.banglalink.general-seo-store');
Route::get('life-at-banglalink/general/create',
    'AssetLite\EcareerController@generalCreate')->name('life.at.banglalink.general.create');
Route::post('life-at-banglalink/general/store',
    'AssetLite\EcareerController@generalStore')->name('life.at.banglalink.general.store');
Route::get('life-at-banglalink/general/{id}/edit',
    'AssetLite\EcareerController@generalEdit')->name('life.at.banglalink.general.edit');
Route::post('life-at-banglalink/general/{id}/update',
    'AssetLite\EcareerController@generalUpdate')->name('life.at.banglalink.general.update');
Route::get('life-at-banglalink/general/destroy/{id}',
    'AssetLite\EcareerController@generalDestroy')->name('life.at.banglalink.general.destroy');
Route::get('life-at-banglalink/general/sort', 'AssetLite\EcareerController@generalSort')->name('life.at.banglalink.general.sort');

Route::get('life-at-banglalink/general/{id}/list', 'AssetLite\EcareerController@generalChildIndex')->name('life.at.banglalink.general.child.index');
?>
