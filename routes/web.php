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

// Route::get('/', 'MoversController@index');

////////// Home Pages Routes //////////

// uDistro home
Route::get('/', function () {
    return view('landing_page1');
});

// uDistro agent home
Route::get('/agent/home', function () {
    return view('landing_page2');
});

// uDistro business home
Route::get('/company/home', function () {
    return view('landing_page3');
});

// uDistro get invitation route
Route::get('/getinvitation', 'HomeController@getInvitation');

// Save the invitation details
Route::post('/saveinvitationdetails', 'HomeController@saveInvitationDetails');

////////// Home Pages Routes //////////

// To test email template view
Route::get('/email', 'EmailController@renderEmailTemplate');

// Administrator openly access routes
Route::group(['prefix' => 'administrator'], function() {
	
	// Admin index page
	Route::get('/', 'AdminController@index');

	// Admin login function
	Route::post('/login', 'AdminController@login');

	// Forgot Password function
	Route::get('/forgotpassword', 'AdminController@getForgotPassword');

	Route::post('/forgotpassword', 'AdminController@forgotPassword');

});

// Administrator protected routes
Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {

	// Logout
	Route::get('/logout', 'HomeController@logout');
	
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

	// To return the moving Category page
	Route::get('/movingcategory', 'AdminController@movingCategory');

	// To save the moving Category details
	Route::post('/savemovingcategory', 'AdminController@saveMovingCategory');

	// To show the moving Category list in datatable
	Route::get('/fetchmovingcategory', 'AdminController@fetchMovingCategory');

	// To get the details for the selected moving Category
	Route::get('/getmovingcategory', 'AdminController@getMovingCategory');

	// To return the moving Category details page
	Route::get('/movingitemdetails', 'AdminController@movingItemDetails');

	// To save the moving Category details
	Route::post('/savemovingitemdetails', 'AdminController@saveMovingItemDetails');

	// To show the moving Category details list in datatable
	Route::get('/fetchmovingitemdetails', 'AdminController@fetchMovingItemDetails');

	// To get the details for the selected moving Category details
	Route::get('/getmovingitemdetails', 'AdminController@getMovingItemDetails');

	// To return the activity feedback page
	Route::get('/activityfeedback', 'AdminController@activityFeedback');

	// To show the activity list in datatable
	Route::get('/fetchactivityfeedback', 'AdminController@fetchActivityFeedback');

	// To return the activity page
	Route::get('/activity', 'AdminController@activity');

	// To save the activity details
	Route::post('/saveactivity', 'AdminController@saveActivity');

	// To show the activity list in datatable
	Route::get('/fetchactivity', 'AdminController@fetchActivity');

	// To get the details for the selected activity
	Route::get('/getactivitydetails', 'AdminController@getActivityDetails');

	// To return the industry page
	Route::get('/industrytype', 'AdminController@industryType');

	// To save the industry details
	Route::post('/saveindustrytype', 'AdminController@saveIndustryType');

	// To show the industry list in datatable
	Route::get('/fetchindustrytype', 'AdminController@fetchIndustryType');

	// To get the details for the selected industry
	Route::get('/getindustrytypedetails', 'AdminController@getIndustryTypeDetails');

	// To return the services page
	Route::get('/services', 'AdminController@services');

	// To save the services details
	Route::post('/saveservices', 'AdminController@saveServices');

	// To show the services list in datatable
	Route::get('/fetchservices', 'AdminController@fetchServices');

	// To get the details for the selected services
	Route::get('/getservicesdetails', 'AdminController@getServicesDetails');

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

	// To return email template listing view
	Route::get('/emailtemplates', 'AdminController@emailTemplates');

	// To save the email template details
	Route::post('/saveemailtemplate', 'AdminController@saveEmailTemplate');

	// To show the email template list in datatable
	Route::get('/fetchemailtemplates', 'AdminController@fetchEmailTemplates');

	// To get the details of selected email template
	Route::get('/getemailtemplatedetails', 'AdminController@getEmailTemplateDetails');


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

	// To update company image
	Route::post('/updatecompanyimage', 'CompanyController@updateCompanyImage');

	/* ---------- Company related functionality ---------- */

	// To return the address page
	Route::get('/address', 'AdminController@address');

	// To save the address details
	Route::post('/saveaddress', 'AdminController@saveAddress');

	// To show the address list in datatable
	Route::get('/fetchaddress', 'AdminController@fetchAddress');

	// To get the details for the selected address
	Route::get('/getaddressdetails', 'AdminController@getAddressDetails');

	// Change Password
	Route::get('/changepassword', 'AdminController@getchangepassword');

	// To update Password
	Route::post('/changepassword', 'AdminController@changePassword');

});

