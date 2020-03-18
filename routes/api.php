<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::get('/kelas', 'AuthController@getKelas');
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    Route::apiResource('materi', 'MateriController');
    Route::apiResource('soal', 'SoalController');
    Route::apiResource('ljk', 'JawabanController');
});