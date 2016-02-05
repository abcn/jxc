<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/4
 * Time: 上午11:07
 */
Route::group(['namespace' => 'Market'], function() {
    Route::get('market/data','MarketController@data')->name('admin.market.data');
    Route::post('market/action','MarketController@action')->name('admin.market.action');
    Route::resource('market','MarketController');
});
