<?php
Route::middleware(['adminGuest'])->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/', 'Auth\LoginController@index')->name('index');
});

Route::middleware(['adminAuth'])->group(function () {
    $actions = ['active', 'trash', 'delete', 'publish'];
    foreach ($actions as $action) {
        Route::get("/$action/{model_type}/{id}", "AjaxTableOptionsController@$action");
    }

    Route::get('dashboard', 'Auth\LoginController@dashboard')->name('dashboard');


    Route::post('upload-image', 'ImageUploaderController@upload_image')->name('upload_image');
    Route::post('upload-video', 'ImageUploaderController@upload_video')->name('upload_video');


    Route::middleware(['hasPermission:product.*'])->group(function () {
        Route::get('product/publish/{product}', 'ProductController@publish')->name('product.publish');
        Route::get('product/unpublish/{product}', 'ProductController@unPublish')->name('product.unpublish');
        Route::get('product/delete/{product}', 'ProductController@doDelete')->name('product.delete');
        Route::resource('product', 'ProductController', ['except' => ['destroy']]);
    });

    Route::middleware(['hasPermission:product.*'])->group(function () {
        Route::get('order/delete/{order}', 'OrderController@doDelete')->name('order.delete');
        Route::get('order/user/{user}', 'OrderController@userOrders')->name('order.user');
        Route::resource('order', 'OrderController', ['except' => ['destroy']]);
    });


    Route::middleware(['hasPermission:category.*'])->group(function () {
        Route::get('product-category/delete/{category}', 'ProductCategoryController@doDelete')->name('product-category.delete');
        Route::resource('product-category', 'ProductCategoryController', ['except' => ['destroy']]);
    });


    Route::middleware(['hasPermission:payment.*'])->group(function () {
        Route::get('payment/delete/{id}', 'PaymentController@doDelete')->name('payment.delete');
        Route::resource('payment', 'PaymentController', ['except' => ['destroy']]);
    });

    Route::middleware(['hasPermission:role.*'])->group(function () {
        Route::get('role/delete/{role}', 'RoleController@doDelete')->name('role.delete');
        Route::resource('role', 'RoleController', ['except' => ['destroy']]);
    });

    Route::get('/profile/{id}', 'UsersController@showProfile')->name('profile');
    Route::middleware(['hasPermission:user.*'])->group(function () {
        Route::get('/user-all/{role?}', 'UsersController@getAllUsers')->name('user.all');
        Route::get('/user/delete/{user}', 'UsersController@doDelete')->name('user.delete');
        Route::resource('/user', 'UsersController', ['except' => ['index', 'delete']]);
    });

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/logout-url', function () {
        return redirect('https://qiqooapp.com');
    })->name('logoutUrl');
});
