<?php

Route::namespace('Administration')->group(function () {

    Route::get('/dashboard', 'DesignController@index')->name('admin.home');;

    Route::resource('/users', 'UserController', [
        'names' => [
            'index' => 'admin.users.index',
            'show' => 'admin.user.show',
            'create' => 'admin.user.create',
            'store' => 'admin.user.store',
            'edit' => 'admin.user.edit',
            'update' => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
        ]
    ]);
    Route::get('/permissions-index-ajax', 'UserController@users_index_ajax')->name('admin.users.index.ajax');


    Route::resource('/products', 'ProductController', [
        'names' => [
            'index' => 'admin.products.index',
            'show' => 'admin.product.show',
            'create' => 'admin.product.create',
            'store' => 'admin.product.store',
            'edit' => 'admin.product.edit',
            'update' => 'admin.product.update',
            'destroy' => 'admin.product.destroy',
        ]
    ]);
    Route::get('/products-index-ajax', 'ProductController@products_index_ajax')->name('admin.products.index.ajax');


    Route::resource('/administrations', 'AdministrationController', [
        'names' => [
            'index' => 'admin.administrations.index',
            'show' => 'admin.administration.show',
            'create' => 'admin.administration.create',
            'store' => 'admin.administration.store',
            'edit' => 'admin.administration.edit',
            'update' => 'admin.administration.update',
            'destroy' => 'admin.administration.destroy',
        ]
    ]);
    Route::get('/administration-index-ajax', 'AdministrationController@administrations_index_ajax')->name('admin.administrations.index.ajax');


    Route::resource('/roles', 'RoleController', [
        'names' => [
            'index' => 'admin.roles.index',
            'show' => 'admin.role.show',
            'create' => 'admin.role.create',
            'store' => 'admin.role.store',
            'edit' => 'admin.role.edit',
            'update' => 'admin.role.update',
            'destroy' => 'admin.role.destroy',
        ]
    ]);
    Route::get('/roles-index-ajax', 'RoleController@roles_index_ajax')->name('admin.roles.index.ajax');


    Route::resource('/permissions', 'PermissionController', [
        'names' => [
            'index' => 'admin.permissions.index',
            'show' => 'admin.permission.show',
        ]
    ])->only(['index', 'show']);
    Route::get('/users-permission-ajax', 'PermissionController@permissions_index_ajax')->name('admin.permissions.index.ajax');


    Route::get('/media-index', 'MediaController@index')->name('admin.media.index');
    Route::post('/media-upload', 'MediaController@media_upload')->name('admin.media.upload');
    Route::get('/media-get', 'MediaController@media_get')->name('admin.media.get');
    Route::get('/media-delete/{media}', 'MediaController@media_delete')->name('admin.media.delete');
    Route::get('/media-download/{media}', 'MediaController@media_download')->name('admin.media.download');
    Route::get('/media-download-all', 'MediaController@media_download_all')->name('admin.media.download.all');
    Route::get('/media-update/{media}', 'MediaController@media_update')->name('admin.media.update');
});

Route::namespace('Auth')->group(function () {

    Route::get('login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'AdminLoginController@login')->name('admin.login.post');

    Route::post('/logout', 'AdminLoginController@admin_logout')->name('admin.logout');


    Route::post('password/email', 'AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset', 'AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset', 'AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('password/reset/{token}', 'AdminResetPasswordController@showResetForm')->name('admin.password.reset');

});




