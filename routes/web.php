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
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('materi', 'MateriController');
    Route::get('soal/getSoalForm', 'SoalController@getSoalForm')->name('soal.form');
    Route::resource('soal', 'SoalController');
    Route::resource('kelas', 'KelasController');
    Route::get('laporan/{id}/jawaban/{user_id}', 'LaporanController@getJawaban');
    Route::resource('laporan', 'LaporanController');
    Route::resource('biodata', 'BiodataController');
});
