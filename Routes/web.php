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

Route::prefix('performance_contract')->group(function() {

    Route::get('/', 'HomeController@index')->name('performance_contract.home');
    Route::get('/plans', 'PlanController@index')->name('performance_contract.index');
    Route::get('/plan/create', 'PlanController@create')->name('performance_contract.create');
    Route::get('/plan/{plan}/edit', 'PlanController@edit')->name('performance_contract.edit');
    Route::get('/plan/{plan}/show', 'PlanController@show')->name('performance_contract.show');

});
