<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('permissions', 'PermissionController');

    Route::resource('roles', 'RoleController');

    Route::resource('users', 'UserController');

    Route::resource('reports', 'ReportController');

    Route::get('reports/create-report/{id}', 'ReportController@createByForm')->name('reports.create-report');

    Route::put('evaluation/update-evaluation/{report}', 'ReportController@updateSingleEvaluation')->name('reports.updateSingleEvaluation');

    Route::put('report-comment/{report}', 'ReportController@comment')->name('reports.comment');

    Route::resource('criteria', 'CriterionController');

    Route::resource('competencies', 'CompetencyController');

    Route::resource('evaluations', 'EvaluationsController');

    Route::resource('forms', 'FormController');

    Route::get('stats/index', 'StatsController@index')->name('stats.index');

});
