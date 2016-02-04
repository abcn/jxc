<?php
/**
 * Created by PhpStorm.
 * User: zhouhaotong
 * Date: 16/2/5
 * Time: 上午12:27
 */
Route::group(['namespace' => 'Market','middleware' => 'market'], function() {
    Route::get('market/list','IndexController@index')->name('market.list');
    Route::get('market/{id}/info','IndexController@info')->name('market.info');
    Route::post('market/{id}/action','IndexController@action')->name('market.action');
});
Route::group(['namespace' => 'Market','middleware' => 'guest'], function() {
    Route::get('market/login','IndexController@login')->name('market.login');
});
