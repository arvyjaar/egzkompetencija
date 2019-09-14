<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('monitoring-reports/destroy', 'MonitoringReportController@massDestroy')->name('monitoring-reports.massDestroy');

    Route::resource('monitoring-reports', 'MonitoringReportController');

    Route::delete('points/destroy', 'PointController@massDestroy')->name('points.massDestroy');

    Route::resource('points', 'PointController');

    Route::delete('criteria/destroy', 'CriteriaController@massDestroy')->name('criteria.massDestroy');

    Route::resource('criteria', 'CriteriaController');

    Route::delete('evaluations/destroy', 'EvaluationController@massDestroy')->name('evaluations.massDestroy');

    Route::resource('evaluations', 'EvaluationController');

    Route::delete('tools/destroy', 'ToolController@massDestroy')->name('tools.massDestroy');

    Route::resource('tools', 'ToolController');
});
