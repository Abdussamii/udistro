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

/*
	1 Page:
	uDistro For People Who Moving (I am moving)

	2 Page:
	uDistro For Realtors and Property Managers (I help others move)

	3 Page:
	uDistro For local business (I am business)
*/

// To test laratrust permission module
// Route::get('/laratrust', 'ACLController@checkRolePermission');

Route::get('/clearcache', function () {
    shell_exec('php artisan config:cache');
});

// uDistro home
Route::get('/', function () {
    return view('landingPage1');
});

// uDistro agent home
Route::get('/agent/home', function () {
    return view('landingPage2');
});

// uDistro business home
Route::get('/company/home', function () {
    return view('landingPage3');
});

// un authorize access view
Route::get('/unauthorize', function () {
    return view('unauthorize');
});

// uDistro get invitation route
Route::get('/getinvitation', 'HomeController@getInvitation');

// Save the invitation details
Route::post('/saveinvitationdetails', 'HomeController@saveInvitationDetails');

// About us page
Route::get('/aboutus', function () {
    return view('aboutUs');
});

// About us page
Route::get('/events', function () {
    return view('events');
});

// FAQ's
Route::get('/faqs', function () {
    return view('faqs');
});

// Customers
Route::get('/customers', function () {
    return view('customers');
});

Route::get('/freetrial', 'CompanyController@register');

// Help center
Route::get('/helpcenter', function () {
    return view('helpCenter');
});

// Comingsoon
Route::get('/comingsoon', function () {
    return view('comingsoon');
});

// login
Route::get('/login', function () {
    return view('login');
});

// Our team
Route::get('/ourteam', function () {
    return view('ourTeam');
});

// To show the rating form
Route::get('/rating/{companyId?}/{moverId?}/{responseId?}/{transactionId?}', 'CompanyController@rating');

// To save rating
Route::post('/saverating', 'CompanyController@saveRating');

////////// Home Pages Routes //////////

// To test email template view
// Route::get('/email', 'EmailController@renderEmailTemplate');

// Forgot password view (for all types of users)
Route::get('/forgotpassword', 'HomeController@forgotPassword');

// Forgot password check the email and send the password reset link
Route::post('/forgotpasswordemail', 'HomeController@forgotPasswordEmail');

// Reset password view
Route::get('/resetpassword/{token}', 'HomeController@resetPassword');

// Update password
Route::post('/updatepassword', 'HomeController@updatePassword');

// To send the agent email
Route::post('/email', 'EmailController@sendEmail');

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

	// To return the generate invoice page
	Route::get('/generateinvoice', 'AdminController@generateInvoice');

	// To convert html to dompdf
	Route::get('htmltopdfview', array('as'=>'htmltopdfview','uses'=>'AdminController@htmltopdfview'));
	
	/* Newly added route start here */
	
	// To return role listing view
	Route::get('/roles', 'AdminController@roles');
	
	// To save new role
	Route::post('/saverole', 'AdminController@saveRole');

	// To show the role list in datatable
	Route::get('/fetchroles', 'AdminController@fetchRoles');

	// To get the details of selected role
	Route::get('/getselectedrole', 'AdminController@getSelectedRole');
	
	// To return permission listing view
	Route::get('/permissions', 'AdminController@permissions');

	// To save new permission
	Route::post('/savepermission', 'AdminController@savePermission');

	// To show the permission list in datatable
	Route::get('/fetchpermissions', 'AdminController@fetchPermissions');

	// To get the details of selected permission
	Route::get('/getselectedpermission', 'AdminController@getSelectedPermission');
	
	// To detach permission from role
	Route::get('/detachrolepermission', 'AdminController@detachRolePermission');

	// To return rolespermissions listing view
	Route::get('/rolespermissions', 'AdminController@rolesPermissions');

	// To save new rolepermission
	Route::post('/saverolepermission', 'AdminController@saveRolePermission');

	// To show the rolespermissions list in datatable
	Route::get('/fetchrolespermissions', 'AdminController@fetchRolesPermissions');

	
	// To detach role from user
	Route::get('/detachroleuser', 'AdminController@detachRoleUser');

	// To return rolesusers listing view
	Route::get('/rolesusers', 'AdminController@rolesUsers');

	// To save new roleuser
	Route::post('/saveroleuser', 'AdminController@saveRoleUser');

	// To show the rolesusers list in datatable
	Route::get('/fetchrolesusers', 'AdminController@fetchRolesUsers');
	
	
	// To detach permission from user
	Route::get('/detachpermissionuser', 'AdminController@detachPermissionUser');

	// To return permissionsusers listing view
	Route::get('/permissionsusers', 'AdminController@permissionsUsers');

	// To save new permissionuser
	Route::post('/savepermissionuser', 'AdminController@savePermissionUser');

	// To show the permissionsusers list in datatable
	Route::get('/fetchpermissionsusers', 'AdminController@fetchPermissionsUsers');

	// To show the job payment details
	Route::get('/jobpayments', 'AdminController@jobpayments');

	// To fetch the job payment details
	Route::get('/fetchjobpayments', 'AdminController@fetchJobPayments');

	/* -----------------  Newly added route end here ------------------*/
	
	
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

	// To save the company representative details
	Route::post('/savecompanyrepresentative', 'CompanyController@saveCompanyRepresentative');

	// To get the company representative details
	Route::get('/getcompanyrepresentativedetails', 'CompanyController@getCompanyRepresentativeDetails');

	// To update the company representative details
	Route::post('/updatecompanyrepresentative', 'CompanyController@updateCompanyRepresentative');

	// To update company image
	Route::post('/updatecompanyimage', 'CompanyController@updateCompanyImage');

	// To show response time listing page
	Route::get('/responsetime', 'AdminController@responsetime');

	// To save response time
	Route::post('/saveresponsetime', 'AdminController@saveResponseTime');

	// To get the response time slot listing
	Route::get('/fetchresponsetimeslots', 'AdminController@fetchResponseTimeSlots');

	// To get response time slot details
	Route::get('/getresponsetimeslotdetails', 'AdminController@getResponseTimeSlotDetails');

	// To return the company representative view
	Route::get('/companyrepresentatives', 'CompanyController@companyRepresentatives');

	// To fetch the company representative list and show in datatable
	Route::get('/fetchcompanyrepresentatives', 'CompanyController@fetchCompanyRepresentatives');

	/* ---------- Company related functionality ---------- */

	// To return the provincial agency details page
	Route::get('/provincialagencies', 'AdminController@provincialAgencies');

	// To save the provincial agency details
	Route::post('/saveprovincialagency', 'AdminController@saveProvincialAgency');

	// To show the provincial agency list in datatable
	Route::get('/fetchprovincialagencies', 'AdminController@fetchProvincialAgencies');

	// To get the details for the selected provincial agency
	Route::get('/getprovincialagencydetails', 'AdminController@getProvincialAgencyDetails');

	// Change Password
	Route::get('/changepassword', 'AdminController@getchangepassword');

	// To update Password
	Route::post('/changepassword', 'AdminController@changePassword');

	// To upload the file and send the email with attachement
	Route::post('/sendagentemailnotification', 'EmailController@sendAgentEmailNotification');

	// To update the payment status
	Route::post('/releasepayment', 'AdminController@releasepayment');

});