/* ---------- Agent related functionality ---------- */

// Agent openly access routes
Route::group(['prefix' => 'agent'], function() {
	
	// Agent login page
	Route::get('/', 'AgentController@index');

	// Function to check user credentials
	Route::post('/login', 'AgentController@login');

	// Forgot Password function
	Route::get('/forgotpassword', 'AgentController@getForgotPassword');

	Route::post('/forgotpassword', 'AgentController@forgotPassword');


});

// Agent protected routes
Route::group(['prefix' => 'agent', 'middleware' => 'auth'], function() {

	// Agent dashboard
	Route::get('/dashboard', 'AgentController@dashboard');

	// To show agent clients listing page
	Route::get('/clients', 'AgentController@clients');

	// To show agent invite listing page
	Route::get('/invites', 'AgentController@invites');

	// To save the client details
	Route::post('/saveclient', 'AgentController@saveClient');

	// To fetch the clients list and show in datatable
	Route::get('/fetchclients', 'AgentController@fetchClients');

	// To fetch the clients invites and show in datatable
	Route::get('/fetchinvites', 'AgentController@fetchInvites');

	// To get the details of the selected client
	Route::get('/getclientdetails', 'AgentController@getClientDetails');

	// To get the details of the selected invite
	Route::get('/getinvitedetails', 'AgentController@getInviteDetails');

	// To show agent profile page
	Route::get('/profile', 'AgentController@profile');

	// To save the agent profile details
	Route::post('/saveprofiledetails', 'AgentController@saveProfileDetails');

	// To save the agent contact details
	Route::post('/savecontactdetails', 'AgentController@saveContactDetails');

	// To save the agent address details
	Route::post('/saveaddressdetails', 'AgentController@saveAddressDetails');

	// To save the agent social details
	Route::post('/savesocialdetails', 'AgentController@saveSocialDetails');

	// To save the agent company details
	Route::post('/savecompanydetails', 'AgentController@saveCompanyDetails');

	// To update the agent message
	Route::post('/updatemessage', 'AgentController@updateMssage');

	// To fetch the client details as well as its associated message and template details to show in popup
	Route::get('/createinvitation', 'AgentController@createInvitation');

	// To get the email template content
	Route::get('/getemailtemplatecontent', 'AgentController@getEmailTemplateContent');

	// To update agent email template
	Route::post('/updateemailtemplate', 'AgentController@updateEmailTemplate');

	// To update agent image
	Route::post('/updateagentimage', 'AgentController@updateAgentImage');

	// To save the agent invitation details
	Route::post('/saveinvitationdetails', 'AgentController@saveInvitationDetails');

	// To return email template listing view
	Route::get('/emailtemplates', 'AgentController@emailTemplates');

	// To save the email template details
	Route::post('/saveemailtemplate', 'AgentController@saveEmailTemplate');

	// To show the email template list in datatable
	Route::get('/fetchemailtemplates', 'AgentController@fetchEmailTemplates');

	// To get the details of selected email template
	Route::get('/getemailtemplatedetails', 'AgentController@getEmailTemplateDetails');

	// Change Password
	Route::get('/changepassword', 'AgentController@getchangepassword');

	// To update Password
	Route::post('/changepassword', 'AgentController@changePassword');

	// To email preview
	Route::post('/emailpreview', 'AgentController@emailPreview');

});

