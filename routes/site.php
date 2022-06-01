<?php
// menu section
Route::get('/', 'HomeController@index')->name('index');
Route::get('about-us', 'HomeController@getAboutUs')->name('about-us');
Route::get('faq', 'HomeController@getFaq')->name('faq');
Route::get('terms', 'HomeController@getTerms')->name('terms');
Route::get('contact-us', 'SupportController@getContactUs')->name('contact-us');
Route::post('contact-us', 'SupportController@addSupportMessage')->name('contact-us');

// search section
Route::get('/csearch/{model_type}/{string}', 'AjaxSearchController@csearch')->name('ajax_csearch'); // do top menu ads and left side blog search

// blog(news) section
Route::get('news', 'BlogController@index')->name('blog.index');
Route::get('news/{blog}/{title}', 'BlogController@show')->name('blog.show');
Route::get('news-category/{blogCategory}/{title}', 'BlogController@getByCategory')->name('blog.category-blog');

// ads section
Route::get('ads-grid', 'AdsController@showGridIndex')->name('ads.grid-index');
Route::get('ads-all/{id}/{model_type}/{title}', 'AdsController@getAdsIndexAll')->name('ads.all-index'); // show cities and categories ads
Route::get('ads/{id}/{title}', 'AdsController@show')->name('ads.show');
Route::post('search-ads', 'AdsController@doSearch')->name('search-ads'); // search in index page for ads by filter
Route::get('ads-city', 'AdsController@getAdsCityIndex')->name('ads.city');
Route::get('ads-category', 'AdsController@getAdsCategoryIndex')->name('ads.category');

// add comment and report section
Route::post('add-comment/{type}/{id}', 'CommentController@store')->name('comment.store')->where(['id' => '[0-9]+', 'type' => '[a-z]+']);
Route::post('add-view/{type}/{id}', 'ViewableController@store')->name('viewable.store')->where(['id' => '[0-9]+', 'type' => '[a-z]+']);
Route::post('add-report/{ads}', 'AdsController@addReport')->name('report.store')->where(['id' => '[0-9]+', 'type' => '[a-z]+']);
Route::post('add-score/{ads}', 'AdsController@addScore')->name('score.store')->where(['id' => '[0-9]+', 'type' => '[a-z]+']);
Route::post('add-bookmark/{ads}', 'AdsController@addBookmark')->name('bookmark.store')->where(['id' => '[0-9]+', 'type' => '[a-z]+']);

Route::middleware(['siteGuest'])->group(function(){
	Route::get('/login', 'Auth\AuthController@showLoginPage')->name('login');
	Route::post('/login', 'Auth\AuthController@sendOtp');
	Route::get('/login-code/{mobile}', 'Auth\AuthController@showOtpPage')->name('getLoginCode');
	Route::post('/login-code/{mobile}', 'Auth\AuthController@doLogin')->name('postLoginCode');
});

Route::get('user-profile/{user}/{name}', 'UserController@profile')->name('user.profile');

Route::middleware(['siteAuth'])->group(function(){
	Route::get('/logout', 'Auth\AuthController@doLogout')->name('logout');

	Route::get('dashboard', 'UserController@dashboard')->name('user.dashboard');
	Route::put('dashboard/{user}', 'UserController@updateUserProfile')->name('user.update');

	Route::get('ads-create', 'AdsController@getCategory')->name('ads.create');
	Route::post('ads-create-category', 'AdsController@postCategory')->name('ads.postCategory');
	Route::get('ads-new/{adsCategory}', 'AdsController@create')->name('ads.new');
	Route::post('ads-store/{adsCategory}', 'AdsController@store')->name('ads.store');;

	Route::get('attributes/{adsCategory}', 'AdsController@getAttributesByCategory')->name('attrubute.getByCategory');

	Route::get('ads/{ads}/edit', 'AdsController@edit')->name('ads.edit');
	Route::post('ads/{ads}/update', 'AdsController@update')->name('ads.update');

	Route::get('پرداخت', 'AdsController@checkout')->name('ads.checkout');
});
