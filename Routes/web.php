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
    Route::get('/plan/index', 'PlanController@index')->name('performance_contract.plan.index');
    Route::get('/plan/create', 'PlanController@create')->name('performance_contract.plan.create');
    Route::get('/plan/{plan}/edit', 'PlanController@edit')->name('performance_contract.plan.edit');
    Route::get('/plan/{plan}/show', 'PlanController@show')->name('performance_contract.plan.show');
    Route::get('/plan/{plan}/copy', 'PlanController@copy')->name('performance_contract.plan.copy');
    Route::get('/plan/{plan}/reuse', 'PlanController@reuse')->name('performance_contract.plan.reuse');
    Route::get('/plan/{plan}/share', 'PlanController@share')->name('performance_contract.plan.share');
    Route::get('/plan/{plan}/download', 'PlanController@download')->name('performance_contract.plan.download');

    Route::get('/rating/{plan}/midyear', 'RatingController@midyear')->name('performance_contract.rating.midyear');
    Route::get('/rating/{plan}/endyear', 'RatingController@endyear')->name('performance_contract.rating.endyear');
    Route::get('/rating/{plan}/performance', 'RatingController@performance')->name('performance_contract.rating.performance');
    Route::get('/rating/{plan}/download', 'RatingController@download')->name('performance_contract.rating.download');

    Route::get('/shared/inbox', 'SharedController@inbox')->name('performance_contract.shared.inbox');
    Route::get('/shared/outbox', 'SharedController@outbox')->name('performance_contract.shared.outbox');

    Route::get('/appraisal/index', 'AppraisalController@index')->name('performance_contract.appraisal.index');
    Route::get('/appraisal/{plan}/show', 'AppraisalController@show')->name('performance_contract.appraisal.show');
    Route::get('/appraisal/{plan}/midyear', 'AppraisalController@midyear')->name('performance_contract.appraisal.midyear');
    Route::get('/appraisal/{plan}/endyear', 'AppraisalController@endyear')->name('performance_contract.appraisal.endyear');
    Route::get('/appraisal/{plan}/performance', 'AppraisalController@performance')->name('performance_contract.appraisal.performance');

    Route::get('/report/index', 'ReportController@index')->name('performance_contract.report');
    Route::get('/report/{financialYear}/download', 'ReportController@download')->name('performance_contract.report.download');




});
