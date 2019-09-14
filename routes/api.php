<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('monitoring-reports', 'MonitoringReportApiController');

    Route::apiResource('points', 'PointApiController');

    Route::apiResource('criteria', 'CriteriaApiController');

    Route::apiResource('evaluations', 'EvaluationApiController');

    Route::apiResource('tools', 'ToolApiController');
});
