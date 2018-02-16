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

////////////////////////////////////////////////////////////// testing ////////////////

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

// Free trial
/*Route::get('/freetrial', function () {
    return view('freeTrial');
});*/

Route::get('/freetrial', 'CompanyController@register');

// Help center
Route::get('/helpcenter', function () {
    return view('helpCenter');
});

// login
Route::get('/login', function () {
    return view('login');
});

// Out team
Route::get('/ourteam', function () {
    return view('ourTeam');
});

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
	
 Route::group(['prefix' => 'administrator', 'middleware' => 'role:super_administrator'], function() {
	 
	// To return the navigation category view
	Route::get('/navigationcategory', ['middleware' => ['permission:view_list-cms_navigation_categories'], 'uses' => 
 'AdminController@navigationCategory']);

	// To save the navigation category
	Route::post('/savenavigationcategory', ['middleware' => ['permission:create-cms_navigation_categories'], 'uses' => 
 'AdminController@saveNavigationCategory']);

	// To show the navigation category list in datatable
	Route::get('/fetchnavigationcategories', ['middleware' => ['permission:view_list-cms_navigation_categories'], 'uses' =>  'AdminController@fetchNavigationCategories']);

	// To get the details for the selected navigation category
	Route::get('/getnavigationcategorydetails', ['middleware' => ['permission:view-cms_navigation_categories'], 'uses' =>  'AdminController@getNavigationCategoryDetails']);

	// To return the navigation view
	Route::get('/navigation', ['middleware' => ['permission:view_list-cms_navigations'], 'uses' => 'AdminController@navigation']);

	// To save the navigation details
	Route::post('/savenavigation', ['middleware' => ['permission:create-cms_navigations'], 'uses' => 'AdminController@saveNavigation']);

	// To show the navigation list in datatable
	Route::get('/fetchnavigation', ['middleware' => ['permission:view_list-cms_navigations'], 'uses' => 'AdminController@fetchNavigation']);

	// To get the details for the selected navigation
	Route::get('/getnavigationdetails', ['middleware' => ['permission:view-cms_navigations'], 'uses' => 'AdminController@getNavigationDetails']);

	// To update the navigation details
	Route::post('/updatenavigation', ['middleware' => ['permission:edit-cms_navigations'], 'uses' => 'AdminController@updateNavigation']);

	// To return the page details
	Route::get('/pages', ['middleware' => ['permission:view_list-cms_pages'], 'uses' => 'AdminController@pages']);

	// To save the page content
	Route::post('/savepage', ['middleware' => ['permission:create-cms_pages'], 'uses' => 'AdminController@savePage']);

	// To show the page list in datatable
	Route::get('/fetchpages', ['middleware' => ['permission:view_list-cms_pages'], 'uses' => 'AdminController@fetchPages']);

	// To get the details for the selected page
	Route::get('/getpagedetails', ['middleware' => ['permission:view-cms_pages'], 'uses' => 'AdminController@getPageDetails']);

	// To return the provinces page
	Route::get('/provinces', ['middleware' => ['permission:view_list-provinces'], 'uses' => 'AdminController@provinces']);

	// To save the province details
	Route::post('/saveprovince', ['middleware' => ['permission:create-provinces'], 'uses' => 'AdminController@saveProvince']);

	// To show the province list in datatable
	Route::get('/fetchprovinces', ['middleware' => ['permission:view_list-provinces'], 'uses' => 'AdminController@fetchProvinces']);

	// To get the details for the selected province
	Route::get('/getprovincedetails', ['middleware' => ['permission:view-provinces'], 'uses' => 'AdminController@getProvinceDetails']);

	// To return the moving Category page
	Route::get('/movingcategory', ['middleware' => ['permission:view_list-moving_item_categories'], 'uses' => 'AdminController@movingCategory']);

	// To save the moving Category details
	Route::post('/savemovingcategory', ['middleware' => ['permission:create-moving_item_categories'], 'uses' => 'AdminController@saveMovingCategory']);

	// To show the moving Category list in datatable
	Route::get('/fetchmovingcategory', ['middleware' => ['permission:view_list-moving_item_categories'], 'uses' => 'AdminController@fetchMovingCategory']);

	// To get the details for the selected moving Category
	Route::get('/getmovingcategory', ['middleware' => ['permission:view-moving_item_categories'], 'uses' => 'AdminController@getMovingCategory']);

	// To return the moving Category details page
	Route::get('/movingitemdetails', ['middleware' => ['permission:view_list-moving_item_details'], 'uses' => 'AdminController@movingItemDetails']);

	// To save the moving Category details
	Route::post('/savemovingitemdetails', ['middleware' => ['permission:create-moving_item_details'], 'uses' => 'AdminController@saveMovingItemDetails']);

	// To show the moving Category details list in datatable
	Route::get('/fetchmovingitemdetails', ['middleware' => ['permission:view_list-moving_item_details'], 'uses' => 'AdminController@fetchMovingItemDetails']);

	// To get the details for the selected moving Category details
	Route::get('/getmovingitemdetails', ['middleware' => ['permission:edit-moving_item_details'], 'uses' => 'AdminController@getMovingItemDetails']);

	// To return the activity feedback page
	Route::get('/activityfeedback', ['middleware' => ['permission:view_list-client_activity_lists'], 'uses' => 'AdminController@activityFeedback']);

	// To show the activity list in datatable
	Route::get('/fetchactivityfeedback', ['middleware' => ['permission:view_list-client_activity_lists'], 'uses' => 'AdminController@fetchActivityFeedback']);

	// To return the activity page
	Route::get('/activity', ['middleware' => ['permission:view_list-client_activity_lists'], 'uses' => 'AdminController@activity']);

	// To save the activity details
	Route::post('/saveactivity', ['middleware' => ['permission:create-client_activity_lists'], 'uses' => 'AdminController@saveActivity']);

	// To show the activity list in datatable
	Route::get('/fetchactivity', ['middleware' => ['permission:view_list-client_activity_lists'], 'uses' => 'AdminController@fetchActivity']);

	// To get the details for the selected activity
	Route::get('/getactivitydetails', ['middleware' => ['permission:view-client_activity_lists'], 'uses' => 'AdminController@getActivityDetails']);

	// To return the industry page
	Route::get('/industrytype', ['middleware' => ['permission:view_list-company_categories'], 'uses' => 'AdminController@industryType']);

	// To save the industry details
	Route::post('/saveindustrytype', ['middleware' => ['permission:create-company_categories'], 'uses' => 'AdminController@saveIndustryType']);

	// To show the industry list in datatable
	Route::get('/fetchindustrytype', ['middleware' => ['permission:view_list-company_categories'], 'uses' => 'AdminController@fetchIndustryType']);

	// To get the details for the selected industry
	Route::get('/getindustrytypedetails', ['middleware' => ['permission:view-company_categories'], 'uses' => 'AdminController@getIndustryTypeDetails']);

	// To return the services page
	Route::get('/services', ['middleware' => ['permission:view_list-category_services'], 'uses' => 'AdminController@services']);

	// To save the services details
	Route::post('/saveservices', ['middleware' => ['permission:create-category_services'], 'uses' => 'AdminController@saveServices']);

	// To show the services list in datatable
	Route::get('/fetchservices', ['middleware' => ['permission:view_list-category_services'], 'uses' => 'AdminController@fetchServices']);

	// To get the details for the selected services
	Route::get('/getservicesdetails', ['middleware' => ['permission:view-category_services'], 'uses' => 'AdminController@getServicesDetails']);

	// To return the utility service categories page
	Route::get('/utilityservicecategories', ['middleware' => ['permission:view_list-utility_service_categories'], 'uses' =>  'AdminController@utilityServiceCategories']);

	// To save the utility service categories details
	Route::post('/saveutilityservicecategory', ['middleware' => ['permission:create-utility_service_categories'], 'uses' => 
 'AdminController@saveUtilityServiceCategory']);

	// To show the utility service categories list in datatable
	Route::get('/fetchutilityservicecategories', ['middleware' => ['permission:view_list-utility_service_categories'], 'uses' => 
 'AdminController@fetchUtilityServiceCategories']);

	// To get the details for the selected utility service category
	Route::get('/getutilityservicecategorydetails', ['middleware' => ['permission:view-utility_service_categories'], 'uses' => 
 'AdminController@getUtilityServiceCategoryDetails']);

	// To return the utility service types page
	Route::get('/utilityservicetypes', ['middleware' => ['permission:view_list-utility_service_types'], 'uses' => 'AdminController@utilityServiceTypes']);

	// To save the utility service types
	Route::post('/saveutilityservicetype', ['middleware' => ['permission:create-utility_service_types'], 'uses' => 'AdminController@saveUtilityServiceType']);

	// To show the utility service type list in datatable
	Route::get('/fetchutilityservicetypes', ['middleware' => ['permission:view_list-utility_service_types'], 'uses' => 
  'AdminController@fetchUtilityServiceTypes']);

	// To get the details for the selected utility service type
	Route::get('/getutilityservicetypedetails', ['middleware' => ['permission:view-utility_service_types'], 'uses' => 
 'AdminController@getUtilityServiceTypeDetails']);

	// To return the utility service page
	Route::get('/utilityserviceproviders', ['middleware' => ['permission:view_list-utility_service_providers'], 'uses' => 'AdminController@utilityServiceProviders']);

	// To get the service type on the basis of selected service category
	Route::get('/getcategoryservicetypes', ['middleware' => ['permission:view-utility_service_providers'], 'uses' => 
'AdminController@getCategoryServiceTypes']);

	// To get the cities on the basis of selected province
	Route::get('/getprovincecities', ['middleware' => ['permission:view_list-provinces'], 'uses' => 'AdminController@getProvinceCities']);

	// To save the utility service provider details
	Route::post('/saveserviceprovider', ['middleware' => ['permission:create-utility_service_providers'], 'uses' => 'AdminController@saveServiceProvider']);

	// To show the utility service providers list in datatable
	Route::get('/fetchserviceproviders', ['middleware' => ['permission:view_list-utility_service_providers|view_list-utility_service_types'], 'uses' => 
'AdminController@fetchServiceProviders']);

	// To get the details of the selected service provider
	Route::get('/getserviceproviderdetails',  ['middleware' => ['permission:view-utility_service_providers'], 'uses' => 'AdminController@getServiceProviderDetails']);

	// To return the payment plans view
	Route::get('/paymentplans', ['middleware' => ['permission:view_list-payment_plans'], 'uses' => 'AdminController@paymentPlans']);

	// To save the payment plan details
	Route::post('/savepaymentplan', ['middleware' => ['permission:create-payment_plans'], 'uses' => 'AdminController@savePaymentPlan']);

	// To show the payment plans list in datatable
	Route::get('/fetchpaymentplans', ['middleware' => ['permission:view_list-payment_plans'], 'uses' => 'AdminController@fetchPaymentPlans']);

	// To get the details of the selected payment plan
	Route::get('/getpaymentplandetails', ['middleware' => ['permission:view-payment_plans'], 'uses' => 'AdminController@getPaymentPlanDetails']);

	// To return the cities listing view
	Route::get('/cities', ['middleware' => ['permission:view_list-cities'], 'uses' => 'AdminController@cities']);

	// To save the city details
	Route::post('/savecity', ['middleware' => ['permission:create-cities'], 'uses' => 'AdminController@saveCity']);

	// To show the cities list in datatable
	Route::get('/fetchcities', ['middleware' => ['permission:view_list-cities'], 'uses' => 'AdminController@fetchCities']);

	// To get the details of the selected city
	Route::get('/getcitydetails',['middleware' => ['permission:view-cities'], 'uses' =>  'AdminController@getCityDetails']);

	// To return email template listing view
	Route::get('/emailtemplates', ['middleware' => ['permission:view_list-email_templates'], 'uses' => 'AdminController@emailTemplates']);

	// To save the email template details
	Route::post('/saveemailtemplate', ['middleware' => ['permission:create-email_templates'], 'uses' => 'AdminController@saveEmailTemplate']);

	// To show the email template list in datatable
	Route::get('/fetchemailtemplates', ['middleware' => ['permission:view_list-email_templates'], 'uses' => 'AdminController@fetchEmailTemplates']);

	// To get the details of selected email template
	Route::get('/getemailtemplatedetails', ['middleware' => ['permission:view-email_templates'], 'uses' => 'AdminController@getEmailTemplateDetails']);

	// To return the generate invoice page
	Route::get('/generateinvoice', 'AdminController@generateInvoice');

	// To convert html to dompdf
	Route::get('htmltopdfview', array('as'=>'htmltopdfview','uses'=>'AdminController@htmltopdfview'));
	
	// To return role listing view
	Route::get('/roles', ['middleware' => ['permission:view-roles'], 'uses' => 'AdminController@roles']);

	// To save new role
	Route::post('/saverole', ['middleware' => ['permission:create-roles'], 'uses' => 'AdminController@saveRole']);

	// To show the role list in datatable
	Route::get('/fetchroles', ['middleware' => ['permission:view-roles'], 'uses' => 'AdminController@fetchRoles']);

	// To get the details of selected role
	Route::get('/getselectedrole', ['middleware' => ['permission:view-roles'], 'uses' => 'AdminController@getSelectedRole']);
	
	// To return permission listing view
	Route::get('/permissions', ['middleware' => ['permission:view-permissions'], 'uses' => 'AdminController@permissions']);

	// To save new permission
	Route::post('/savepermission', ['middleware' => ['permission:create-permissions'], 'uses' => 'AdminController@savePermission']);

	// To show the permission list in datatable
	Route::get('/fetchpermissions', ['middleware' => ['permission:view-permissions'], 'uses' => 'AdminController@fetchPermissions']);

	
	// To get the details of selected permission
	Route::get('/getselectedpermission', ['middleware' => ['permission:view-roles'], 'uses' => 'AdminController@getSelectedPermission']);
	
	
	// To detach permission from role
	Route::get('/detachrolepermission', ['middleware' => ['permission:detach-permission_role'], 'uses' => 'AdminController@detachRolePermission']);

	// To return rolespermissions listing view
	Route::get('/rolespermissions', ['middleware' => ['permission:view-permission_role'], 'uses' => 'AdminController@rolesPermissions']);

	// To save new rolepermission
	Route::post('/saverolepermission', ['middleware' => ['permission:attach-permission_role'], 'uses' => 'AdminController@saveRolePermission']);

	// To show the rolespermissions list in datatable
	Route::get('/fetchrolespermissions', ['middleware' => ['permission:view-permission_role'], 'uses' => 'AdminController@fetchRolesPermissions']);

	
	// To detach role from user
	Route::get('/detachroleuser', 'AdminController@detachRoleUser');

	// To return rolesusers listing view
	Route::get('/rolesusers', ['middleware' => ['permission:view_list-role_user'], 'uses' => 'AdminController@rolesUsers']);

	// To save new roleuser
	Route::post('/saveroleuser', ['middleware' => ['permission:attach-role_user'], 'uses' => 'AdminController@saveRoleUser']);

	// To show the rolesusers list in datatable
	Route::get('/fetchrolesusers', ['middleware' => ['permission:view_list-role_user'], 'uses' => 'AdminController@fetchRolesUsers']);
	
	
	// To detach permission from user
	Route::get('/detachpermissionuser', ['middleware' => ['permission:detach-role_user'], 'uses' => 'AdminController@detachPermissionUser']);

	// To return permissionsusers listing view
	Route::get('/permissionsusers', ['middleware' => ['permission:view-permission_user'], 'uses' => 'AdminController@permissionsUsers']);

	// To save new permissionuser
	Route::post('/savepermissionuser', ['middleware' => ['permission:attach-permission_user'], 'uses' => 'AdminController@savePermissionUser']);

	// To show the permissionsusers list in datatable
	Route::get('/fetchpermissionsusers', ['middleware' => ['permission:view-permission_user'], 'uses' => 'AdminController@fetchPermissionsUsers']);

	

	/* ---------- Company related functionality ---------- */

	// To return the company categories view
	Route::get('/companycategories', ['middleware' => ['permission:view-company_categories|view_list-company_categories'], 'uses' => 'CompanyController@companyCategories']);

	// To save the company category details
	Route::post('/savecompanycategory', ['middleware' => ['permission:create-company_categories'], 'uses' => 'CompanyController@saveCompanyCategory']);

	// To show the company categories list in datatable
	Route::get('/fetchcompanycategories', ['middleware' => ['permission:view_list-company_categories'], 'uses' => 'CompanyController@fetchCompanyCategories']);

	// To get the details of the selected company category
	Route::get('/getcompanycategorydetails',['middleware' => ['permission:view-company_categories'], 'uses' => 'CompanyController@getCompanyCategoryDetails']);

	// To return the company listing view
	Route::get('/companies', ['middleware' => ['permission:view_list-companies|view-companies'], 'uses' => 'CompanyController@companies']);

	// To save the company details
	Route::post('/savecompanydetails', ['middleware' => ['permission:save-companies'], 'uses' => 'CompanyController@saveCompanyDetails']);

	// To fetch the companies list and show in datatable
	Route::get('/fetchcompanies', ['middleware' => ['permission:view_list-companies'], 'uses' => 'CompanyController@fetchCompanies']);

	// To get the details of the selected company
	Route::get('/getcompanydetails', ['middleware' => ['permission:view-companies'], 'uses' => 'CompanyController@getCompanyDetails']);

	// To update the company details
	Route::post('/updatecompanydetails', ['middleware' => ['permission:edit-companies'], 'uses' => 'CompanyController@updateCompanyDetails']);

	// To return the company agent view
	Route::get('/agents', ['middleware' => ['permission:view_list-agent_clients'], 'uses' => 'CompanyController@agents']);

	// To save the agent details
	Route::post('/saveagent', ['middleware' => ['permission:create-agent_clients'], 'uses' => 'CompanyController@saveAgent']);

	// To fetch the agent list and show in datatable
	Route::get('/fetchagents', ['middleware' => ['permission:view_list-agent_clients'], 'uses' => 'CompanyController@fetchAgents']);

	// To get the agent details
	Route::get('/getagentdetails', ['middleware' => ['permission:view-agent_clients'], 'uses' => 'CompanyController@getAgentDetails']);

	// To update the agent details
	Route::post('/updateagent', 'CompanyController@updateAgent');

	// To update company image
	Route::post('/updatecompanyimage', 'CompanyController@updateCompanyImage');

	/* ---------- Company related functionality ---------- */

	// To return the provincial agency details page
	Route::get('/provincialagencies', ['middleware' => ['permission:view_list-provincial_agency_details'], 'uses' => 'AdminController@provincialAgencies']);

	// To save the provincial agency details
	Route::post('/saveprovincialagency', ['middleware' => ['permission:create-provincial_agency_details'], 'uses' => 'AdminController@saveProvincialAgency']);

	// To show the provincial agency list in datatable
	Route::get('/fetchprovincialagencies', ['middleware' => ['permission:view_list-provincial_agency_details'], 'uses' => 'AdminController@fetchProvincialAgencies']);

	// To get the details for the selected provincial agency
	Route::get('/getprovincialagencydetails', ['middleware' => ['permission:view-provincial_agency_details'], 'uses' => 'AdminController@getProvincialAgencyDetails']);

	// Change Password
	Route::get('/changepassword', 'AdminController@getchangepassword');

	// To update Password
	Route::post('/changepassword', ['middleware' => ['permission:edit-password_resets'], 'uses' => 'AdminController@changePassword']);

});
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
	Route::get('/dashboard', ['uses' => 'AgentController@dashboard']);

	// To show agent clients listing page
	Route::get('/clients', ['middleware' => ['permission:view_list-agent_clients'], 'uses' => 'AgentController@clients']);

	// To show agent invite listing page
	Route::get('/invites', ['middleware' => ['permission:view_list-agent_client_invites'], 'uses' => 'AgentController@invites']);
	
	// To save the client details
	Route::post('/saveclient', ['middleware' => ['permission:create-agent_client_invites'], 'uses' => 'AgentController@saveClient']);

	// To fetch the clients list and show in datatable
	Route::get('/fetchclients', ['middleware' => ['permission:view_list-agent_client_invites'], 'uses' => 'AgentController@fetchClients']);

	// To fetch the clients invites and show in datatable
	Route::get('/fetchinvites', ['middleware' => ['permission:view_list-agent_client_invites'], 'uses' => 'AgentController@fetchInvites']);
	
	// To get the details of the selected client
	Route::get('/getclientdetails', ['middleware' => ['permission:view-agent_clients'], 'uses' => 'AgentController@getClientDetails']);

	// To get the details of the selected invite
	Route::get('/getinvitedetails', ['middleware' => ['permission:view-agent_client_invites'], 'uses' => 'AgentController@getInviteDetails']);
	
	// To save the partner details
	Route::post('/savepartnerdetails', ['middleware' => ['permission:create-agent_partners'], 'uses' => 'AgentController@savePartnerDetails']);
	
	// To get the details of the selected partner
	Route::get('/getpartnerdetails', ['middleware' => ['permission:view-agent_partners'], 'uses' => 'AgentController@getPartnerDetails']);
	
	// To fetch the partners and show in datatable
	Route::get('/fetchpartners', ['middleware' => ['permission:view_list-agent_partners'], 'uses' => 'AgentController@fetchPartners']);
	
	// To show partner listing page
	Route::get('/partners', ['middleware' => ['permission:view_list-agent_partners'], 'uses' => 'AgentController@partners']);

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
	Route::get('/getquotationresponsedetails', 'MoversController@getqQuotationResponseDetails');
	
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
