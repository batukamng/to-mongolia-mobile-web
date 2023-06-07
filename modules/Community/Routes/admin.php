<?php
use Illuminate\Support\Facades\Route;

Route::get('/','CommunityController@index')->name('community.admin.index');
Route::get('/create','CommunityController@create')->name('community.admin.create');
Route::get('/edit/{id}','CommunityController@edit')->name('community.admin.edit');
Route::post('/store/{id}','CommunityController@store')->name('community.admin.store');
Route::get('/getForSelect2','CommunityController@getForSelect2')->name('community.admin.getForSelect2');
Route::post('/bulkEdit','CommunityController@bulkEdit')->name('community.admin.bulkEdit');
Route::get('/recovery','CommunityController@recovery')->name('community.admin.recovery');
Route::get('/getForSelect2','CommunityController@getForSelect2')->name('community.admin.getForSelect2');

Route::get('/category','CategoryController@index')->name('community.admin.category.index');
Route::get('/category/edit/{id}','CategoryController@edit')->name('community.admin.category.edit');
Route::post('/category/store/{id}','CategoryController@store')->name('community.admin.category.store');
Route::get('/category/getForSelect2','CategoryController@getForSelect2')->name('community.admin.category.category.getForSelect2');
Route::post('/category/bulkEdit','CategoryController@bulkEdit')->name('community.admin.category.bulkEdit');

Route::group(['prefix'=>'attribute'],function(){
    Route::get('/','AttributeController@index')->name('community.admin.attribute.index');
    Route::get('/edit/{id}','AttributeController@edit')->name('community.admin.attribute.edit');
    Route::post('/store/{id}','AttributeController@store')->name('community.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('community.admin.attribute.editAttrBulk');


    Route::get('/terms/{attr_id}','AttributeController@terms')->name('community.admin.attribute.term.index');
    Route::get('/term_edit/{id}','AttributeController@term_edit')->name('community.admin.attribute.term.edit');
    Route::post('/term_store/{id}','AttributeController@term_store')->name('community.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('community.admin.attribute.term.editTermBulk');
});


Route::group(['prefix'=>'availability'],function(){
    Route::get('/','AvailabilityController@index')->name('community.admin.availability.index');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('community.admin.availability.loadDates');
    Route::post('/store','AvailabilityController@store')->name('community.admin.availability.store');
});


Route::get('/booking','BookingController@index')->name('community.admin.booking.index');
