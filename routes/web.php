<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', 'TopController@top');

Route::group(['prefix' => 'items'], function () {
    Route::get('/', 'ItemController@search')
        ->name('items.search');
    Route::get('/detail/{item_id}', 'ItemController@detail')
        ->where(['item_id' => '\d+'])
        ->name('items.detail');
});
