<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('drugs', 'DrugsController');
Route::resource('drugs.batches', 'DrugBatchesController');
Route::resource('sales', 'SalesController');
Route::get('reports', 'ReportsController@general');