/* ---------- Agent related functionality ---------- */


/* ---------- Movers related functionality ---------- */

// Movers openly access routes
Route::group(['prefix' => 'movers'], function() {
	
	// Movers home page
	Route::get('/', 'MoversController@index');

	// To check whether the user is authorized or not
	Route::get('/authenticate', 'MoversController@myMove');

	// Movers my move page
	Route::get('/mymove', 'MoversController@myMove');

	// To update the completed activity status
	Route::post('/updateactivitystatus', 'MoversController@updateActivityStatus');

	// To save the agent feedback given by the client
	Route::post('/updateagentfeedback', 'MoversController@updateAgentFeedback');

	// To update the helpful click response
	Route::post('/updatehelpfulcount', 'MoversController@updateHelpfulCount');

	// To update the user feedback on individual activity
	Route::post('/updateactivityfeedback', 'MoversController@updateActivityFeedback');

	// To save the user's moving query detail
	Route::post('/saveusermovingquery', 'MoversController@saveUserMovingQuery');

	// To get the list of companies satisfying all the criteria to get the mover's quotations
	Route::get('/quotation', 'MoversController@getFilteredMoverCompaniesList');

	// To save the user's tech concierge query detail
	Route::post('/savetechconciergequery', 'MoversController@saveTechConciergeQuery');
	
});

/* ---------- Movers related functionality ---------- */

// Company openly access routes
Route::group(['prefix' => 'company'], function() {

	// Company login page
	Route::get('/', 'CompanyController@index');
	
	// Company registration page home page
	Route::get('/registration', 'CompanyController@register');

	// Function to check company credentials
	Route::post('/login', 'CompanyController@login');

	// To register a new company
	Route::post('/registercompany', 'CompanyController@registerCompany');

	// To return the payment plan page
	Route::get('/paymentplan', 'CompanyController@paymentplan');

	// To update the company payment plan
	Route::post('/updatecompanypaymentplan', 'CompanyController@updateCompanyPaymentPlan');

	// Forgot Password function
	Route::get('/forgotpassword', 'CompanyController@getForgotPassword');
	
	Route::post('/forgotpassword', 'CompanyController@forgotPassword');
	
});

Route::group(['prefix' => 'company', 'middleware' => 'auth'], function() {

	// Company dashboard
	Route::get('/dashboard', 'CompanyController@dashboard');

	// Company profile
	Route::get('/profile', 'CompanyController@profile');

	// To update company details
	Route::post('/updatecompanybasicdetails', 'CompanyController@updateCompanyBasicDetails');

	// To update company address details
	Route::post('/updatecompanyaddressdetails', 'CompanyController@updateCompanyAddressDetails');

	// To update company social details
	Route::post('/updatecompanysocialdetails', 'CompanyController@updateCompanySocialDetails');

	// To fetch the services as per the selected category
	Route::get('/getcompanycategoryservices', 'CompanyController@getCompanyCategoryServices');

	// To update company additional details
	Route::post('/updatecompanyadditionaldetails', 'CompanyController@updateCompanyAdditionalDetails');

	// To update company image
	Route::post('/updatecompanyimage', 'CompanyController@updateCompanyImage');

	// Change Password
	Route::get('/changepassword', 'CompanyController@getchangepassword');

	// To update Password
	Route::post('/changepassword', 'CompanyController@changePassword');
	
});


// Logout
Route::get('/logout', 'HomeController@logout');

// To fetch the images from storage and return it
Route::get('/images/{entity}/{filename}', function ($entity, $filename)
{
    $path = storage_path() . '/uploads/' . $entity . '/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});