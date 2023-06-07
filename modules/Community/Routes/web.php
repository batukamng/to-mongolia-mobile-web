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
use Illuminate\Support\Facades\Route;
// Vendor Manage Community
Route::group(['prefix'=>'user/'.config('community.community_route_prefix'),'middleware' => ['auth','verified']],function(){
    Route::get('/','ManageCommunityController@manageCommunity')->name('community.vendor.index');
    Route::get('/create','ManageCommunityController@createCommunity')->name('community.vendor.create');
    Route::get('/edit/{id}','ManageCommunityController@editCommunity')->name('community.vendor.edit');
    Route::get('/del/{id}','ManageCommunityController@deleteCommunity')->name('community.vendor.delete');
    Route::post('/store/{id}','ManageCommunityController@store')->name('community.vendor.store');
    Route::get('bulkEdit/{id}','ManageCommunityController@bulkEditCommunity')->name("community.vendor.bulk_edit");
    Route::get('clone/{id}','ManageCommunityController@cloneCommunity')->name("community.vendor.clone");
    Route::get('/booking-report/bulkEdit/{id}','ManageCommunityController@bookingReportBulkEdit')->name("community.vendor.booking_report.bulk_edit");
    Route::get('/recovery','ManageCommunityController@recovery')->name('community.vendor.recovery');
    Route::get('/restore/{id}','ManageCommunityController@restore')->name('community.vendor.restore');
});
Route::group(['prefix'=>'user/'.config('community.community_route_prefix')],function(){
    Route::group(['prefix'=>'availability'],function(){
        Route::get('/','AvailabilityController@index')->name('community.vendor.availability.index');
        Route::get('/loadDates','AvailabilityController@loadDates')->name('community.vendor.availability.loadDates');
        Route::post('/store','AvailabilityController@store')->name('community.vendor.availability.store');
    });
});
// Community
Route::group(['prefix'=>config('community.community_route_prefix')],function(){
    Route::get('/','\Modules\Community\Controllers\CommunityController@index')->name('community.search'); // Search
    Route::get('/{slug}','\Modules\Community\Controllers\CommunityController@detail');// Detail
});
