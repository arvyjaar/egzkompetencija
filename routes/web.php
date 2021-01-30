<?php
/*
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
*/
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
