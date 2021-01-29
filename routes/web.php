<?php
Route::get('/admin/ldap', function () {
    $ldapConn = ldap_connect('ldap.forumsys.com');
    ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldapConn, LDAP_OPT_REFERRALS, 0);
    $password='password';
    $mail = 'riemann@ldap.forumsys.com';
    if (ldap_bind($ldapConn, 'cn=read-only-admin,dc=example,dc=com', 'password')) {
        $arr = array('dn', 1);
        $result = ldap_search($ldapConn, 'dc=example,dc=com', "(mail=$mail)", $arr);
        $entries = ldap_get_entries($ldapConn, $result);
        echo "<br><hr>";
        print_r($entries);
        if ($entries['count'] > 0) {
            if (ldap_bind($ldapConn, $entries[0]['dn'], $password)) {
                // user with mail $mail is checked with password $password
                echo 'user auth success';
            } else {
                echo 'user auth failed';
            }
        }
    }
    ldap_close($ldapConn);
});
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

    Route::resource('reports', 'ReportsController');

    Route::get('reports/create-report/{id}', 'ReportsController@createByForm')->name('reports.create-report');

    Route::put('evaluation/update-evaluation/{report}', 'ReportsController@updateSingleEvaluation')->name('reports.updateSingleEvaluation');

    Route::put('report-comment/{report}', 'ReportsController@comment')->name('reports.comment');

    Route::delete('criteria/destroy', 'CriteriaController@massDestroy')->name('criteria.massDestroy');

    Route::resource('criteria', 'CriteriaController');

    Route::delete('competencies/destroy', 'CompetencyController@massDestroy')->name('competencies.massDestroy');

    Route::resource('competencies', 'CompetencyController');

    Route::delete('evaluations/destroy', 'EvaluationsController@massDestroy')->name('evaluations.massDestroy');

    Route::resource('evaluations', 'EvaluationsController');

    Route::resource('forms', 'FormsController');

    Route::delete('forms/destroy', 'FormsController@massDestroy')->name('forms.massDestroy');

    Route::get('stats/index', 'StatsController@index')->name('stats.index');

});
