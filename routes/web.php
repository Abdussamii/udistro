<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

Route::get('/', function () {
    return view('welcome');
});

// Administrator openly access routes
Route::group(['prefix' => 'administrator'], function() {
	
	// Admin index page
	Route::get('/', 'AdminController@index');

	// Admin login function
	Route::post('/login', 'AdminController@login');

});

// Administrator protected routes
Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
	
	// Admin dashboard
	Route::get('/dashboard', 'AdminController@dashboard');

	// To return the navigation category view
	Route::get('/navigationcategory', 'AdminController@navigationCategory');

	// To save the navigation category
	Route::post('/savenavigationcategory', 'AdminController@saveNavigationCategory');

	// To show the navigation category list in datatable
	Route::get('/fetchnavigationcategories', 'AdminController@fetchNavigationCategories');

	// To get the details for the selected navigation category
	Route::get('/getnavigationcategorydetails', 'AdminController@getNavigationCategoryDetails');

	// To return the navigation view
	Route::get('/navigation', 'AdminController@navigation');

	// To save the navigation details
	Route::post('/savenavigation', 'AdminController@saveNavigation');

	// To show the navigation list in datatable
	Route::get('/fetchnavigation', 'AdminController@fetchNavigation');

	// To get the details for the selected navigation
	Route::get('/getnavigationdetails', 'AdminController@getNavigationDetails');

	// To update the navigation details
	Route::post('/updatenavigation', 'AdminController@updateNavigation');

	// To return the page details
	Route::get('/pages', 'AdminController@pages');

	// To save the page content
	Route::post('/savepage', 'AdminController@savePage');

	// To show the page list in datatable
	Route::get('/fetchpages', 'AdminController@fetchPages');

	// To get the details for the selected page
	Route::get('/getpagedetails', 'AdminController@getPageDetails');

	// To return the provinces page
	Route::get('/provinces', 'AdminController@provinces');

	// To save the province details
	Route::post('/saveprovince', 'AdminController@saveProvince');

	// To show the province list in datatable
	Route::get('/fetchprovinces', 'AdminController@fetchProvinces');

	// To get the details for the selected province
	Route::get('/getprovincedetails', 'AdminController@getProvinceDetails');

	// To return the utility service categories page
	Route::get('/utilityservicecategories', 'AdminController@utilityServiceCategories');

	// To save the utility service categories details
	Route::post('/saveutilityservicecategory', 'AdminController@saveUtilityServiceCategory');

	// To show the utility service categories list in datatable
	Route::get('/fetchutilityservicecategories', 'AdminController@fetchUtilityServiceCategories');

	// To get the details for the selected utility service category
	Route::get('/getutilityservicecategorydetails', 'AdminController@getUtilityServiceCategoryDetails');

});

// Logout
Route::get('/logout', 'HomeController@logout');