/* ---------- Agent related functionality ---------- */

// Agent openly access routes
Route::group(['prefix' => 'agent'], function() {
	
	// Agent login page
	Route::get('/', 'AgentController@index');

	// Function to check user credentials
	Route::post('/login', 'AgentController@login');

	Route::get('/logout', 'HomeController@logout');

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

	// To fetch the invited clients list and show in datatable
	Route::get('/fetchinvitedclients', 'AgentController@fetchInvitedClients');

	// To fetch the clients invites and show in datatable
	Route::get('/fetchinvites', 'AgentController@fetchInvites');

	// To resend invitation email
	Route::post('/resendemail', 'AgentController@resendEmail');

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

	// To update agent company image
	Route::post('/updateagentcompanyimage', 'AgentController@updateAgentCompanyImage');

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

	// To check email preview
	Route::post('/emailpreview', 'AgentController@emailPreview');

	// To uplaod the email template image
	Route::post('/uploademailimage', 'AgentController@uploadEmailImage');

	// To return agent review board page
	Route::get('/reviews', 'AgentController@reviews');

	// To fetch reviews and show in datatable
	Route::get('/fetchreviews', 'AgentController@fetchReviews');

	// To return payment view
	Route::get('/paymentplan', 'AgentController@paymentplan');
	
	/* -----------Newly added route for agent partner start here------------------*/
	
	// To save the partner details
	Route::post('/savepartnerdetails', 'AgentController@savePartnerDetails');
	
	// To get the details of the selected partner
	Route::get('/getpartnerdetails', 'AgentController@getPartnerDetails');
	
	// To fetch the partners and show in datatable
	Route::get('/fetchpartners', 'AgentController@fetchPartners');
	
	// To show partner listing page
	Route::get('/partners', 'AgentController@partners');

	// To get the payment plan details for paypal payment
	Route::get('/getplandetails', 'AgentController@getPlanDetails');
		
	/* -----------Newly added route for agent partner end here------------------*/


});

/* ---------- Agent related functionality ---------- */


/* ---------- Movers related functionality ---------- */

