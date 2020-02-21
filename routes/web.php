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

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('deputies', 'DeputyController');

    Route::resource('categories', 'CategoryController');

    Route::resource('subcategories', 'SubcategoryController');

    Route::get('letters/get_ref_no/{deputy_id}/{category_id}/{sub_category_id}', 'LetterController@getRefNo');
    Route::get('letters/get_cat/{id}', 'LetterController@getCat');
    Route::get('letters/get_sub_cat/{id}', 'LetterController@getSubCat');
    Route::resource('letters', 'LetterController');
    Route::resource('instance-settings', 'InstanceSettingsController');
});
