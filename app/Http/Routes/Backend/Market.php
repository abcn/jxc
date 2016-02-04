<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/4
 * Time: 上午11:07
 */
Route::group(['namespace' => 'Market'], function() {
    Route::get('market','MarketController@index')->name('admin.market');
    Route::get('market/create','MarketController@create')->name('admin.market.create');
    Route::get('market/data','MarketController@data')->name('admin.market.data');
});
