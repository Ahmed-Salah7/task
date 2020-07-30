<?php
Auth::routes();

Route::namespace('User')->group(function () {
    Route::get('/dashboard', 'DesignController@index');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('User')->group(function () {

    Route::resource('/products', 'ProductController', [
        'names' => [
            'index' => 'products.index',
            'show' => 'product.show',
        ]
    ]);
    Route::get('/products-index-ajax', 'ProductController@products_index_ajax')->name('products.index.ajax');
});
