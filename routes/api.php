<?php

Route::fallback('Controller@fallback');


Route::group(['prefix' => '/users', 'namespace' => 'User'], function () {

    Route::get('/show/{user}', 'UsersController@show')->middleware(['optionalJwtAuth']);

});


Route::group(['prefix' => '/products', 'namespace' => 'Product'], function () {

    Route::get('/', 'ProductController@index')->middleware(['jwtAuth']);
    Route::get('/category', 'ProductController@categories')->middleware(['jwtAuth']);
});


Route::group(['prefix' => '/orders', 'namespace' => 'Order'], function () {

    Route::post('/new', 'OrderController@new')->middleware(['jwtAuth']);
    Route::get('/', 'OrderController@index')->middleware(['jwtAuth']);
});

Route::group(['prefix' => '/home', 'namespace' => 'Home'], function () {

    Route::get('/', 'HomeController@index')->middleware(['jwtAuth']);
});


Route::group(['prefix' => '/auth', 'namespace' => 'Auth'], function () {
    Route::post('send-otp', 'AuthController@sendOtp');
    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => 'jwtAuth'], function () {
        Route::get('logout', 'AuthController@logout');
    });
});

Route::group(['middleware' => ['jwtAuth']], function () {
    Route::group(['prefix' => '/profile', 'namespace' => 'Profile'], function () {
        Route::get('/', 'UsersController@showProfile');
        Route::put('/', 'UsersController@updateProfile');
        Route::post('/', 'UsersController@createProfile');
    });
});


Route::group(['prefix' => '/payment', 'namespace' => 'Payment'], function () {
    Route::get('/index', 'PaymentController@index')->middleware(['jwtAuth']);
    Route::get('/new', 'PaymentController@new')->middleware(['jwtAuth']);
    Route::get('/verify/{payment}', 'PaymentController@verify')->middleware(['jwtAuth'])->name('payment.verify');
});
