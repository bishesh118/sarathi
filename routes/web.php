<?php


Route::any('/', 'ApplicationController@index')->name('home');

Route::group(['prefix'=>'@admin'],function (){
    Route::any('/', 'LocationController@locations')->name('locations');
    Route::any('view-map', 'LocationController@viewMap')->name('view-map');
    Route::any('add-location', 'LocationController@showMap')->name('show-map');

});

