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
    // return view('welcome');
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

	// To return the utility service types page
	Route::get('/utilityservicetypes', 'AdminController@utilityServiceTypes');

	// To save the utility service types
	Route::post('/saveutilityservicetype', 'AdminController@saveUtilityServiceType');

	// To show the utility service type list in datatable
	Route::get('/fetchutilityservicetypes', 'AdminController@fetchUtilityServiceTypes');

	// To get the details for the selected utility service type
	Route::get('/getutilityservicetypedetails', 'AdminController@getUtilityServiceTypeDetails');

	// To return the utility service page
	Route::get('/utilityserviceproviders', 'AdminController@utilityServiceProviders');

	// To get the service type on the basis of selected service category
	Route::get('/getcategoryservicetypes', 'AdminController@getCategoryServiceTypes');

	// To get the cities on the basis of selected province
	Route::get('/getprovincecities', 'AdminController@getProvinceCities');

	// To save the utility service provider details
	Route::post('/saveserviceprovider', 'AdminController@saveServiceProvider');

	// To show the utility service providers list in datatable
	Route::get('/fetchserviceproviders', 'AdminController@fetchServiceProviders');

	// To get the details of the selected service provider
	Route::get('/getserviceproviderdetails', 'AdminController@getServiceProviderDetails');

	// To return the payment plans view
	Route::get('/paymentplans', 'AdminController@paymentPlans');

	// To save the payment plan details
	Route::post('/savepaymentplan', 'AdminController@savePaymentPlan');

	// To show the payment plans list in datatable
	Route::get('/fetchpaymentplans', 'AdminController@fetchPaymentPlans');

	// To get the details of the selected payment plan
	Route::get('/getpaymentplandetails', 'AdminController@getPaymentPlanDetails');

	// To return the cities listing view
	Route::get('/cities', 'AdminController@cities');

	// To save the city details
	Route::post('/savecity', 'AdminController@saveCity');

	// To show the cities list in datatable
	Route::get('/fetchcities', 'AdminController@fetchCities');

	// To get the details of the selected city
	Route::get('/getcitydetails', 'AdminController@getCityDetails');


	/* ---------- Company related functionality ---------- */

	// To return the company categories view
	Route::get('/companycategories', 'CompanyController@companyCategories');

	// To save the company category details
	Route::post('/savecompanycategory', 'CompanyController@saveCompanyCategory');

	// To show the company categories list in datatable
	Route::get('/fetchcompanycategories', 'CompanyController@fetchCompanyCategories');

	// To get the details of the selected company category
	Route::get('/getcompanycategorydetails', 'CompanyController@getCompanyCategoryDetails');

	// To return the company listing view
	Route::get('/companies', 'CompanyController@companies');

	// To save the company details
	Route::post('/savecompanydetails', 'CompanyController@saveCompanyDetails');

	// To fetch the companies list and show in datatable
	Route::get('/fetchcompanies', 'CompanyController@fetchCompanies');

	// To get the details of the selected company
	Route::get('/getcompanydetails', 'CompanyController@getCompanyDetails');

	// To update the company details
	Route::post('/updatecompanydetails', 'CompanyController@updateCompanyDetails');

	// To return the company agent view
	Route::get('/agents', 'CompanyController@agents');

	// To save the agent details
	Route::post('/saveagent', 'CompanyController@saveAgent');

	// To fetch the agent list and show in datatable
	Route::get('/fetchagents', 'CompanyController@fetchAgents');

	// To get the agent details
	Route::get('/getagentdetails', 'CompanyController@getAgentDetails');

	// To update the agent details
	Route::post('/updateagent', 'CompanyController@updateAgent');

	/* ---------- Company related functionality ---------- */

});

/* ---------- Agent related functionality ---------- */

// Agent openly access routes
Route::group(['prefix' => 'agent'], function() {
	
	// Agent login page
	Route::get('/', 'AgentController@index');

	// Function to check user credentials
	Route::post('/login', 'AgentController@login');

});

// Agent protected routes
Route::group(['prefix' => 'agent', 'middleware' => 'auth'], function() {

	// Agent dashboard
	Route::get('/dashboard', 'AgentController@dashboard');

	// To show agent clients listing page
	Route::get('/clients', 'AgentController@clients');

	// To save the client details
	Route::post('/saveclient', 'AgentController@saveClient');

	// To fetch the clients list and show in datatable
	Route::get('/fetchclients', 'AgentController@fetchClients');

	// To get the details of the selected client
	Route::get('/getclientdetails', 'AgentController@getClientDetails');

	// To show agent profile page
	Route::get('/profile', 'AgentController@profile');

	// To save the profile details details
	Route::post('/saveprofiledetails', 'AgentController@saveProfileDetails');

});

/* ---------- Agent related functionality ---------- */


/* ---------- Movers related functionality ---------- */

// Agent openly access routes
Route::group(['prefix' => 'movers'], function() {
	
	// Agent login page
	Route::get('/', 'MoversController@index');
	
});

/* ---------- Movers related functionality ---------- */

// Logout
Route::get('/logout', 'HomeController@logout');