// Movers openly access routes
Route::group(['prefix' => 'movers'], function() {
	
	// Movers home page
	Route::get('/', 'MoversController@index');

	// To check whether the user is authorized or not
	Route::get('/authenticate', 'MoversController@authenticate');

	// Movers my move page
	Route::get('/mymove', 'MoversController@myMove');

	// Check the user authentication
	Route::post('/checkuserauthentication', 'MoversController@checkUserAuthentication');

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

	// To save the user's cable & internet query detail
	Route::post('/savecableinternetquery', 'MoversController@saveCableInternetQuery');

	// To save the user's home cleaning query detail
	Route::post('/savehomecleaningquery', 'MoversController@saveHomeCleaningQuery');

	// To get the list of quotation response
	Route::get('/quotationresponse', 'MoversController@quotationResponse');

	// To get the list of datatable quotation response
	Route::get('/getquotationresponse', 'MoversController@getQuotationResponse');

	// To get the details for the selected Home Service Request
	Route::get('/gethomeservicerequest', 'MoversController@getHomeServiceRequest');

	// To get the details for the selected Cable Service Request
	Route::get('/getcableservicerequest', 'MoversController@getCableServiceRequest');

	// To get the details for the selected Tech Concierge Request
	Route::get('/gettechconciergerequest', 'MoversController@getTechConciergeRequest');

	// To get the details for the selected Moving Companies Request
	Route::get('/getmovingcompaniesrequest', 'MoversController@getMovingCompaniesRequest');

	// To get the quotation response details
	Route::get('/getquotationresponsedetails', 'MoversController@getQuotationResponseDetails');

	// To save the share announcement email and message
	Route::post('/saveannouncementemail', 'MoversController@saveAnnouncementEmail');

	// To fetch the utility services for the selected company
	Route::get('/getcompanyservices', 'MoversController@getCompanyServices');

	// To save the completed utility
	Route::post('/updateutilityservicelog', 'MoversController@updateUtilityServiceLog');
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

	Route::get('/logout', 'HomeController@logout');

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

	// To get the details for the selected Home Service Request
	Route::get('/gethomeservicerequest', 'CompanyController@getHomeServiceRequest');

	// To get the details for the selected Cable Service Request
	Route::get('/getcableservicerequest', 'CompanyController@getCableServiceRequest');

	// To get the details for the selected Tech Concierge Request
	Route::get('/gettechconciergerequest', 'CompanyController@getTechConciergeRequest');

	// To get the details for the selected Moving Companies Request
	Route::get('/getmovingcompaniesrequest', 'CompanyController@getMovingCompaniesRequest');

	// To return the Quotation Request page
	Route::get('/quotationrequest', 'CompanyController@QuotationRequest');

	// To save the Quotation Request
	Route::post('/savequotationrequest', 'CompanyController@saveQuotationRequest');

	// To show the Quotation Request list in datatable
	Route::get('/fetchquotationrequest', 'CompanyController@fetchQuotationRequest');

	// To get the details for the selected Quotation Request
	Route::get('/getquotationrequest', 'CompanyController@getQuotationRequest');

	// To update the home cleaning request quotation price related data
	Route::post('/updatehomecleaningservicerequest', 'CompanyController@updateHomeCleaningServiceRequest');

	// To update the moving request quotation price related data
	Route::post('/updatemovingservicerequest', 'CompanyController@updateMovingServiceRequest');

	// To update the tech concierge quotation price related data
	Route::post('/updatetechconciergeservicerequest', 'CompanyController@updateTechConciergeServiceRequest');

	// To update the cable internet quotation price related data
	Route::post('/updatecableinternetservicerequest', 'CompanyController@updateCableInternetServiceRequest');

	// To get the pst, gst, hst, service charge values
	Route::get('/fetchprovincetaxes', 'CompanyController@fetchProvinceTaxes');

	// To show the review page
	Route::get('/review', 'CompanyController@review');

	// To fetch the reviews and show in datatable
	Route::get('/fetchreviews', 'CompanyController@fetchReviews');

	// To show the assigned jobs to the company
	Route::get('/jobs', 'CompanyController@jobs');

	// To fetch the job listing
	Route::get('/fetchjobs', 'CompanyController@fetchJobs');

	// Company request to release money
	Route::post('/requestmoney', 'CompanyController@requestMoney');

});

// Paypal payment related routes
Route::group(['prefix' => 'paypal'], function() {

	// Payment is successfully done
	Route::get('/success', 'PaymentController@success');

	// Payment is cancelled
	Route::get('/cancel', 'PaymentController@cancel');

	// To check the paypal payment status by using IPN
	Route::post('/paymentstatus', 'PaymentController@paymentStatus');

});

// CRON URL's
Route::group(['prefix' => 'scheduler'], function() {

	// To send invitation email
	Route::get('/sendinvitationemail', 'SchedulerController@sendInvitationEmail');

	// To send the mover emails
	Route::get('/sendcompanyquotationresponseemail', 'SchedulerController@sendCompanyQuotationResponseEmail');

	// To send the company notification emails
	Route::get('/sendcompanynotificationemail', 'SchedulerController@sendCompanyNotificationEmail');

	// To send the share announcement email
	Route::get('/sendannouncementemail', 'SchedulerController@sendAnnouncementEmail');

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


// To fetch quotation for agent Partner
Route::get('/agentPartner/dashboard/{id}', 'AgentPartnerController@fetchQuotationRequest');

/* For Twilio */
Route::get('/twiliodemo', 'TwilioController@twilioDemo');
Route::post('/call', 'TwilioController@call');
Route::get('/outbound/{salesPhone}', 'TwilioController@outbound');

/* Twilio Callback */
Route::get('/outbound', 'TwilioController@twilioResponse');