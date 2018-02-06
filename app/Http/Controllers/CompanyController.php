<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Permission;
use App\CmsNavigationType;
use App\CmsNavigationCategory;
use App\CmsNavigation;
use App\CmsPage;
use App\Province;
use App\UtilityServiceCategory;
use App\Country;
use App\State;
use App\UtilityServiceType;
use App\UtilityServiceProvider;
use App\CompanyCategory;
use App\PaymentPlan;
use App\City;
use App\Company;
use App\PaymentPlanType;
use App\CategoryService;
use App\PaymentPlanSubscription;
use App\ForgotPassword;
use App\HomeCleaningServiceRequest;
use App\DigitalServiceRequest;
use App\TechConciergeServiceRequest;
use App\MovingItemServiceRequest;
use App\HomeCleaningAdditionalServiceRequest;
use App\HomeCleaningOtherPlaceServiceRequest;
use App\HomeCleaningSteamingServiceRequest;
use App\MovingTransportation;
use App\TechConciergeAppliancesServiceRequest;
use App\ServiceRequestResponse;
use App\DigitalServiceTypeRequest;
use App\MovingItemDetailServiceRequest;
use App\MovingTransportationTypeRequest;

use Validator;
use Helper;

class CompanyController extends Controller
{
	/**
     * Function to return the company registration page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
    	// Get the province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

    	// Get the company categories
    	$companyCategories = CompanyCategory::where(['status' => '1'])->select('id', 'category')->orderBy('category', 'asc')->get();

    	// return view('company/register', ['provinces' => $provinces, 'companyCategories' => $companyCategories]);
    	return view('freeTrial', ['provinces' => $provinces, 'companyCategories' => $companyCategories]);
    }

    /**
     * Function to return login view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( Auth::check() || Auth::viaRemember() )	// User is already logged-in or remembered
        {
        	return redirect('company/dashboard');
        }
        else 					// User is not logged-in, show the login page
        {
        	return view('company/index');
        }
    }


    /**
     * Function for company representative login
     * @param void
     * @return array
     */
    public function login()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $loginData);

        $remember = false;
        if( isset( $loginData['remember'] ) )
        {
        	$remember = true;
        }

        // Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'username'	=> $loginData['username'],
		        'password' 	=> $loginData['password']
		    ),
		    array(
		        'username' 	=> array('required', 'email'),
		        'password'	=> array('required', 'min:6'),
		    ),
		    array(
		        'username.required' => 'Please enter email',
		        'username.email'   	=> 'Please enter valid email',
		        'password.required'	=> 'Please enter password',
		        'password.min'    	=> 'Password must contain atleat 6 characters',
		    )
		);

		if ( $validation->fails() )		// Some data is not valid as per the defined rules
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else 							// The data is valid, go ahead and check the login credentials and do login
		{
			// Check for the credential and role. Only back-end user can login here
			
			$user = User::where(['email' => $loginData['username'], 'status' => '1'])->first();

			if( count($user)  > 0 )
			{
				// Check if the company is active or not
				$userCompany = $user->company->first();

				if( ( count( $userCompany ) > 0 ) && $userCompany->status == 1 )
				{
			        if( $user->hasRole(['company_representative']) )	// list of allowed users
			        {
			            if( Auth::attempt(['email' => $loginData['username'], 'password' => $loginData['password'], 'status' => '1'], $remember) )
			            {
			                // Get the logged-in user id
			                $userId = Auth::id();

			                // If user credentials are valid, update the last_login time in users table.
			                $user = User::find($userId);
			                $user->last_login = date('Y-m-d H:i:s');
			                $user->update();

			                $response['errCode']    = 0;
			                $response['errMsg']     = 'Successful login';
			            }
			            else
			            {
			                $response['errCode']    = 2;
			                $response['errMsg']     = 'Invalid user credentials';
			            }
			        }
			        else
			        {
			        	$response['errCode']    = 3;
			           	$response['errMsg']     = 'Invalid user';
			        }
				}
				else
				{
					$response['errCode']    = 4;
	           		$response['errMsg']     = 'Company is not verified yet';
				}
			}
			else
	        {
	        	$response['errCode']    = 5;
	           	$response['errMsg']     = 'Invalid user credentials';
	        }
		}

		return response()->json($response);
    }

    /**
     * Function for Change Password
     * @param void
     * @return array
     */
    public function getchangepassword()
    {
        return view('administrator/changepassword');
    }

    /**
     * Function for Change Password
     * @param void
     * @return array
     */
    public function changePassword()
    {
        // Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $pwddata);

        // Server Side Validation
        $response =array();

        $validation = Validator::make(
            array(
                'oldpassword'  => $pwddata['oldpassword'],
                'newpassword'  => $pwddata['newpassword'],
                'cnfpassword'  => $pwddata['cnfpassword']
            ),
            array(
                'oldpassword'  => array('required'),
                'newpassword'  => array('required'),
                'cnfpassword'  => array('required')
            ),
            array(
                'oldpassword.required' => 'Please enter old password',
                'newpassword.required' => 'Please enter new password',
                'cnfpassword.required' => 'Please enter confirm password'
            )
        );

        if ( $validation->fails() )     // Some data is not valid as per the defined rules
        {
            $error = $validation->errors()->first();

            if( isset( $error ) && !empty( $error ) )
            {
                $response['errCode']    = 1;
                $response['errMsg']     = $error;
            }
        }
        else 
        {

            $userId = Auth::id();
            $user = User::find($userId);

            if(($pwddata['newpassword'] == $pwddata['cnfpassword']) && ($pwddata['newpassword'] != '') && ($pwddata['cnfpassword'] != '')) 
            {
                if (Hash::check($pwddata['oldpassword'], $user->password))
                {    
                    $user->password = Hash::make($pwddata['newpassword']);
                    $user->update();
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Password change successfully.';
                }
                else
                {
                    $response['errCode']    = 2;
                    $response['errMsg']     = 'Old password does not match.';
                }
            } 
            else 
            {
                $response['errCode']    = 3;
                $response['errMsg']     = 'Password and confirm password doest not match.';
            }
        }

        return response()->json($response);
    }

    /**
     * Function for Forgot Password
     * @param void
     * @return array
     */
    public function getForgotPassword(Request $request)
    {
        $type = 1;
        $q = $request->input('q');
        $hash = $request->input('hash');
        if($q != '' && $hash != '')
        {
            $type = 2;
        }

        return view('administrator/forgotpassword',['type' => $type, 'q' => $q, 'hash' => $hash]);
    }

    /**
     * Function for Forgot Password
     * @param void
     * @return array
     */
    public function forgotPassword()
    {
        // Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $pwddata);

        // Server Side Validation
        $response =array();

        if($pwddata['type'] == 1) 
        {

            $validation = Validator::make(
                array(
                    'email'  => $pwddata['email']
                ),
                array(
                    'email'  => array('required', 'email')
                ),
                array(
                    'email.required' => 'Please enter email',
                    'email.email'    => 'Please enter valid email',
                )
            );

            if ( $validation->fails() )     // Some data is not valid as per the defined rules
            {
                $error = $validation->errors()->first();

                if( isset( $error ) && !empty( $error ) )
                {
                    $response['errCode']    = 1;
                    $response['errMsg']     = $error;
                }
            }
            else                            // The data is valid, go ahead and check the login credentials and do login
            {
                $user = User::where(['email' => $pwddata['email'], 'status' => '1'])->first();
                if( count($user)  > 0 )
                {
                    if(1)
                    {
                        $response['errCode'] = 0;
                        $response['errMsg']  = 'Email has been sent successfully. Please check you email';
                    }
                    else
                    {
                        $response['errCode'] = 2;
                        $response['errMsg']  = 'Error while sending mail'; 
                    }

                }
                else
                {
                    $response['errCode'] = 3;
                    $response['errMsg']  = 'Invalid user credentials';
                }
            }

            return response()->json($response);
        
        } 
        elseif ($pwddata['type'] == 2)
        {
            $validation = Validator::make(
                array(
                    'newpassword'  => $pwddata['newpassword'],
                    'cnfpassword'  => $pwddata['cnfpassword']
                ),
                array(
                    'newpassword'  => array('required'),
                    'cnfpassword'  => array('required')
                ),
                array(
                    'newpassword.required' => 'Please enter new password',
                    'cnfpassword.required' => 'Please enter confirm password'
                )
            );

            if ( $validation->fails() )     // Some data is not valid as per the defined rules
            {
                $error = $validation->errors()->first();

                if( isset( $error ) && !empty( $error ) )
                {
                    $response['errCode']    = 1;
                    $response['errMsg']     = $error;
                }
            }
            else                            // The data is valid, go ahead and check the login credentials and do login
            {
                $email = base64_decode($pwddata['q']);
                $hash  = base64_decode($pwddata['hash']);
                $array = ForgotPassword::where(['email' => $email, 'hash' => $pwddata['hash'], 'status' => 0])->first();
                $user = User::where(['email' => $loginData['username'], 'status' => '1'])->first();

                if (count($array) > 0) 
                {
                    if(($pwddata['newpassword'] == $pwddata['cnfpassword']) && ($pwddata['newpassword'] != '') && ($pwddata['cnfpassword'] != '')) 
                    {
                        $user = User::find($user->id);
                        $user->password = Hash::make($pwddata['newpassword']);
                        $user->update();

                        $forgotPassword = ForgotPassword::find($array->id);
                        $forgotPassword->status = 1;
                        $forgotPassword->update();
                        
                        $response['errCode']    = 0;
                        $response['errMsg']     = 'Password change successfully.';
                    } 
                    else 
                    {
                        $response['errCode']    = 3;
                        $response['errMsg']     = 'Password and confirm password doest not match.';
                    }
                }
                else
                {
                    $response['errCode']    = 4;
                    $response['errMsg']     = 'Error';
                }
            }

            return response()->json($response);
        }
    }

    /**
     * Function to register a new company
     * @param void
     * @return array
     */
    public function registerCompany()
    {
    	$frmData = Input::get('frmData');

    	$companyData = array();

    	// Parse the serialize form
    	parse_str($frmData, $companyData);

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'rep_fname'			=> $companyData['rep_fname'],
		        'rep_lname'			=> $companyData['rep_lname'],
		        'rep_designation'	=> $companyData['rep_designation'],
		        'email'				=> $companyData['email'],
		        'password'			=> $companyData['password'],
		        'phone_no'			=> $companyData['phone_no'],
		        'company_name'		=> $companyData['company_name'],
		        'company_province'	=> $companyData['company_province'],
		        'company_type'		=> $companyData['company_type']
		    ),
		    array(
		    	'rep_fname'			=> array('required'),
		        'rep_lname'			=> array('required'),
		        'rep_designation'	=> array('required'),
		        'email'				=> array('required', 'email'),
		        'password'			=> array('required', 'min:6'),
		        'phone_no'			=> array('required', 'numeric'),
		        'company_name'		=> array('required'),
		        'company_province'	=> array('required'),
		        'company_type'		=> array('required')
		    ),
		    array(
		        'rep_fname.required' 		=> 'Please enter first name',
		        'rep_lname.required' 		=> 'Please last last name',
		        'rep_designation.required' 	=> 'Please enter job title',
		        'email.required' 			=> 'Please enter email',
		        'email.email' 				=> 'Please enter valid email',
		        'password.required' 		=> 'Please enter password',
		        'password.min' 				=> 'Password must contain atleat 6 characters',
		        'phone_no.required' 		=> 'Please enter phone number',
		        'phone_no.numeric' 			=> 'Please enter a valid number',
		        'company_name.required' 	=> 'Please enter company name',
		        'company_province.required' => 'Please select province',
		        'company_type.required' 	=> 'Please select industry type'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check if the company representative with the same email id already exist
			$user = User::where(['email' => $companyData['email']])->first();

			if( count( $user ) == 0 )
			{
				// Check if the company with the same name already exist
				$company = Company::where(['company_name' => $companyData['company_name']])->first();

				if( count( $company ) == 0 )
				{
					// Start the transaction
					DB::beginTransaction();

					// Create the User (Company Representative)
					$companyRep = new User;

					$companyRep->email 		= $companyData['email'];
					$companyRep->designation= $companyData['rep_designation'];
					$companyRep->fname 		= $companyData['rep_fname'];
					$companyRep->lname 		= $companyData['rep_lname'];
					$companyRep->password 	= Hash::make($companyData['password']);
					$companyRep->status 	= '1';
					// $companyRep->status 	= '0'; 										// Initially the account is not active

					if( $companyRep->save() )
					{
						// Attach the role (Company Representative) to the newly created user
						$companyRep->attachRole(2);		// 2: Company Representative

						// Create the Company
						$company = new Company;

						$company->company_name 			= $companyData['company_name'];
						$company->company_category_id 	= $companyData['company_province'];
						$company->province_id 			= $companyData['company_type'];
						$company->created_by			= $companyRep->id;									// Id of newly created user
						$company->status 				= '1';
						// $company->status 				= '0';												// Initially the account is not active

						if( $company->save() )
						{
							// Attach the created user to the company
							$companyRep->company()->attach($company->id);

							DB::commit();

							$response['errCode']    = 0;
				        	$response['errMsg']     = 'Company registered successfully';
						}
						else
						{
							DB::rollBack();

							$response['errCode']    = 2;
				        	$response['errMsg']     = 'Some error in company registeration';
						}
					}
					else
					{
						DB::rollBack();

						$response['errCode']    = 3;
			        	$response['errMsg']     = 'Some error in company registeration';
					}
				}
				else
				{
					$response['errCode']    = 4;
			        $response['errMsg']     = 'Company with the same name already exist';
				}
			}
			else
			{
				$response['errCode']    = 5;
		        $response['errMsg']     = 'User with the same email already exist';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to return dashboard view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
    	return view('company/dashboard');
    }

    /**
     * Function to return company profile view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
    	// Get province list
    	$provinces 	= Province::where(['status' => '1'])->orderBy('name', 'asc')->select('id', 'abbreviation', 'name')->get();

    	// Get cities list
    	$cities 	= City::where(['status' => '1'])->orderBy('name', 'asc')->select('id', 'name')->get();

    	// Get country list
    	$countries 	= Country::orderBy('name', 'asc')->select('id', 'name')->get();

    	// Get the logged in user id
        $userId = Auth::user()->id;

        // Get the logged in user details
		$user = User::find($userId);

		// Get the company associated with the user
		$companyDetails = $user->company->first();

		// Get company categories list
		$companyCategories = CompanyCategory::where('status', '1')->select('id', 'category')->orderBy('category', 'asc')->get();

		// Get the service types list
		$categoryServices = CategoryService::where(['status' => '1', 'company_category_id' => $companyDetails->company_category_id])->select('id', 'service')->orderBy('service', 'asc')->get();

		// Get the services list
		$services = $companyDetails->services;

		$companyServices = array();
		if( count( $services ) > 0 )
		{
			foreach ($services as $service)
			{
				$companyServices[] = $service->id;
			}
		}

		// echo '<pre>';
		// print_r( $companyServices );
		// exit;

    	return view('company/profile', ['provinces' => $provinces, 'cities' => $cities, 'countries' => $countries, 'companyDetails' => $companyDetails, 'companyCategories' => $companyCategories, 'categoryServices' => $categoryServices, 'companyServices' => $companyServices]);
    }

    /**
     * Function to update the company details
     * @param void
     * @return array
     */
    public function updateCompanyBasicDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $companyData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'company_name'	=> $companyData['company_name'],
		        'company_email'	=> $companyData['company_email'],
		        'company_phone'	=> $companyData['company_phone']
		    ),
		    array(
		        'company_name' 	=> array('required'),
		        'company_email' => array('required', 'email'),
		        'company_phone' => array('required', 'numeric')
		    ),
		    array(
		        'company_name.required' => 'Please enter company name',
		        'company_email.required'=> 'Please enter email',
		        'company_email.email'	=> 'Please enter valid email',
		        'company_phone.required'=> 'Please enter phone number',
		        'company_phone.numeric'	=> 'Please enter a valid number'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Get the logged in user details
			$user = User::find($userId);

			// Get the company associated with the user
			$userCompany = $user->company->first();

			if( count( $userCompany ) > 0 )
			{
				// Check if the same does not exist with any other company
				$companyName = Company::where('id', '=', $userCompany->id)->where('company_name', '!=', $companyData['company_name'])->first();

				if( count( $companyName ) == 0 )
				{
					// Update the details
					$company = Company::find( $userCompany->id );

					$company->company_name 	= $companyData['company_name'];
					$company->email 		= $companyData['company_email'];
					$company->contact_number= $companyData['company_phone'];
					$company->fax 			= $companyData['company_fax'];
					$company->website 		= $companyData['company_website'];
					$company->updated_by	= $userId;

					if( $company->save() )
					{
						$response['errCode']    = 0;
			        	$response['errMsg']     = 'Company details updated successfully';
					}
					else
					{
						$response['errCode']    = 2;
				        $response['errMsg']     = 'Some error in updating the company details';
					}
				}
				else
				{
					$response['errCode']    = 3;
			        $response['errMsg']     = 'Company with the same name already exist';
				}
			}
			else
			{
				$response['errCode']    = 4;
		        $response['errMsg']     = 'Invalid company';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to update company address details
     * @param void
     * @return array
     */
    public function updateCompanyAddressDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $companyData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'company_address1'	=> $companyData['company_address1'],
		        'company_city'		=> $companyData['company_city'],
		        'company_province'	=> $companyData['company_province'],
		        'company_postalcode'=> $companyData['company_postalcode'],
		        'company_country'	=> $companyData['company_country']
		    ),
		    array(
		        'company_address1' 	=> array('required'),
		        'company_city' 		=> array('required'),
		        'company_province' 	=> array('required'),
		        'company_postalcode'=> array('required'),
		        'company_country' 	=> array('required')
		    ),
		    array(
		        'company_address1.required' 	=> 'Please enter address',
		        'company_city.required' 		=> 'Please select city',
		        'company_province.required' 	=> 'Please select province',
		        'company_postalcode.required'	=> 'Please enter postalcode',
		        'company_country.required' 		=> 'Please select country'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Get the logged in user details
			$user = User::find($userId);

			// Get the company associated with the user
			$userCompany = $user->company->first();

			if( count( $userCompany ) > 0 )
			{
				// Update the details
				$company = Company::find( $userCompany->id );

				$company->address1 		= $companyData['company_address1'];
				$company->address2 		= $companyData['company_address2'];
				$company->province_id 	= $companyData['company_province'];
				$company->city_id 		= $companyData['company_city'];
				$company->postal_code 	= $companyData['company_postalcode'];
				$company->country_id	= $companyData['company_country'];
				$company->updated_by	= $userId;

				if( $company->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Address details updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
			        $response['errMsg']     = 'Some error in updating the address details';
				}
			}
			else
			{
				$response['errCode']    = 4;
		        $response['errMsg']     = 'Invalid company';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to return the Quotation Request page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function QuotationRequest()
    {
        return view('company/quotationrequest');
    }

    /**
     * Function to show the Quotation Request list in datatable
     * @param void
     * @return array
     */
    public function fetchQuotationRequest()
    {
        $start      = Input::get('iDisplayStart');      // Offset
        $length     = Input::get('iDisplayLength');     // Limit
        $sSearch    = Input::get('sSearch');            // Search string
        $col        = Input::get('iSortCol_0');         // Column number for sorting
        $sortType   = Input::get('sSortDir_0');         // Sort type

        // Logged-in user id
        $userId = Auth::user()->id;

        $companyArray = DB::table('company_user')
                            ->leftJoin('companies', 'companies.id', '=', 'company_user.company_id')
                            ->select('companies.company_category_id', 'companies.id')
                            ->where('user_id', '=', $userId)
                            ->first();
        
        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        if($companyArray->company_category_id == 5) 
        {
            $class = "edit_tech_concierge_service";
            // Get the records after applying the datatable filters
            $movingItemArray = DB::table('tech_concierge_service_requests')
                                ->leftJoin('agent_clients', 'tech_concierge_service_requests.agent_client_id', '=', 'agent_clients.id')
                                ->orderBy($sortBy, $sortType)
                                ->where('tech_concierge_service_requests.company_id', '=', $companyArray->id)
                                ->limit($length)
                                ->offset($start)
                                ->select('agent_clients.fname', 'agent_clients.lname', 'agent_clients.email', 'agent_clients.contact_number', 'tech_concierge_service_requests.id')
                                ->get();

            $iTotal = DB::table('tech_concierge_service_requests')
                        ->leftJoin('agent_clients', 'tech_concierge_service_requests.agent_client_id', '=', 'agent_clients.id')
                        ->where('tech_concierge_service_requests.company_id', '=', $companyArray->id)
                        ->count();
        } 
        elseif ($companyArray->company_category_id == 4) 
        {
            $class = "edit_cable_internet_service";
            // Get the records after applying the datatable filters
            $movingItemArray = DB::table('digital_service_requests')
                                ->leftJoin('agent_clients', 'digital_service_requests.agent_client_id', '=', 'agent_clients.id')
                                ->orderBy($sortBy, $sortType)
                                ->where('digital_service_requests.digital_service_company_id', '=', $companyArray->id)
                                ->limit($length)
                                ->offset($start)
                                ->select('agent_clients.fname', 'agent_clients.lname', 'agent_clients.email', 'agent_clients.contact_number', 'digital_service_requests.id')
                                ->get();

            $iTotal = DB::table('digital_service_requests')
                        ->leftJoin('agent_clients', 'digital_service_requests.agent_client_id', '=', 'agent_clients.id')
                        ->where('digital_service_requests.digital_service_company_id', '=', $companyArray->id)
                        ->count();
        } 
        elseif ($companyArray->company_category_id == 3) 
        {
            $class = "edit_moving_item_service";
            // Get the records after applying the datatable filters
            $movingItemArray = DB::table('moving_item_service_requests')
                                ->leftJoin('agent_clients', 'moving_item_service_requests.agent_client_id', '=', 'agent_clients.id')
                                ->orderBy($sortBy, $sortType)
                                ->where('moving_item_service_requests.mover_company_id', '=', $companyArray->id)
                                ->limit($length)
                                ->offset($start)
                                ->select('agent_clients.fname', 'agent_clients.lname', 'agent_clients.email', 'agent_clients.contact_number', 'moving_item_service_requests.id')
                                ->get();

            $iTotal = DB::table('moving_item_service_requests')
                        ->leftJoin('agent_clients', 'moving_item_service_requests.agent_client_id', '=', 'agent_clients.id')
                        ->where('moving_item_service_requests.mover_company_id', '=', $companyArray->id)
                        ->count();
        }
        elseif ($companyArray->company_category_id == 2)
        {
            $class = "edit_home_cleaning_service";
            // Get the records after applying the datatable filters
            $movingItemArray = DB::table('home_cleaning_service_requests')
                                ->leftJoin('agent_clients', 'home_cleaning_service_requests.agent_client_id', '=', 'agent_clients.id')
                                ->orderBy($sortBy, $sortType)
                                ->where('home_cleaning_service_requests.company_id', '=', $companyArray->id)
                                ->limit($length)
                                ->offset($start)
                                ->select('agent_clients.fname', 'agent_clients.lname', 'agent_clients.email', 'agent_clients.contact_number', 'home_cleaning_service_requests.id')
                                ->get();

            $iTotal = DB::table('home_cleaning_service_requests')
                        ->leftJoin('agent_clients', 'home_cleaning_service_requests.agent_client_id', '=', 'agent_clients.id')
                        ->where('home_cleaning_service_requests.company_id', '=', $companyArray->id)
                        ->count();
        }


        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $movingItemArray ) > 0 )
        {
            foreach ($movingItemArray as $movingItem)
            {
                $response['aaData'][$k] = array(
                    0 => $movingItem->id,
                    1 => ucfirst( strtolower( $movingItem->fname." ".$movingItem->lname ) ),
                    2 => ucfirst( strtolower( $movingItem->email ) ),
                    3 => $movingItem->contact_number,
                    4 => '<a href="javascript:void(0);" id="'. $movingItem->id .'" class="'.$class.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

        return response()->json($response);
    }


    /**
     * Function to get the Home Service Request
     * @param void
     * @return array
     */
    public function getHomeServiceRequest()
    {
        $homeServiceId = Input::get('homeServiceId');

        $response = array();
        if( $homeServiceId != '' )
        {
            $homeServiceArray = HomeCleaningServiceRequest::find($homeServiceId);

            if( count( $homeServiceArray ) > 0 )
            {
            	$response['move_out_cleaning']                     		= $homeServiceArray->move_out_cleaning;
            	$response['move_in_cleaning']                     		= $homeServiceArray->move_in_cleaning;

                $response['moving_from_house_type']                     = ucwords( strtolower( $homeServiceArray->moving_from_house_type ) );
                $response['moving_from_floor']                          = $homeServiceArray->moving_from_floor;
                $response['moving_from_bedroom_count']                  = $homeServiceArray->moving_from_bedroom_count;
                $response['moving_from_property_type']                  = ucwords( strtolower( $homeServiceArray->moving_from_property_type ) );
                $response['moving_to_house_type']                       = ucwords( strtolower( $homeServiceArray->moving_to_house_type ) );
                $response['moving_to_floor']                            = $homeServiceArray->moving_to_floor;
                $response['moving_to_bedroom_count']                    = $homeServiceArray->moving_to_bedroom_count;
                $response['moving_to_property_type']                    = ucwords( strtolower( $homeServiceArray->moving_to_property_type ) );
                $response['home_condition']                             = ucwords( strtolower( $homeServiceArray->home_condition ) );
                $response['home_cleaning_level']                        = $homeServiceArray->home_cleaning_level;
                $response['home_cleaning_area']                         = $homeServiceArray->home_cleaning_area . 'sqft';
                $response['home_cleaning_people_count']                 = $homeServiceArray->home_cleaning_people_count;
                $response['home_cleaning_pet_count']                    = $homeServiceArray->home_cleaning_pet_count;
                $response['home_cleaning_bathroom_count']               = $homeServiceArray->home_cleaning_bathroom_count;
                $response['cleaning_behind_refrigerator_and_stove']     = $homeServiceArray->cleaning_behind_refrigerator_and_stove;
                $response['baseboard_to_be_washed']                  	= $homeServiceArray->baseboard_to_be_washed;
                $response['additional_information']                     = ucfirst( strtolower( $homeServiceArray->additional_information ) );

                // Get the moving from address
                $clientMovingFromAddress = DB::table('home_cleaning_service_requests as t1')
	                					->join('agent_client_moving_from_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
	                					->join('provinces as t3', 't2.province_id', '=', 't3.id')
	                					->join('cities as t4', 't2.city_id', '=', 't4.id')
	                					->join('countries as t5', 't2.country_id', '=', 't5.id')
	                					->where(['t1.id' => $homeServiceId, 't1.status' => '1'])
	                					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country')
	                					->first();

                // Get the moving to address
                $clientMovingToAddress = DB::table('home_cleaning_service_requests as t1')
	                					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
	                					->join('provinces as t3', 't2.province_id', '=', 't3.id')
	                					->join('cities as t4', 't2.city_id', '=', 't4.id')
	                					->join('countries as t5', 't2.country_id', '=', 't5.id')
	                					->where(['t1.id' => $homeServiceId, 't1.status' => '1'])
	                					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country', 't3.pst', 't3.gst', 't3.hst', 't3.service_charge')
	                					->first();

	            $response['pst'] 			= round($clientMovingToAddress->pst, 2) . '%';
	            $response['gst'] 			= round($clientMovingToAddress->gst, 2) . '%';
	            $response['hst'] 			= round($clientMovingToAddress->hst, 2) . '%';
	            $response['service_charge']	= round($clientMovingToAddress->service_charge, 2) . '%';

                // Get the selected Steaming carpet cleaning services by mover
                $steamingServices = DB::table('home_cleaning_steaming_service_requests as t1')
                					->join('home_cleaning_steaming_services as t2', 't1.steaming_service_id', '=', 't2.id')
                					->where(['t1.service_request_id' => $homeServiceId])
                					->select('t1.id as service_request_id', 't2.id as service_id', 't2.steaming_service_for')
                					->get();

                // Get the selected Other places to clean by mover
               	$otherPlacesToClean = DB::table('home_cleaning_other_place_service_requests as t1')
                					->join('home_cleaning_other_places as t2', 't1.other_place_id', '=', 't2.id')
                					->where(['t1.service_request_id' => $homeServiceId])
                					->select('t1.id as service_request_id', 't2.id as places_id', 't2.other_places')
                					->get();

                // Get the Additional Services selected by mover
               	$additionalServices = DB::table('home_cleaning_additional_service_requests as t1')
                					->join('home_cleaning_additional_services as t2', 't1.additional_request_id', '=', 't2.id')
                					->where(['t1.service_request_id' => $homeServiceId])
                					->select('t1.id as service_request_id', 't2.id as additional_service_id', 't1.quantity', 't2.additional_service')
                					->get();

                $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

	            $response['moving_to_address'] 	= $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

                $html = '';
                if( count( $steamingServices ) > 0 )
                {
                	foreach( $steamingServices as $steamingService )
                	{
                		$html .= '<tr>';

                		$html .= '<td>Steaming carpet cleaning</td>';
                		$html .= '<td>'. ucwords( strtolower( $steamingService->steaming_service_for ) ) .'</td>';
                		$html .= '<td>NA</td>';
                		$html .= '<td><input name="steaming_service_time_estimate['. $steamingService->service_id .']" class="form-control steaming_service_time_estimate" style="width: 100px;"></td>';
                		$html .= '<td><input name="steaming_service_budget_estimate['. $steamingService->service_id .']" class="form-control steaming_service_budget_estimate home_cleaning_amount" style="width: 100px;"></td>';

                		$html .= '</tr>';
                	}
                }

                if( count( $otherPlacesToClean ) > 0 )
                {
                	foreach( $otherPlacesToClean as $otherPlace )
                	{
                		$html .= '<tr>';

                		$html .= '<td>Other places to clean</td>';
                		$html .= '<td>'. ucwords( strtolower( $otherPlace->other_places ) ) .'</td>';
                		$html .= '<td>NA</td>';
                		$html .= '<td><input name="other_place_to_clean_time_estimate['. $otherPlace->places_id .']" class="form-control other_place_to_clean_time_estimate" style="width: 100px;"></td>';
                		$html .= '<td><input name="other_place_to_clean_budget_estimate['. $otherPlace->places_id .']" class="form-control other_place_to_clean_budget_estimate home_cleaning_amount" style="width: 100px;"></td>';

                		$html .= '</tr>';
                	}
                }

                if( count( $additionalServices ) > 0 )
                {
                	foreach( $additionalServices as $additionalService )
                	{
                		$html .= '<tr>';

                		$html .= '<td>Additional services</td>';
                		$html .= '<td>'. ucwords( strtolower( $additionalService->additional_service ) ) .'</td>';
                		$html .= '<td>'. $additionalService->quantity .'</td>';
                		$html .= '<td><input name="additional_service_time_estimate['. $additionalService->additional_service_id .']" class="form-control additional_service_time_estimate" style="width: 100px;"></td>';
                		$html .= '<td><input name="additional_service_budget_estimate['. $additionalService->additional_service_id .']" class="form-control additional_service_budget_estimate home_cleaning_amount" style="width: 100px;"></td>';

                		$html .= '</tr>';
                	}
                }

                $response['request_services_details'] = $html;
            }
        }
        return response()->json($response);
    }


    /**
     * Function to get the Cable Service Request
     * @param void
     * @return array
     */
    public function getCableServiceRequest()
    {
        $cableInternetId = Input::get('cableInternetId');

        $response = array();
        if( $cableInternetId != '' )
        {
        	$cableInternetServiceDetails = DigitalServiceRequest::find($cableInternetId);

        	$response['moving_from_house_type'] 	= ucwords( strtolower( $cableInternetServiceDetails['moving_from_house_type'] ) );
        	$response['moving_from_floor'] 			= $cableInternetServiceDetails['moving_from_floor'];
        	$response['moving_from_bedroom_count'] 	= $cableInternetServiceDetails['moving_from_bedroom_count'];
        	$response['moving_from_property_type'] 	= ucwords( strtolower( $cableInternetServiceDetails['moving_from_property_type'] ) );

        	$response['moving_to_house_type'] 		= ucwords( strtolower( $cableInternetServiceDetails['moving_to_house_type'] ) );
        	$response['moving_to_floor'] 			= $cableInternetServiceDetails['moving_to_floor'];
        	$response['moving_to_bedroom_count'] 	= $cableInternetServiceDetails['moving_to_bedroom_count'];
        	$response['moving_to_property_type'] 	= ucwords( strtolower( $cableInternetServiceDetails['moving_to_property_type'] ) );

			$response['have_cable_internet_already']		= ( $cableInternetServiceDetails['have_cable_internet_already'] == 1 ) ? 'Yes' : 'No';
			$response['employment_status'] 					= ( $cableInternetServiceDetails['employment_status'] == 1 ) ? 'Yes' : 'No';
			$response['want_to_receive_electronic_bill']	= ( $cableInternetServiceDetails['want_to_receive_electronic_bill'] == 1 ) ? 'Yes' : 'No';
			$response['want_to_contract_plan'] 				= ( $cableInternetServiceDetails['want_to_contract_plan'] == 1 ) ? 'Yes' : 'No';
			$response['want_to_setup_preauthorise_payment']	= ( $cableInternetServiceDetails['want_to_setup_preauthorise_payment'] == 1 ) ? 'Yes' : 'No';

			$response['additional_information']				= ucfirst( strtolower( $cableInternetServiceDetails['additional_information'] ) );

            // Get the moving from address
            $clientMovingFromAddress = DB::table('home_cleaning_service_requests as t1')
                					->join('agent_client_moving_from_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                					->join('cities as t4', 't2.city_id', '=', 't4.id')
                					->join('countries as t5', 't2.country_id', '=', 't5.id')
                					->where(['t1.id' => $cableInternetId, 't1.status' => '1'])
                					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country')
                					->first();

            // Get the moving to address
            $clientMovingToAddress = DB::table('home_cleaning_service_requests as t1')
                					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                					->join('cities as t4', 't2.city_id', '=', 't4.id')
                					->join('countries as t5', 't2.country_id', '=', 't5.id')
                					->where(['t1.id' => $cableInternetId, 't1.status' => '1'])
                					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country', 't3.gst', 't3.hst', 't3.pst', 't3.service_charge')
                					->first();

            $response['pst'] 			= round($clientMovingToAddress->pst, 2) . '%';
            $response['gst'] 			= round($clientMovingToAddress->gst, 2) . '%';
            $response['hst'] 			= round($clientMovingToAddress->hst, 2) . '%';
            $response['service_charge']	= round($clientMovingToAddress->service_charge, 2) . '%';

            $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

	        $response['moving_to_address'] 	= $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

	        // Get the selected services
	        $services = DB::table('digital_service_type_requests as t1')
    					->join('digital_service_types as t2', 't1.digital_service_type_id', '=', 't2.id')
    					->where(['t1.digital_service_request_id' => $cableInternetId])
    					->select('t1.id as service_request_id', 't2.id as service_id', 't2.service')
    					->get();

			$html = '';
	        if( count( $services ) > 0 )
	        {
	        	foreach( $services as $service )
	        	{
	        		$html .= '<tr>';

	        		$html .= '<td>Services</td>';
	        		$html .= '<td>'. ucwords( strtolower( $service->service ) ) .'</td>';
	        		$html .= '<td>NA</td>';
	        		$html .= '<td><input name="service_time_estimate['. $service->service_id .']" class="service_time_estimate form-control cable_internet_service_budget" style="width: 100px;"></td>';
	        		$html .= '<td><input name="service_budget_estimate['. $service->service_id .']" class="service_budget_estimate form-control cable_internet_service_amount" style="width: 100px;"></td>';

	        		$html .= '</tr>';
	        	}
	        }

	        $response['request_services_details'] = $html;

	        $additionalServiceHtml = '';
	        // Get the selected additional services
	        $additionalServices = DB::table('digital_additional_service_type_requests as t1')
    					->join('digital_additional_services as t2', 't1.digital_additional_service_type_id', '=', 't2.id')
    					->where(['t1.digital_service_request_id' => $cableInternetId])
    					->select('t1.id as service_request_id', 't2.id as additional_service_id', 't2.additional_service')
    					->get();

	        if( count( $additionalServices ) > 0 )
	        {
	        	foreach( $additionalServices as $additionalService )
	        	{
	        		$additionalServiceHtml .= '<tr>';

	        		$additionalServiceHtml .= '<td>Additional Services</td>';
	        		$additionalServiceHtml .= '<td>'. ucwords( strtolower( $additionalService->additional_service ) ) .'</td>';

	        		$additionalServiceHtml .= '</tr>';
	        	}
	        }

	        $response['request_additional_services_details'] = $additionalServiceHtml;

        }
        
        return response()->json($response);
    }


    /**
     * Function to get the Tech Concierge Request
     * @param void
     * @return array
     */
    public function getTechConciergeRequest()
    {
        $techConciergeId = Input::get('techConciergeId');

        $response = array();
        if( $techConciergeId != '' )
        {
            $techConciergeArray = TechConciergeServiceRequest::find($techConciergeId);

            if( count( $techConciergeArray ) > 0 )
            {
                $response['moving_to_house_type']  		= ucwords( strtolower( $techConciergeArray->moving_to_house_type ) );
                $response['moving_to_floor']        	= $techConciergeArray->moving_to_floor;
                $response['moving_to_bedroom_count']	= $techConciergeArray->moving_to_bedroom_count;
                $response['moving_to_property_type']	= ucwords( strtolower( $techConciergeArray->moving_to_property_type ) );

                $response['availability_date1']     	= date('d-m-Y', strtotime( $techConciergeArray->availability_date1 ) );
                $response['availability_date2']     	= date('d-m-Y', strtotime( $techConciergeArray->availability_date2 ) );
                $response['availability_date3']   		= date('d-m-Y', strtotime( $techConciergeArray->availability_date3 ) );

                $response['availability_time_from1']	= $techConciergeArray->availability_time_from1;
                $response['availability_time_upto1']	= $techConciergeArray->availability_time_upto1;
                $response['availability_time_from2']	= $techConciergeArray->availability_time_from2;
                $response['availability_time_upto2']	= $techConciergeArray->availability_time_upto2;
                $response['availability_time_from3']	= $techConciergeArray->availability_time_from3;
                $response['availability_time_upto3']	= $techConciergeArray->availability_time_upto3;

                $response['additional_information'] 	= $techConciergeArray->additional_information;

                // Get the moving from address
                $clientMovingFromAddress = DB::table('home_cleaning_service_requests as t1')
                    					->join('agent_client_moving_from_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                    					->join('cities as t4', 't2.city_id', '=', 't4.id')
                    					->join('countries as t5', 't2.country_id', '=', 't5.id')
                    					->where(['t1.id' => $techConciergeId, 't1.status' => '1'])
                    					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country')
                    					->first();

                // Get the moving to address
                $clientMovingToAddress = DB::table('home_cleaning_service_requests as t1')
                    					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                    					->join('cities as t4', 't2.city_id', '=', 't4.id')
                    					->join('countries as t5', 't2.country_id', '=', 't5.id')
                    					->where(['t1.id' => $techConciergeId, 't1.status' => '1'])
                    					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country', 't3.pst', 't3.gst', 't3.hst', 't3.service_charge')
                    					->first();

                $response['pst'] 			= round($clientMovingToAddress->pst, 2) . '%';
                $response['gst'] 			= round($clientMovingToAddress->gst, 2) . '%';
                $response['hst'] 			= round($clientMovingToAddress->hst, 2) . '%';
                $response['service_charge']	= round($clientMovingToAddress->service_charge, 2) . '%';

                $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

    	        $response['moving_to_address'] 	= $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

    	        $html = '';
    	        // Get the list of appliances to install
    	        $appliances = DB::table('tech_concierge_appliances_service_requests as t1')
        					->join('tech_concierge_appliances as t2', 't1.appliance_id', '=', 't2.id')
        					->where(['t1.service_request_id' => $techConciergeId])
        					->select('t1.id as service_request_id', 't2.id as service_id', 't2.appliances')
        					->get();

        		if( count( $appliances ) > 0 )
    	        {
    	        	foreach( $appliances as $appliance )
    	        	{
    	        		$html .= '<tr>';

    	        		$html .= '<td>Appliances you plan to install</td>';
    	        		$html .= '<td>'. ucwords( strtolower( $appliance->appliances ) ) .'</td>';
    	        		$html .= '<td>NA</td>';
    	        		$html .= '<td><input name="appliance_time_estimate['. $appliance->service_id .']" class="appliance_time_estimate form-control" style="width: 100px;"></td>';
    	        		$html .= '<td><input name="appliance_budget_estimate['. $appliance->service_id .']" class="appliance_budget_estimate form-control tech_concierge_amount" style="width: 100px;"></td>';

    	        		$html .= '</tr>';
    	        	}
    	        }
    	        
    	        $response['request_services_details'] = $html;

    	        $otherDetailHtml = '';
    	        // List of other details
    	        $otherDetails = DB::table('tech_concierge_other_details as t1')->select('id', 'details')->get();

    	        // Get the list of other details
    	        $otherSelectedDetails = DB::table('tech_concierge_other_detail_service_requests as t1')
			        					->leftJoin('tech_concierge_other_details as t2', 't1.other_detail_id', '=', 't2.id')
			        					->where(['t1.service_request_id' => $techConciergeId])
			        					->select('t1.id as service_request_id', 't2.id as service_id', 't2.details')
			        					->get();

        		if( count( $otherDetails ) > 0 )
    	        {
    	        	foreach( $otherDetails as $otherDetail )
    	        	{
    	        		$status = 'No';
    	        		$selectedService = DB::table('tech_concierge_other_detail_service_requests as t1')
				        					->leftJoin('tech_concierge_other_details as t2', 't1.other_detail_id', '=', 't2.id')
				        					->where(['t1.service_request_id' => $techConciergeId, 't2.id' => $otherDetail->id])
				        					->first();

				        if( count( $selectedService ) > 0 )
				        {
				        	$status = 'Yes';
				        }

    	        		$otherDetailHtml .= '<tr>';

    	        		$otherDetailHtml .= '<td>'. ucwords( strtolower( $otherDetail->details ) ) .'</td>';
    	        		$otherDetailHtml .= '<td>'. $status .'</td>';

    	        		$otherDetailHtml .= '</tr>';
    	        	}
    	        }

    	        // Get the Other Places to install appliances in
    	        $otherPlaces = DB::table('tech_concierge_place_service_requests as t1')
        					->join('tech_concierge_places as t2', 't1.place_id', '=', 't2.id')
        					->where(['t1.service_request_id' => $techConciergeId])
        					->select('t1.id as service_request_id', 't2.id as service_id', 't2.places')
        					->get();

    	        if( count( $otherPlaces ) > 0 )
    	        {
    	        	foreach( $otherPlaces as $otherPlace )
    	        	{
    	        		$otherDetailHtml .= '<tr>';

    	        		$otherDetailHtml .= '<td>Other Places to install appliances</td>';
    	        		$otherDetailHtml .= '<td>'. ucwords( strtolower( $otherPlace->places ) ) .'</td>';

    	        		$otherDetailHtml .= '</tr>';
    	        	}
    	        }

    	        $response['request_other_details'] = $otherDetailHtml;
            }
        }
        return response()->json($response);
    }


    /**
     * Function to get the Moving Companies Request
     * @param void
     * @return array
     */
    public function getMovingCompaniesRequest()
    {
        $movingCompanyId = Input::get('movingCompaniesId');

        $response = array();
        if( $movingCompanyId != '' )
        {
            $movingCompaniesArray = MovingItemServiceRequest::find($movingCompanyId);

            if( count( $movingCompaniesArray ) > 0 )
            {
                $response['moving_from_house_type']                     = ucfirst( strtolower( $movingCompaniesArray->moving_from_house_type ) );
                $response['moving_from_floor']                          = $movingCompaniesArray->moving_from_floor;
                $response['moving_from_bedroom_count']                  = $movingCompaniesArray->moving_from_bedroom_count;
                $response['moving_from_property_type']                  = ucfirst( strtolower($movingCompaniesArray->moving_from_property_type ) );

                $response['moving_to_house_type']                       = ucfirst( strtolower($movingCompaniesArray->moving_to_house_type ) );
                $response['moving_to_floor']                            = $movingCompaniesArray->moving_to_floor;
                $response['moving_to_bedroom_count']                    = $movingCompaniesArray->moving_to_bedroom_count;
                $response['moving_to_property_type']                    = ucfirst( strtolower($movingCompaniesArray->moving_to_property_type ) );

                $response['transportation_vehicle_type']                = $movingCompaniesArray->transportation_vehicle_type;
                
                $response['moving_date']                                = date('m-d-Y', strtotime( $movingCompaniesArray->moving_date ) );
                $response['additional_information']                     = $movingCompaniesArray->additional_information;

                // Get the moving from address
                $clientMovingFromAddress = DB::table('moving_item_service_requests as t1')
                    					->join('agent_client_moving_from_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                    					->join('cities as t4', 't2.city_id', '=', 't4.id')
                    					->join('countries as t5', 't2.country_id', '=', 't5.id')
                    					->where(['t1.id' => $movingCompanyId, 't1.status' => '1'])
                    					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country')
                    					->first();

                // Get the moving to address
                $clientMovingToAddress = DB::table('moving_item_service_requests as t1')
                    					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
                    					->join('cities as t4', 't2.city_id', '=', 't4.id')
                    					->join('countries as t5', 't2.country_id', '=', 't5.id')
                    					->where(['t1.id' => $movingCompanyId, 't1.status' => '1'])
                    					->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country', 't3.pst', 't3.gst', 't3.hst', 't3.service_charge')
                    					->first();

                $response['pst'] 			= round($clientMovingToAddress->pst, 2) . '%';
                $response['gst'] 			= round($clientMovingToAddress->gst, 2) . '%';
                $response['hst'] 			= round($clientMovingToAddress->hst, 2) . '%';
                $response['service_charge']	= round($clientMovingToAddress->service_charge, 2) . '%';

                $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

    	        $response['moving_to_address'] 	= $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

    	        $html = '';
    	        // Get the Other Places to install appliances in
    	        $itemDetails = DB::table('moving_item_detail_service_requests as t1')
        					->join('moving_item_details as t2', 't1.moving_items_details_id', '=', 't2.id')
        					->where(['t1.moving_items_service_id' => $movingCompanyId])
        					->select('t1.id as service_request_id', 't2.id as service_id', 't2.item_name', 't2.item_weight')
        					->get();

    	        if( count( $itemDetails ) > 0 )
    	        {
    	        	foreach( $itemDetails as $itemDetail )
    	        	{
    	        		$html .= '<tr>';

    	        		$html .= '<td>Detail job description</td>';
    	        		$html .= '<td>'. ucwords( strtolower( $itemDetail->item_name ) ) .'</td>';
    	        		$html .= '<td>'. $itemDetail->item_weight .'</td>';
    	        		$html .= '<td><input name="detail_job_time_estimate['. $itemDetail->service_id .']" class="detail_job_time_estimate form-control" style="width: 100px;"></td>';
    	        		$html .= '<td><input name="detail_job_budget_estimate['. $itemDetail->service_id .']" class="detail_job_budget_estimate form-control moving_service_amount" style="width: 100px;"></td>';

    	        		$html .= '</tr>';
    	        	}
    	        }

    	        if( $movingCompaniesArray['transportation_vehicle_type'] != '' && !is_null( $movingCompaniesArray['transportation_vehicle_type'] ) )
    	        {
	    	        // Get the moving transportations
	    	        $movingTransportations = MovingTransportation::get();

	    	        if( count( $movingTransportations ) > 0 )
	    	        {
	    	        	foreach( $movingTransportations as $movingTransportation )
	    	        	{
	    	        		$html .= '<tr>';

	    	        		$html .= '<td>'. $movingTransportation->transportation_type .'</td>';
	    	        		$html .= '<td>'. ucwords( strtolower( $response['transportation_vehicle_type'] ) ) .'</td>';
	    	        		$html .= '<td>NA</td>';
	    	        		$html .= '<td><input name="transportation_vehicle_time_estimate['. $movingTransportation->id .']" class="transportation_vehicle_type form-control" style="width: 100px;"></td>';
	    	        		$html .= '<td><input name="transportation_vehicle_budget_estimate['. $movingTransportation->id .']" class="transportation_vehicle_budget_estimate form-control moving_service_amount" style="width: 100px;"></td>';

	    	        		$html .= '</tr>';
	    	        	}
	    	        }
    	        }

    	        $response['request_services_details'] = $html;

    	        // Get the list of other related things
    	        $otherDetailHtml = '';
    	        // List of other details
    	        $otherDetails = DB::table('moving_other_item_services as t1')->select('id', 'other_moving_items_services_details')->get();

        		if( count( $otherDetails ) > 0 )
    	        {
    	        	foreach( $otherDetails as $otherDetail )
    	        	{
    	        		$status = 'No';
    	        		$selectedService = DB::table('moving_other_item_service_requests as t1')
				        					->leftJoin('moving_other_item_services as t2', 't1.moving_items_service_id', '=', 't2.id')
				        					->where(['t1.moving_items_service_id' => $movingCompanyId, 'other_moving_items_services_id' => $otherDetail->id])
				        					->select('t1.id as service_request_id', 't2.id as service_id', 't2.other_moving_items_services_details')
					        				->first();

				        if( count( $selectedService ) > 0 )
				        {
				        	$status = 'Yes';
				        }

    	        		$otherDetailHtml .= '<tr>';

    	        		$otherDetailHtml .= '<td>'. ucwords( strtolower( $otherDetail->other_moving_items_services_details ) ) .'</td>';
    	        		$otherDetailHtml .= '<td>'. $status .'</td>';

    	        		$otherDetailHtml .= '</tr>';
    	        	}
    	        }

    	        $response['request_other_details'] = $otherDetailHtml;

    	        // Get the latitude, longitude of the mover from the Google Map API
    	        $clientMovingFromAddressCoordinates = array();
    	        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingFromAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
    	        $mapApiResponse = json_decode(file_get_contents($url), true);
    	        if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
    	        {
    	        	$clientMovingFromAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
    	        }

    	        $clientMovingToAddressCoordinates = array();
    	        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
    	        $mapApiResponse = json_decode(file_get_contents($url), true);
    	        if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
    	        {
    	        	$clientMovingToAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
    	        }

    	        // Calculate the distance between the two address
    	        $distance = Helper::distance($clientMovingToAddressCoordinates['lat'], $clientMovingToAddressCoordinates['lng'], $clientMovingFromAddressCoordinates['lat'], $clientMovingFromAddressCoordinates['lng'], "K");

    	        $response['distance'] = round($distance, 2) . 'KM';
            }
        }
        return response()->json($response);
    }


    /**
     * Function to update company social details
     * @param void
     * @return array
     */
    public function updateCompanySocialDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $companyData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		// Get the logged in user details
		$user = User::find($userId);

		// Get the company associated with the user
		$userCompany = $user->company->first();

		if( count( $userCompany ) > 0 )
		{
			// Update the details
			$company = Company::find( $userCompany->id );

			$company->facebook 		= $companyData['company_facebook'];
			$company->google_plus 	= $companyData['company_google_plus'];
			$company->instagram 	= $companyData['company_instagram'];
			$company->linkedin 		= $companyData['company_linkedin'];
			$company->skype 		= $companyData['company_skype'];
			$company->twitter		= $companyData['company_twitter'];
			$company->updated_by	= $userId;

			if( $company->save() )
			{
				$response['errCode']    = 0;
	        	$response['errMsg']     = 'Social networking details updated successfully';
			}
			else
			{
				$response['errCode']    = 2;
		        $response['errMsg']     = 'Some error in updating the social networking details';
			}
		}
		else
		{
			$response['errCode']    = 4;
	        $response['errMsg']     = 'Invalid company';
		}

		return response()->json($response);
    }

    /**
     * Function to update company additional details
     * @param void
     * @return array
     */
    public function updateCompanyAdditionalDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $companyData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		// Get the logged in user details
		$user = User::find($userId);

		// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'industry_type'	=> $companyData['company_industry_type']
		    ),
		    array(
		        'industry_type' => array('required')
		    ),
		    array(
		        'industry_type.required' => 'Please select industry type'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check whether atleast one service is selected or not
			if( isset( $companyData['company_services'] ) && count( $companyData['company_services'] ) != 0 )
			{
				// Check whether target area or working on multiple selection value is available or not
				if( isset( $companyData['company_target_global'] ) || $companyData['company_target_area'] != '' )
				{
					// Get the company associated with the user
					$userCompany = $user->company->first();

					if( count( $userCompany ) > 0 )
					{
						// Update the details
						$company = Company::find( $userCompany->id );

						$company->company_category_id 	= $companyData['company_industry_type'];

						if( isset( $companyData['company_target_area'] ) )
						{
							$company->target_area = $companyData['company_target_area'];
						}
						else
						{
							$company->target_area = null;	
						}


						if( isset( $companyData['company_target_global'] ) )
						{
							$company->working_globally = $companyData['company_target_global'];
						}
						else
						{
							$company->working_globally = '0';
						}

						if( isset( $companyData['company_availability_mode'] ) )
						{
							$company->availability_mode = $companyData['company_availability_mode'];
						}
						else
						{
							$company->availability_mode = '0';
						}

						$company->updated_by = $userId;

						if( $company->save() )
						{
							// Update the services provided by the company
							$userCompany->services()->sync($companyData['company_services']);

							$response['errCode']    = 0;
				        	$response['errMsg']     = 'Company Additional details updated successfully';
						}
						else
						{
							$response['errCode']    = 2;
					        $response['errMsg']     = 'Some error in updating the company additional details';
						}
					}
					else
					{
						$response['errCode']    = 4;
				        $response['errMsg']     = 'Invalid company';
					}
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Please provide target area';
				}
			}
			else
			{
				$response['errCode']    = 3;
		        $response['errMsg']     = 'Please select atleast one service';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to fetch the services as per the selected category
     * @param void
     * @return array
     */
    public function getCompanyCategoryServices()
    {
    	$industryTypeId = Input::get('industryTypeId');

    	$response = '';
    	if( $industryTypeId != '' )
    	{
    		$companyCategoryServices = CategoryService::where(['status' => '1', 'company_category_id' => $industryTypeId])->select('id', 'service')->orderBy('service', 'asc')->get();

    		if( count( $companyCategoryServices ) > 0 )
    		{
    			foreach ($companyCategoryServices as $categoryServices)
    			{
    				$response .= '<option value="'. $categoryServices->id .'">'. $categoryServices->service .'</option>';
    			}
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to update company image
     * @param void
     * @return array
     */
    public function updateCompanyImage(Request $request)
    {
    	$companyImage = $request->file('fileData');
    	
        // Get the logged in user id
        $userId = Auth::user()->id;

        // Get the company details associated with the user
        $user = User::find($userId);
        $companyDetails = $user->company->first();

        $validation = Validator::make(
		    array(
		        'companyImage' => $companyImage
		    ),
		    array(
		        'companyImage' => array('required')
		    ),
		    array(
		        'companyImage.required' => 'Please select image to upload'
		    )
		);

        $response = array();
		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Image destination folder
			$destinationPath = storage_path() . '/uploads/company';

			if( $companyImage->isValid() )  // If the file is valid or not
			{
			    $fileExt  = $companyImage->getClientOriginalExtension();
			    $fileType = $companyImage->getMimeType();
			    $fileSize = $companyImage->getSize();

			    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
			    {
			        // Rename the file
			        $fileNewName = str_random(10) . '.' . $fileExt;

			        if( $companyImage->move( $destinationPath, $fileNewName ) )
			        {
			        	// Update the image entry in table
			        	$company = Company::find($companyDetails->id);

			        	$company->image = $fileNewName;
			        	$company->updated_by = $userId;

			        	if( $company->save() )
			        	{
			        		$response['errCode']    = 0;
		        			$response['errMsg']     = 'Image uploaded successfully';
		        			$response['imgPath']    = url('/images/company/' . $fileNewName);
			        	}
			        	else
			        	{
			        		$response['errCode']    = 2;
		                	$response['errMsg']     = 'Some error in image upload';
			        	}
			        }
		        	else
		        	{
		        		$response['errCode']    = 3;
		                $response['errMsg']     = 'Some error in image upload';
		        	}
			    }
		    	else
		    	{
		    		$response['errCode']    = 4;
		            $response['errMsg']     = 'Only image file with size less then 3MB is allowed';
		    	}
			}
			else
			{
				$response['errCode']    = 5;
		        $response['errMsg']     = 'Invalid file';
			}
		}

		return response()->json($response);
    }












    /**
     * Function to return the company categories view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function companyCategories()
    {
    	return view('administrator/companyCategories');
    }

    /**
     * Function to return the company categories view
     * @param void
     * @return array
     */
    public function saveCompanyCategory()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $categoryData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'category_name'		=> $categoryData['category_name'],
		        'category_status'	=> $categoryData['category_status'],
		    ),
		    array(
		        'category_name' 	=> array('required'),
		        'category_status' 	=> array('required'),
		    ),
		    array(
		        'category_name.required' 	=> 'Please enter category name',
		        'category_status.required' 	=> 'Please select status',
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check if category id is available or not. If not available, insert it, othewise update it
			if( $categoryData['category_id'] == '' )	// Add the company category
			{
				$companyCategory = new CompanyCategory;

				$companyCategory->category 	= $categoryData['category_name'];
				$companyCategory->status 	= $categoryData['category_status'];
				$companyCategory->created_by= $userId;

				if( $companyCategory->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Company category added successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in adding company category';
				}

			}
			else 											// Update the company category
			{
				$companyCategory = CompanyCategory::find($categoryData['category_id']);

				$companyCategory->category 	= $categoryData['category_name'];
				$companyCategory->status 	= $categoryData['category_status'];
				$companyCategory->updated_by= $userId;

				if( $companyCategory->save() )
				{
					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Company category updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
		        	$response['errMsg']     = 'Some error in updating company category';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to show show the company categories list in datatable
     * @param void
     * @return array
     */
    public function fetchCompanyCategories()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'category',
            2 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $categories = CompanyCategory::where('category','like', '%'.$sSearch.'%')
                    ->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->select('id', 'category', 'status')
                    ->get();

        $iTotal = CompanyCategory::where('category','like', '%'.$sSearch.'%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $categories ) > 0 )
        {
            foreach ($categories as $category)
            {
            	$response['aaData'][$k] = array(
                    0 => $category->id,
                    1 => ucwords( strtolower( $category->category ) ),
                    2 => Helper::getStatusText($category->status),
                    3 => '<a href="javascript:void(0);" id="'. $category->id .'" class="edit_company_category"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function get the details of the selected company category
     * @param void
     * @return array
     */
    public function getCompanyCategoryDetails()
    {
    	$categoryId = Input::get('categoryId');

    	$response = array();
    	if( $categoryId != '' )
    	{
    		$categoryDetails = CompanyCategory::find($categoryId);

    		if( count( $categoryDetails ) > 0 )
    		{
	    		$response['id'] 		= $categoryDetails->id;
    			$response['category'] 	= $categoryDetails->category;
    			$response['status'] 	= $categoryDetails->status;
    		}
    	}

    	return response()->json($response); 
    }

    /**
     * Function to return the company listing view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function companies()
    {
    	// Get company categories
    	$companyCategories = CompanyCategory::where(['status' => '1'])->select('id', 'category')->orderBy('category', 'asc')->get();

    	// Get province list
    	$provinces 	= Province::where(['status' => '1'])->orderBy('name', 'asc')->select('id', 'abbreviation', 'name')->get();

    	// Get cities list
    	$cities 	= City::where(['status' => '1'])->orderBy('name', 'asc')->select('id', 'name')->get();

    	// Get country list
    	$countries 	= Country::orderBy('name', 'asc')->select('id', 'name')->get();

    	return view('administrator/companies', ['provinces' => $provinces, 'cities' => $cities, 'countries' => $countries, 'companyCategories' => $companyCategories]);
    }

    /**
     * Function to save the company details
     * @param void
     * @return array
     */
    public function saveCompanyDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $companyDetails);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'rep_fname'			=> $companyDetails['representative_fname'],
		        'rep_email'			=> $companyDetails['representative_email'],
		        'rep_password'		=> $companyDetails['representative_password'],
		        'company_name'		=> $companyDetails['company_name'],
		        'company_category'	=> $companyDetails['company_category'],
		        'company_address'	=> $companyDetails['company_address1'],
		        'company_province'	=> $companyDetails['company_province'],
		        'company_city'		=> $companyDetails['company_city'],
		        'company_country'	=> $companyDetails['company_country'],
		        'postal_code'		=> $companyDetails['company_postalcode'],
		        'company_status'	=> $companyDetails['company_status'],
		    ),
		    array(
		        'rep_fname'			=> array('required'),
		        'rep_email'			=> array('required', 'email'),
		        'rep_password'		=> array('required', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$%^&]).*$/'),
		        'company_name'		=> array('required'),
		        'company_category'	=> array('required'),
		        'company_address'	=> array('required'),
		        'company_province'	=> array('required'),
		        'company_city'		=> array('required'),
		        'company_country'	=> array('required'),
		        'postal_code'		=> array('required'),
		        'company_status'	=> array('required')
		    ),
		    array(
		        'rep_fname.required' 		=> 'Please enter representative first name',
		        'rep_email.required' 		=> 'Please enter representative email',
		        'rep_email.email' 			=> 'Please enter valid representative email',
		        'rep_password.required' 	=> 'Please enter password',
		        'rep_password.min' 			=> 'Password must contain atleat 6 characters',
		        'rep_password.regex' 		=> 'Password must contain a lower case, upper case, a number, and a special symbol in it',
		        'company_name.required' 	=> 'Please enter company name',
		        'company_category.required' => 'Please select company category',
		        'company_address.required' 	=> 'Please enter company address',
		        'company_province.required' => 'Please select province',
		        'company_city.required' 	=> 'Please select city',
		        'company_country.required' 	=> 'Please select country',
		        'postal_code.required' 		=> 'Please enter postal code',
		        'company_status.required' 	=> 'Please select status',
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check if company already exist, otherwise add it. 
			$company = Company::where(['company_name' => $companyDetails['company_name']])->select('id')->get();

			if( count( $company ) == 0 )
			{
				// Step I: Add the user
				// Step II: Add the role_user to sales representative
				// Step III: Add the company
				// Step IV: map the user to company

				// Begin transaction
				DB::beginTransaction();

				// Add the user
				$user = new User;

				$user->email 		= $companyDetails['representative_email'];
				$user->fname 		= $companyDetails['representative_fname'];
				$user->lname 		= $companyDetails['representative_lname'];
				$user->password 	= Hash::make($companyDetails['representative_password']);
				$user->status 		= '1';
				$user->created_by 	= $userId;

				if( $user->save() )
				{
					// Add the role user
					$user->attachRole(2);	// 2: company representative

					// Add the company
					$company = new Company;

					$company->company_name 			= $companyDetails['company_name'];	
					$company->company_category_id 	= $companyDetails['company_category'];
					$company->address1	 			= $companyDetails['company_address1'];
					$company->address2	 			= $companyDetails['company_address2'];
					$company->province_id 			= $companyDetails['company_province'];
					$company->city_id 				= $companyDetails['company_city'];
					$company->country_id 			= $companyDetails['company_country'];
					$company->postal_code 			= $companyDetails['company_postalcode'];
					$company->status 				= $companyDetails['company_status'];
					$company->created_by 			= $userId;

					if( $company->save() )
					{
						// Map the user to company
						$user->company()->attach($company->id);

						DB::commit();

						$response['errCode']    = 0;
				        $response['errMsg']     = 'Company added successfully';
					}
					else
					{
						DB::rollBack();

						$response['errCode']    = 3;
		        		$response['errMsg']     = 'Some error in adding the company';
					}
				}
				else
				{
					DB::rollBack();

					$response['errCode']    = 3;
		        	$response['errMsg']     = 'Some error in adding the company';
				}
			}
			else
			{
				$response['errCode']    = 2;
		        $response['errMsg']     = 'Company with the same name already exist';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to update the company details
     * @param void
     * @return array
     */
    public function updateCompanyDetails(Request $request)
    {

    	$companyImage   		= $request->file('fileData');
    	$representative_fname   = $request->input('representative_fname');
    	$representative_lname   = $request->input('representative_lname');
    	$representative_email   = $request->input('representative_email');
    	$company_name  			= $request->input('company_name');
    	$company_id    			= $request->input('company_id');
    	$company_category    	= $request->input('company_category');
    	$company_address1    	= $request->input('company_address1');
    	$company_address2    	= $request->input('company_address2');
    	$company_province    	= $request->input('company_province');
    	$company_city    		= $request->input('company_city');
    	$company_country    	= $request->input('company_country');
    	$postal_code    		= $request->input('postal_code');
    	$company_status    		= $request->input('company_status');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'rep_fname'			=> $representative_fname,
		        'rep_email'			=> $representative_email,
		        'company_name'		=> $company_name,
		        'company_category'	=> $company_category,
		        'company_address'	=> $company_address1,
		        'company_province'	=> $company_province,
		        'company_city'		=> $company_city,
		        'company_country'	=> $company_country,
		        'postal_code'		=> $postal_code,
		        'company_status'	=> $company_status,
		    ),
		    array(
		        'rep_fname'			=> array('required'),
		        'rep_email'			=> array('required', 'email'),
		        'company_name'		=> array('required'),
		        'company_category'	=> array('required'),
		        'company_address'	=> array('required'),
		        'company_province'	=> array('required'),
		        'company_city'		=> array('required'),
		        'company_country'	=> array('required'),
		        'postal_code'		=> array('required'),
		        'company_status'	=> array('required')
		    ),
		    array(
		        'rep_fname.required' 		=> 'Please enter representative first name',
		        'rep_email.required' 		=> 'Please enter representative email',
		        'rep_email.email' 			=> 'Please enter valid representative email',
		        'company_name.required' 	=> 'Please enter company name',
		        'company_category.required' => 'Please select company category',
		        'company_address.required' 	=> 'Please enter company address',
		        'company_province.required' => 'Please select province',
		        'company_city.required' 	=> 'Please select city',
		        'company_country.required' 	=> 'Please select country',
		        'postal_code.required' 		=> 'Please enter postal code',
		        'company_status.required' 	=> 'Please select status',
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			if(!is_null($companyImage) && ($companyImage->getSize() > 0))
			{

				// Image destination folder
				$destinationPath = storage_path() . '/uploads/company';
				if( $companyImage->isValid() )  // If the file is valid or not
				{
				    $fileExt  = $companyImage->getClientOriginalExtension();
				    $fileType = $companyImage->getMimeType();
				    $fileSize = $companyImage->getSize();

				    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
				    {
				        // Rename the file
				        $fileNewName = str_random(30) . '.' . $fileExt;

				        if( $companyImage->move( $destinationPath, $fileNewName ) )
				        {
				        	$response['errCode']    = 1;
				        }
			        	else
			        	{
			        		$response['errCode']    = 3;
			                $response['errMsg']     = 'Some error in image upload';
			        	}
				    }
			    	else
			    	{
			    		$response['errCode']    = 4;
			            $response['errMsg']     = 'Only image file with size less then 3MB is allowed';
			    	}
				}
				else
				{
					$response['errCode']    = 5;
			        $response['errMsg']     = 'Invalid file';
				}
			} else {
				$response['errCode']    = 2;
			}

			if($response['errCode'] == 1 || $response['errCode'] == 2)
			{
				$company = Company::find($company_id);

				$company->company_name 			= $company_name;	
				$company->company_category_id 	= $company_category;
				$company->address1 				= $company_address1;
				$company->address2 				= $company_address2;
				$company->province_id 			= $company_province;
				$company->city_id 				= $company_city;
				$company->city_id 				= $company_country;
				$company->postal_code 			= $postal_code;
				$company->status 				= $company_status;
				$company->updated_by 			= $userId;
				if($response['errCode'] == 1)
				{
					$company->image 			= $fileNewName;
					$response['image']  		= URL::to('/').'/images/company/'.$fileNewName;
				}

				if( $company->save() )
				{
					$userDetails = DB::table('users as t1')
							            ->join('company_user as t2', 't1.id', '=', 't2.user_id')
							            ->join('role_user as t3', 't3.user_id', '=', 't1.id')
							            ->select('t1.id')
							            ->where('t3.role_id', '2')
							            ->first();

					$user = User::find($userDetails->id);

					$user->email 		= $representative_email;
					$user->fname 		= $representative_fname;
					$user->lname 		= $representative_lname;
					$user->updated_by 	= $userId;

					if( $user->save() )
					{
						$response['errCode']    = 0;
				        $response['errMsg']     = 'Company details updated successfully';

					} else {

						$response['errCode']    = 3;
	        			$response['errMsg']     = 'Some error in updating the company details';
					}
				} else {

					$response['errCode']    = 3;
	        		$response['errMsg']     = 'Some error in updating the company details';
				}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to fetch the companies list and show in datatable
     * @param void
     * @return array
     */
    public function fetchCompanies()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 't1.id',
            1 => 't1.company_name',
            9 => 't1.status'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        $companies 	= DB::select(
                        DB::raw(
                        	"SELECT t1.id, t1.company_name, t1.address1, t1.postal_code, t1.status, t3.email, t3.fname, CONCAT_WS(' ', t3.fname, t3.lname) AS rep_name, 
							t5.category,
							t6.name AS province, t7.name AS city 
							FROM companies AS t1 
							LEFT JOIN company_user AS t2 ON t1.id = t2.company_id 
							LEFT JOIN users AS t3 ON t2.user_id = t3.id 
							LEFT JOIN role_user AS t4 on t4.user_id = t3.id 
							LEFT JOIN company_categories AS t5 ON t1.company_category_id = t5.id 
							LEFT JOIN provinces AS t6 ON t1.province_id = t6.id 
							LEFT JOIN cities AS t7 ON t1.city_id = t7.id 
							WHERE t4.role_id = 2 AND t1.company_name LIKE ('%". $sSearch ."%')
                        	ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length
                        )
                    );

        $companiesCount = DB::select(
                            DB::raw("
                            SELECT t1.id
							FROM companies AS t1 
							LEFT JOIN company_user AS t2 ON t1.id = t2.company_id 
							LEFT JOIN users AS t3 ON t2.user_id = t3.id 
							LEFT JOIN role_user AS t4 on t4.user_id = t3.id 
							LEFT JOIN company_categories AS t5 ON t1.company_category_id = t5.id 
							LEFT JOIN provinces AS t6 ON t1.province_id = t6.id 
							LEFT JOIN cities AS t7 ON t1.city_id = t7.id 
							WHERE t4.role_id = 2 AND t1.company_name LIKE ('%". $sSearch ."%')")
                        );

   	    // Assign it to the datatable pagination variable
   	    $iTotal = count($companiesCount);

   	    $response = array(
   	        'iTotalRecords' => $iTotal,
   	        'iTotalDisplayRecords' => $iTotal,
   	        'aaData' => array()
   	    );

   	    $k=0;
   	    if ( count( $companies ) > 0 )
   	    {
   	        foreach ($companies as $company)
   	        {
   	            $response['aaData'][$k] = array(
   	                0 => $company->id,
   	                1 => ucwords( strtolower( $company->company_name ) ),
   	                2 => ucwords( strtolower( $company->category ) ),
   	                3 => ucfirst( strtolower( $company->address1 ) ),
   	                4 => ucfirst( strtolower( $company->province ) ),
   	                5 => ucfirst( strtolower( $company->city ) ),
   	                6 => $company->postal_code,
   	                7 => ucwords( strtolower( $company->rep_name ) ),
   	                8 => $company->email,
   	                9 => Helper::getStatusText($company->status),
   	                10 => '<a href="javascript:void(0);" id="'. $company->id .'" class="edit_company"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
   	            );
   	            $k++;
   	        }
   	    }

   		return response()->json($response);
    }

    /**
     * Function to get the details of the selected company
     * @param void
     * @return array
     */
    public function getCompanyDetails()
    {
		$companyId = Input::get('companyId');

		$response = array();
		if( $companyId != '' )
		{
			// Get the company details
			$companyDetails = Company::find($companyId);

			if( count( $companyDetails ) > 0 )
			{
	    		$response['id'] 				= $companyDetails->id;
	    		$response['company_name'] 		= $companyDetails->company_name;
	    		$response['company_category_id']= $companyDetails->company_category_id;
	    		$response['address1'] 			= $companyDetails->address1;
	    		$response['address2'] 			= $companyDetails->address2;
	    		$response['province_id'] 		= $companyDetails->province_id;
	    		$response['city_id'] 			= $companyDetails->city_id;
	    		$response['country_id'] 		= $companyDetails->country_id;
	    		$response['postal_code'] 		= $companyDetails->postal_code;
	    		$response['status'] 			= $companyDetails->status;

	    		if( $companyDetails->image != '' ) {
					$response['image'] = url('/images/agents/'.$companyDetails->image);
				} else {
					$response['image'] = url('/images/no_image.jpg');
				}

	    		// Get the company representative details
	    		// $companyRepDetails = User::find($companyDetails->user_id);

	    		$companyRepDetails = DB::table('users as t1')
						            ->join('company_user as t2', 't1.id', '=', 't2.user_id')
						            ->join('role_user as t3', 't3.user_id', '=', 't1.id')
						            ->select('t1.id', 't1.email', 't1.fname', 't1.lname')
						            ->where('t3.role_id', '2')
						            ->first();

				if( count( $companyRepDetails ) > 0 )
	    		{
	    			$response['email'] = $companyRepDetails->email;
	    			$response['fname'] = $companyRepDetails->fname;
	    			$response['lname'] = $companyRepDetails->lname;
	    		}

	    		// Get the cities list for the selected province as the city list is filtered to the selected province by using the ajax
	    		$cities = City::where(['province_id' => $companyDetails->province_id])->get();

	    		if( count( $cities ) > 0 )
	    		{
	    			foreach ($cities as $city)
	    			{
		    			$response['cities'][] = array(
		    				'id' 	=> $city->id,
		    				'city' 	=> ucwords( strtolower( $city->name ) ),
		    			);
	    			}
	    		}
			}
		}

		return response()->json($response);
    }

    /**
     * Function to update company image
     * @param void
     * @return array
     */
    /*public function updateCompanyImage(Request $request)
    {
    	$companyImage = $request->file('fileData');
    	$companyId = $request->input('companyId');
    	
        // Get the logged in user id
        $userId = Auth::user()->id;

        $validation = Validator::make(
		    array(
		        'companyImage' => $companyImage
		    ),
		    array(
		        'companyImage' => array('required')
		    ),
		    array(
		        'companyImage.required' => 'Please select image to upload'
		    )
		);

        $response = array();
		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Image destination folder
			$destinationPath = storage_path() . '/uploads/company';

			if( $companyImage->isValid() )  // If the file is valid or not
			{
			    $fileExt  = $companyImage->getClientOriginalExtension();
			    $fileType = $companyImage->getMimeType();
			    $fileSize = $companyImage->getSize();

			    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
			    {
			        // Rename the file
			        $fileNewName = str_random(10) . '.' . $fileExt;

			        if( $companyImage->move( $destinationPath, $fileNewName ) )
			        {
			        	// Update the image entry in table
			        	$company = Company::find($companyId);

			        	$company->image = $fileNewName;
			        	$company->updated_by = $userId;

			        	if( $user->save() )
			        	{
			        		$response['errCode']    = 0;
		        			$response['errMsg']     = 'Image uploaded successfully';
		        			$response['imgPath']    = url('/images/company/' . $fileNewName);
			        	}
			        	else
			        	{
			        		$response['errCode']    = 2;
		                	$response['errMsg']     = 'Some error in image upload';
			        	}
			        }
		        	else
		        	{
		        		$response['errCode']    = 3;
		                $response['errMsg']     = 'Some error in image upload';
		        	}
			    }
		    	else
		    	{
		    		$response['errCode']    = 4;
		            $response['errMsg']     = 'Only image file with size less then 3MB is allowed';
		    	}
			}
			else
			{
				$response['errCode']    = 5;
		        $response['errMsg']     = 'Invalid file';
			}
		}

		return response()->json($response);
    }*/
    
    /**
     * Function to return the company agent view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function agents()
    {
    	// Get company list
    	$companies = Company::where(['status' => '1'])->select('id', 'company_name')->orderBy('company_name', 'asc')->get();

    	// Get province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'name', 'abbreviation')->orderBy('name', 'asc')->get();

    	// Get cities list
    	$cities = City::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

    	// Get the countries
    	$countries = Country::get();

    	// echo '<pre>';
    	// print_r( $countries->toArray() );
    	// exit;

    	return view('administrator/agents', ['companies' => $companies, 'provinces' => $provinces, 'cities' => $cities, 'countries' => $countries]);
    }

    /**
     * Function to save the agent details
     * @param void
     * @return array
     */
    public function saveAgent()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $agentData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'agent_company'		=> $agentData['agent_company'],
		        'agent_fname'		=> $agentData['agent_fname'],
		        'agent_lname'		=> $agentData['agent_lname'],
		        'agent_email'		=> $agentData['agent_email'],
		        'agent_password'	=> $agentData['agent_password'],
		        'agent_address1'	=> $agentData['agent_address1'],
		        'agent_province'	=> $agentData['agent_province'],
		        'agent_city'		=> $agentData['agent_city'],
		        'agent_postalcode'	=> $agentData['agent_postalcode'],
		        'agent_status'		=> $agentData['agent_status']
		    ),
		    array(
		        'agent_company' 	=> array('required'),
		        'agent_fname' 		=> array('required'),
		        'agent_lname' 		=> array('required'),
		        'agent_email' 		=> array('required', 'email'),
		        'agent_password'	=> array('required', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$%^&]).*$/'),
		        'agent_address1'	=> array('required'),
		        'agent_province'	=> array('required'),
		        'agent_city' 		=> array('required'),
		        'agent_postalcode' 	=> array('required'),
		        'agent_status' 		=> array('required')
		    ),
		    array(
		        'agent_company.required'	=> 'Please select company',
		        'agent_fname.required' 		=> 'Please enter first name',
		        'agent_lname.required' 		=> 'Please enter last name',
		        'agent_email.required' 		=> 'Please enter email',
		        'agent_email.email' 		=> 'Please enter valid email',
		        'agent_password.required' 	=> 'Please enter password',
		        'agent_password.min' 		=> 'Password must contain atleat 6 characters',
		        'agent_password.regex' 		=> 'Password must contain a lower case, upper case, a number, and a special symbol in it',
		        'agent_address1.required' 	=> 'Please enter address',
		        'agent_province.required' 	=> 'Please select province',
		        'agent_city.required' 		=> 'Please select city',
		        'agent_postalcode.required'	=> 'Please enter postal code',
		        'agent_status.required' 	=> 'Please select status'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Check if the agent already exist
			$agent = User::where(['fname' => $agentData['agent_fname'], 'lname' => $agentData['agent_lname']])->get();

			if( count( $agent ) == 0 )
			{
				// Add the agent as a user
				$user = new User;

				DB::beginTransaction();

				$user->email 		= $agentData['agent_email'];				
				$user->password 	= Hash::make($agentData['agent_password']);
				$user->fname 		= $agentData['agent_fname'];
				$user->lname 		= $agentData['agent_lname'];
				$user->address1 	= $agentData['agent_address1'];
				$user->address2 	= $agentData['agent_address2'];
				$user->province_id 	= $agentData['agent_province'];
				$user->city_id 		= $agentData['agent_city'];
				$user->postalcode 	= $agentData['agent_postalcode'];
				$user->country_id 	= $agentData['agent_country'];
				$user->status 		= $agentData['agent_status'];
				$user->created_by 	= $userId;

				if( $user->save() )
				{
					// Map the user to role
					$user->attachRole(3);	// 3: agent

					// Map the user to company
					$user->company()->attach($agentData['agent_company']);

					DB::commit();

					$response['errCode']    = 0;
		        	$response['errMsg']     = 'Agent added successfully';
		        	
				}
				else
				{
					DB::rollBack();

					$response['errCode']    = 3;
		        	$response['errMsg']     = 'Some error in adding agent';
				}
			}
			else
			{
				$response['errCode']    = 2;
		        $response['errMsg']     = 'Agent with the same name already exist';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to fetch the agent list and show in datatable
     * @param void
     * @return array
     */
    public function fetchAgents()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 't1.id',
            1 => 't1.id',
            2 => 't1.id',
            8 => 't1.status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        $agents 	= DB::select(
                        DB::raw(
                        	"SELECT t1.id, t1.email, CONCAT_WS(' ', t1.fname, t1.lname) AS agent_name, t1.address1, t1.postalcode, t1.status, 
                        	t3.name as province, t4.name as city, t6.company_name
							FROM users AS t1 
							LEFT JOIN role_user AS t2 ON t1.id = t2.user_id 
							LEFT JOIN provinces AS t3 ON t1.province_id = t3.id 
							LEFT JOIN cities AS t4 ON t1.city_id = t4.id 
							LEFT JOIN company_user AS t5 ON t5.user_id = t1.id
							LEFT JOIN companies AS t6 ON t5.company_id = t6.id
							WHERE t2.role_id = '3' 
                        	and t1.fname LIKE ('%". $sSearch ."%')
                        	ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length
                        )
                    );

        $agentsCount = DB::select(
                            DB::raw("
	                        SELECT t1.id
							FROM users AS t1 
							LEFT JOIN role_user AS t2 ON t1.id = t2.user_id 
							LEFT JOIN provinces AS t3 ON t1.province_id = t3.id 
							LEFT JOIN cities AS t4 ON t1.city_id = t4.id 
							LEFT JOIN company_user AS t5 ON t5.user_id = t1.id
							LEFT JOIN companies AS t6 ON t5.company_id = t6.id
							WHERE t2.role_id = '3' 
                        	and t1.fname LIKE ('%". $sSearch ."%')
                            ")
                        );

   	    // Assign it to the datatable pagination variable
   	    $iTotal = count($agentsCount);

   	    $response = array(
   	        'iTotalRecords' => $iTotal,
   	        'iTotalDisplayRecords' => $iTotal,
   	        'aaData' => array()
   	    );

   	    $k=0;
   	    if ( count( $agents ) > 0 )
   	    {
   	        foreach ($agents as $agent)
   	        {
   	            $response['aaData'][$k] = array(
   	                0 => $agent->id,
   	                1 => ucwords( strtolower( $agent->company_name ) ),
   	                2 => ucwords( strtolower( $agent->agent_name ) ),
   	                3 => $agent->email,
   	                4 => $agent->address1,
   	                5 => ucwords( strtolower( $agent->province) ),
   	                6 => ucwords( strtolower( $agent->city ) ),
   	                7 => $agent->postalcode,
   	                8 => Helper::getStatusText($agent->status),
   	                9 => '<a href="javascript:void(0);" id="'. $agent->id .'" class="edit_agent"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
   	            );
   	            $k++;
   	        }
   	    }

   		return response()->json($response);
    }

    /**
     * Function to get the agent details
     * @param void
     * @return array
     */
    public function getAgentDetails()
    {
		$agentId = Input::get('agentId');

		$response = array();
		if( $agentId != '' )
		{
			$agentDetails = User::find($agentId);

			$agentCompanyDetails = $agentDetails->company;

	        $response = array(
	        	'id' 			=> $agentDetails->id,
	        	'email' 		=> $agentDetails->email,
	        	'fname' 		=> $agentDetails->fname,
	        	'lname' 		=> $agentDetails->lname,
	        	'address1' 		=> $agentDetails->address1,
	        	'address2' 		=> $agentDetails->address2,
	        	'province_id' 	=> $agentDetails->province_id,
	        	'city_id' 		=> $agentDetails->city_id,
	        	'postalcode' 	=> $agentDetails->postalcode,
	        	'country_id' 	=> $agentDetails->country_id,
	        	'company_id' 	=> $agentCompanyDetails[0]->id,
	        	'status' 		=> $agentDetails->status,
	        );

	        // Get the cities list for the selected province as the city list is filtered to the selected province by using the ajax
    		$cities = City::where(['province_id' => $agentDetails->province_id])->get();

    		if( count( $cities ) > 0 )
    		{
    			$html = '';
    			foreach ($cities as $city)
    			{
	    			$html .= '<option value="'. $city->id .'">'. $city->name .'</option>';
    			}
    			$response['cities'] = $html;
    		}
		}

		return response()->json($response);
    }

    /**
     * Function to update the agent details
     * @param void
     * @return array
     */
    public function updateAgent()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $agentData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'agent_company'		=> $agentData['agent_company'],
		        'agent_fname'		=> $agentData['agent_fname'],
		        'agent_lname'		=> $agentData['agent_lname'],
		        'agent_email'		=> $agentData['agent_email'],
		        'agent_address1'	=> $agentData['agent_edit_address1'],
		        'agent_province'	=> $agentData['agent_edit_province'],
		        'agent_city'		=> $agentData['agent_edit_city'],
		        'agent_postalcode'	=> $agentData['agent_edit_postalcode'],
		        'agent_status'		=> $agentData['agent_status']
		    ),
		    array(
		        'agent_company' 	=> array('required'),
		        'agent_fname' 		=> array('required'),
		        'agent_lname' 		=> array('required'),
		        'agent_email' 		=> array('required', 'email'),
		        'agent_address1'	=> array('required'),
		        'agent_province'	=> array('required'),
		        'agent_city' 		=> array('required'),
		        'agent_postalcode' 	=> array('required'),
		        'agent_status' 		=> array('required')
		    ),
		    array(
		        'agent_company.required'	=> 'Please select company',
		        'agent_fname.required' 		=> 'Please enter first name',
		        'agent_lname.required' 		=> 'Please enter last name',
		        'agent_email.required' 		=> 'Please enter email',
		        'agent_email.email' 		=> 'Please enter valid email',
		        'agent_address1.required' 	=> 'Please enter address',
		        'agent_province.required' 	=> 'Please select province',
		        'agent_city.required' 		=> 'Please select city',
		        'agent_postalcode.required'	=> 'Please enter postal code',
		        'agent_status.required' 	=> 'Please select status'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			$user = User::find($agentData['agent_id']);

			DB::beginTransaction();

			$user->email 		= $agentData['agent_email'];
			$user->fname 		= $agentData['agent_fname'];
			$user->lname 		= $agentData['agent_lname'];
			$user->address1		= $agentData['agent_edit_address1'];
			$user->address2		= $agentData['agent_edit_address2'];
			$user->province_id 	= $agentData['agent_edit_province'];
			$user->city_id 		= $agentData['agent_edit_city'];
			$user->postalcode 	= $agentData['agent_edit_postalcode'];
			$user->country_id 	= $agentData['agent_edit_country'];
			$user->status 		= $agentData['agent_status'];
			$user->updated_by 	= $userId;

			if( $user->save() )
			{
				// Check if the user company mapping exist or not
				$user->company()->sync($agentData['agent_company']);

				DB::commit();

				$response['errCode']    = 0;
	        	$response['errMsg']     = 'Agent added successfully';
	        	
			}
			else
			{
				DB::rollBack();

				$response['errCode']    = 3;
	        	$response['errMsg']     = 'Some error in adding agent';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to return the payment plan page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function paymentplan()
    {
    	// Get the logged in user id
        $userId = Auth::user()->id;

    	// Get the company category, if the company is real estate then the payment plan is for agent, otherwise the plans is for companies
    	$user = User::find($userId);

    	$userCompany = $user->company->first();

    	$companyType = 'company';
    	if( $userCompany->company_category_id == 1 )		// Real estate company
    	{
    		$companyType = 'agent';
    	}

    	// Get the payment plan type id for company
    	$PaymentPlanType = PaymentPlanType::where(['plan_type' => $companyType, 'status' => '1'])->select('id')->first();

    	// Get the payment plan list for companies
    	$paymentPlans = PaymentPlan::where(['status' => '1', 'plan_type_id' => $PaymentPlanType->id])->select('id', 'plan_name', 'plan_charges', 'discount', 'validity_days', 'allowed_count')->get();

    	return view('company/paymentPlan', ['paymentPlans' => $paymentPlans]);
    }

    /**
     * Function to return the payment plan page
     * @param void
     * @return array
     */
    public function updateCompanyPaymentPlan()
    {
    	$paymentPlanId = Input::get('paymentPlanId');

    	if( $paymentPlanId != '' )
    	{
	    	// Get the payment plan details
	    	$paymentPlanDetails = PaymentPlan::find($paymentPlanId);

	    	// Get the logged in user id
	        $userId = Auth::user()->id;

	    	// Get the company category, if the company is real estate then the payment plan is for agent, otherwise the plans is for companies
	    	$user = User::find($userId);

	    	$userCompany = $user->company->first();

	    	$companyType = 'company';
	    	if( $userCompany->company_category_id == 1 )		// Real estate company
	    	{
	    		$companyType = 'agent';
	    	}

	    	// Get the payment plan type id for company
	    	$PaymentPlanType = PaymentPlanType::where(['plan_type' => $companyType, 'status' => '1'])->select('id')->first();

	    	// Check if any payment plan already exist. If exist, update the status to 0

	    	$existingPaymentPlan = PaymentPlanSubscription::where(['plan_type_id' => $PaymentPlanType->id, 'subscriber_id' => $userCompany->id, 'status' => '1'])->first();

	    	if( count( $existingPaymentPlan ) > 0 )
	    	{
	    		$oldPlan = PaymentPlanSubscription::find($existingPaymentPlan->id);
	    		$oldPlan->status = '0';

	    		$oldPlan->save();
	    	}

	    	// Calculate the start and the end date
	    	$startDate 	= date('Y-m-d');
	    	$endDate 	= date('Y-m-d', strtotime('+' . $paymentPlanDetails->validity_days . ' days'));

	    	$paymentPlanSubscription = new PaymentPlanSubscription;

			$paymentPlanSubscription->plan_id = $paymentPlanId;
			$paymentPlanSubscription->plan_type_id = $PaymentPlanType->id;
			$paymentPlanSubscription->subscriber_id = $userCompany->id;
			$paymentPlanSubscription->start_date = $startDate;
			$paymentPlanSubscription->end_date = $endDate;
			$paymentPlanSubscription->status = '1';

			if( $paymentPlanSubscription->save() )
			{
				$response['errCode']    = 0;
	        	$response['errMsg']     = 'Payment plan updated successfully';
			}
			else
			{
				$response['errCode']    = 1;
	        	$response['errMsg']     = 'Some error';
			}	
    	}
    	else
		{
			$response['errCode']    = 2;
        	$response['errMsg']     = 'Missing payment plan id';
		}

		return response()->json($response);
    }

    /**
     * Function to update the home cleaning request quotation price related data
     * @param void
     * @return array
     */
    public function updateHomeCleaningServiceRequest()
    {
    	$frmData = Input::get('frmData');

    	$homeCleaningDetails = array();
    	parse_str($frmData, $homeCleaningDetails);

    	// Get the logged-in user id
		$userId = Auth::id();

		// Get the province gst, hst, pst, service charge for the requested service
    	$requestDetails = DB::table('home_cleaning_service_requests as t1')
    					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
    					->where(['t1.id' => $homeCleaningDetails['home_cleaning_service_request_id'], 't1.status' => '1'])
    					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge', 't1.company_id')
    					->first();

        $gstPercentage 	= 0;
        $hstPercentage 	= 0;
        $pstPercentage 	= 0;
        $serviceChargePercentage = 0;
        
        $response = array();
        if( count( $requestDetails ) > 0 )
        {
        	// Check if there is an entry for response already exist

        	$quotationRespone = ServiceRequestResponse::where(['request_id' => $homeCleaningDetails['home_cleaning_service_request_id'], 'company_id' => $requestDetails->company_id])->first();

        	if( count( $quotationRespone ) == 0 )
        	{
		        $pstPercentage 	= $requestDetails->pst;
		        $gstPercentage 	= $requestDetails->gst;
		        $hstPercentage 	= $requestDetails->hst;
		        $serviceChargePercentage = $requestDetails->service_charge;

		        // Calculate the gst, hst, pst, service charge amount for the requested services
		        $gstAmount 		= 0;
		        $hstAmount 		= 0;
		        $pstAmount 		= 0;
		        $serviceCharge 	= 0;
		        $subTotal 		= 0;
		        $insurance 		= 0;
		        $totalAmount 	= 0;
		        $totalRemittance= 0;

		        // Steaming Service Charge
		        foreach( $homeCleaningDetails['steaming_service_budget_estimate'] as $amount )
		        {
		        	$subTotal += $amount;
		        }

		        // Other Places Cleaning Service Charge
		        foreach( $homeCleaningDetails['other_place_to_clean_budget_estimate'] as $amount )
		        {
		        	$subTotal += $amount;
		        }

		        // Additional Service Charge
		        foreach( $homeCleaningDetails['additional_service_budget_estimate'] as $amount )
		        {
		        	$subTotal += $amount;
		        }

		        // Deduct the discount
		        if( $homeCleaningDetails['discount'] != '' && $homeCleaningDetails['discount'] != 0 )
		        {
		        	$subTotal -= $homeCleaningDetails['discount'];
		        }

		        if( $gstPercentage != 0 )
		        {
		        	$gstAmount = round(( $gstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $hstPercentage != 0 )
		        {
		        	$hstAmount = round(( $hstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $pstPercentage != 0 )
		        {
		        	$pstAmount = round(( $pstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $serviceChargePercentage != 0 )
		        {
		        	$serviceCharge = round(( $serviceChargePercentage / 100 ) * $subTotal, 2);
		        }

		        $totalAmount = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount ), 2);

		        $totalRemittance = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount - $serviceCharge ), 2);

		        // Start transaction
		        DB::beginTransaction();

		        // Update the hours and amount in home_cleaning_additional_service_requests table
		        foreach( $homeCleaningDetails['additional_service_budget_estimate'] as $key => $value )
		        {
		        	HomeCleaningAdditionalServiceRequest::where(['service_request_id' => $homeCleaningDetails['home_cleaning_service_request_id'], 'additional_request_id' => $key])->update([
		        		'amount' => $homeCleaningDetails['additional_service_budget_estimate'][$key],
		        		'hour_to_complete' => $homeCleaningDetails['additional_service_time_estimate'][$key]
		        	]);
		        }

		        // Update the hours and amount in home_cleaning_other_place_service_requests table
		        foreach( $homeCleaningDetails['other_place_to_clean_budget_estimate'] as $key => $value )
		        {
		        	HomeCleaningOtherPlaceServiceRequest::where(['service_request_id' => $homeCleaningDetails['home_cleaning_service_request_id'], 'other_place_id' => $key])->update([
		        		'amount' => $homeCleaningDetails['other_place_to_clean_budget_estimate'][$key],
		        		'hour_to_complete' => $homeCleaningDetails['other_place_to_clean_time_estimate'][$key]
		        	]);
		        }

		        // Update the hours and amount in home_cleaning_steaming_service_requests table
		        foreach( $homeCleaningDetails['steaming_service_time_estimate'] as $key => $value )
		        {
		        	HomeCleaningSteamingServiceRequest::where(['service_request_id' => $homeCleaningDetails['home_cleaning_service_request_id'], 'steaming_service_id' => $key])->update([
		        		'amount' => $homeCleaningDetails['steaming_service_time_estimate'][$key],
		        		'hour_to_complete' => $homeCleaningDetails['steaming_service_budget_estimate'][$key]
		        	]);
		        }

    	    	// Add the total amount, gst, hst, pst, service tax, insurance, comments which are applicable
    			$serviceRequestResponse = new ServiceRequestResponse;

    			$serviceRequestResponse->request_id 	= $homeCleaningDetails['home_cleaning_service_request_id'];
    			$serviceRequestResponse->company_id 	= $requestDetails->company_id;
    			$serviceRequestResponse->gst_amount 	= $gstAmount;
    			$serviceRequestResponse->hst_amount 	= $hstAmount;
    			$serviceRequestResponse->pst_amount 	= $pstAmount;
    			$serviceRequestResponse->service_charge = $serviceCharge;
    			$serviceRequestResponse->insurance 		= $insurance;
    			$serviceRequestResponse->discount 		= $homeCleaningDetails['discount'];
    			$serviceRequestResponse->total_amount 	= $totalAmount;
    			$serviceRequestResponse->total_remittance = $totalRemittance;
    			$serviceRequestResponse->comment 		= $homeCleaningDetails['comment'];
    			$serviceRequestResponse->created_by 	= $userId;

    			if( $serviceRequestResponse->save() )
    			{
    				// Commit the transaction
    				DB::commit();

    				$response['errCode'] 	= 0;
            		$response['errMsg'] 	= 'Response saved successfully';
    			}
    			else
    			{
    				// Rollback the transaction
    				DB::rollBack();

    				$response['errCode'] 	= 2;
            		$response['errMsg'] 	= 'Some issue in updating the response';
    			}
		    }
		    else
        	{
        		$response['errCode'] 	= 3;
	        	$response['errMsg'] 	= 'You cannot enter response on the same query again!';
        	}
		}
		else
		{
			$response['errCode'] 	= 1;
	        $response['errMsg'] 	= 'Some issue';
		}

		return response()->json($response);
    }

    /**
     * Function to update the tech concierge quotation price related data
     * @param void
     * @return array
     */
    public function updateTechConciergeServiceRequest()
    {
    	$frmData = Input::get('frmData');

    	$techConciergeDetails = array();
    	parse_str($frmData, $techConciergeDetails);

		// Get the logged-in user id
		$userId = Auth::id();

		// Get the province gst, hst, pst, service charge for the requested service
    	$requestDetails = DB::table('tech_concierge_service_requests as t1')
    					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
    					->where(['t1.id' => $techConciergeDetails['tech_concierge_service_request_id'], 't1.status' => '1'])
    					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge', 't1.company_id')
    					->first();

        $gstPercentage 	= 0;
        $hstPercentage 	= 0;
        $pstPercentage 	= 0;
        $serviceChargePercentage = 0;
        $response = array();
        if( count( $requestDetails ) > 0 )
        {
        	// Check if there is an entry for response already exist

        	$quotationRespone = ServiceRequestResponse::where(['request_id' => $techConciergeDetails['tech_concierge_service_request_id'], 'company_id' => $requestDetails->company_id])->first();

        	if( count( $quotationRespone ) == 0 )
        	{
		        $pstPercentage 	= $requestDetails->pst;
		        $gstPercentage 	= $requestDetails->gst;
		        $hstPercentage 	= $requestDetails->hst;
		        $serviceChargePercentage = $requestDetails->service_charge;

		        // Calculate the gst, hst, pst, service charge amount for the requested services
		        $gstAmount 		= 0;
		        $hstAmount 		= 0;
		        $pstAmount 		= 0;
		        $serviceCharge 	= 0;
		        $subTotal 		= 0;
		        $insurance 		= 0;
		        $totalAmount 	= 0;
		        $totalRemittance= 0;

		        foreach( $techConciergeDetails['appliance_budget_estimate'] as $amount )
		        {
		        	$subTotal += $amount;
		        }

		        // Deduct the discount
		        if( $techConciergeDetails['discount'] != '' && $techConciergeDetails['discount'] != 0 )
		        {
		        	$subTotal -= $techConciergeDetails['discount'];
		        }

		        if( $gstPercentage != 0 )
		        {
		        	$gstAmount = round(( $gstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $hstPercentage != 0 )
		        {
		        	$hstAmount = round(( $hstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $pstPercentage != 0 )
		        {
		        	$pstAmount = round(( $pstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $serviceChargePercentage != 0 )
		        {
		        	$serviceCharge = round(( $serviceChargePercentage / 100 ) * $subTotal, 2);
		        }

		        $totalAmount = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount ), 2);

		        $totalRemittance = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount - $serviceCharge ), 2);

		        // Start transaction
		        DB::beginTransaction();

		    	// Update the tech concierge application service request
		    	if( is_array( $techConciergeDetails['appliance_budget_estimate'] ) && count( $techConciergeDetails['appliance_budget_estimate'] ) )
		    	{
		    		foreach( $techConciergeDetails['appliance_budget_estimate'] as $applianceId => $amount )
		    		{
		    			TechConciergeAppliancesServiceRequest::where([
		    				'service_request_id' => $techConciergeDetails['tech_concierge_service_request_id'], 
		    				'appliance_id' => $applianceId
		    			])
		    			->update([
		    				'service_hours' => $techConciergeDetails['appliance_time_estimate'][$applianceId], 
		    				'amount' => $amount,
		    				'updated_by' => $userId
		    			]);
		    		}
		    	}

		    	// Add the total amount, gst, hst, pst, service tax, insurance, comments which are applicable
				$serviceRequestResponse = new ServiceRequestResponse;

				$serviceRequestResponse->request_id 	= $techConciergeDetails['tech_concierge_service_request_id'];
				$serviceRequestResponse->company_id 	= $requestDetails->company_id;
				$serviceRequestResponse->gst_amount 	= $gstAmount;
				$serviceRequestResponse->hst_amount 	= $hstAmount;
				$serviceRequestResponse->pst_amount 	= $pstAmount;
				$serviceRequestResponse->service_charge = $serviceCharge;
				$serviceRequestResponse->insurance 		= $insurance;
				$serviceRequestResponse->discount 		= $techConciergeDetails['discount'];
				$serviceRequestResponse->total_amount 	= $totalAmount;
				$serviceRequestResponse->total_remittance = $totalRemittance;
				$serviceRequestResponse->comment 		= $techConciergeDetails['comment'];
				$serviceRequestResponse->created_by 	= $userId;

				if( $serviceRequestResponse->save() )
				{
					// Commit the transaction
					DB::commit();

					$response['errCode'] 	= 0;
	        		$response['errMsg'] 	= 'Response saved successfully';
				}
				else
				{
					// Rollback the transaction
					DB::rollBack();

					$response['errCode'] 	= 2;
	        		$response['errMsg'] 	= 'Some issue in updating the response';
				}
        	}
        	else
        	{
        		$response['errCode'] 	= 3;
	        	$response['errMsg'] 	= 'You cannot enter response on the same query again!';
        	}
        }
        else
        {
        	$response['errCode'] 	= 1;
        	$response['errMsg'] 	= 'Some issue';
        }

        return response()->json($response);
    }

    /**
     * Function to update the moving request quotation price related data
     * @param void
     * @return array
     */
    public function updateMovingServiceRequest()
    {
    	$frmData = Input::get('frmData');

    	$movingDetails = array();
    	parse_str($frmData, $movingDetails);
		
		// Get the logged-in user id
		$userId = Auth::id();

		// Get the province gst, hst, pst, service charge for the requested service
    	$requestDetails = DB::table('moving_item_service_requests as t1')
    					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
    					->where(['t1.id' => $movingDetails['moving_service_request_id'], 't1.status' => '1'])
    					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge', 't1.mover_company_id as company_id')
    					->first();

        $gstPercentage 	= 0;
        $hstPercentage 	= 0;
        $pstPercentage 	= 0;
        $serviceChargePercentage = 0;
        $response = array();
        if( count( $requestDetails ) > 0 )
        {
        	// Check if there is an entry for response already exist

        	$quotationRespone = ServiceRequestResponse::where(['request_id' => $movingDetails['moving_service_request_id'], 'company_id' => $requestDetails->company_id])->first();

        	if( count( $quotationRespone ) == 0 )
        	{
		        $pstPercentage 	= $requestDetails->pst;
		        $gstPercentage 	= $requestDetails->gst;
		        $hstPercentage 	= $requestDetails->hst;
		        $serviceChargePercentage = $requestDetails->service_charge;

		        // Calculate the gst, hst, pst, service charge amount for the requested services
		        $gstAmount 		= 0;
		        $hstAmount 		= 0;
		        $pstAmount 		= 0;
		        $serviceCharge 	= 0;
		        $subTotal 		= 0;
		        $insurance 		= 0;
		        $totalAmount 	= 0;
		        $totalRemittance= 0;

		        foreach( $movingDetails['detail_job_budget_estimate'] as $amount )
		        {
		        	$subTotal += $amount;
		        }

		        // Add the transportation charge
		        if( $movingDetails['transportation_vehicle_budget_estimate'][1] != '' && $movingDetails['transportation_vehicle_budget_estimate'][1] != 0 )
		        {
		        	$subTotal += $movingDetails['transportation_vehicle_budget_estimate'][1];
		        }

		        // Add the insurance
		        if( $movingDetails['insurance'] != '' && $movingDetails['insurance'] != 0 )
		        {
		        	$subTotal += $movingDetails['insurance'];
		        }

		        // Deduct the discount
		        if( $movingDetails['discount'] != '' && $movingDetails['discount'] != 0 )
		        {
		        	$subTotal -= $movingDetails['discount'];
		        }

		        if( $gstPercentage != 0 )
		        {
		        	$gstAmount = round(( $gstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $hstPercentage != 0 )
		        {
		        	$hstAmount = round(( $hstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $pstPercentage != 0 )
		        {
		        	$pstAmount = round(( $pstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $serviceChargePercentage != 0 )
		        {
		        	$serviceCharge = round(( $serviceChargePercentage / 100 ) * $subTotal, 2);
		        }

		        $totalAmount = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount ), 2);

		        $totalRemittance = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount - $serviceCharge ), 2);

		       	
		        // Start transaction
		        DB::beginTransaction();

		    	// Update the moving_item_detail_service_requests request
		    	if( is_array( $movingDetails['detail_job_budget_estimate'] ) && count( $movingDetails['detail_job_budget_estimate'] ) )
		    	{
		    		foreach( $movingDetails['detail_job_budget_estimate'] as $applianceId => $amount )
		    		{
		    			MovingItemDetailServiceRequest::where([
		    				'moving_items_service_id' => $movingDetails['moving_service_request_id'], 
		    				'moving_items_details_id' => $applianceId
		    			])
		    			->update([
		    				'move_hours' => $movingDetails['detail_job_time_estimate'][$applianceId], 
		    				'amount' => $amount,
		    				'updated_by' => $userId
		    			]);
		    		}
		    	}

		    	// Update the moving_transportation_type_requests request
		    	if( $movingDetails['transportation_vehicle_budget_estimate'] != '' && $movingDetails['transportation_vehicle_budget_estimate'] != 0 )
		    	{
		    		foreach( $movingDetails['transportation_vehicle_budget_estimate'] as $transportId => $amount )
		    		{
		    			MovingTransportationTypeRequest::where([
		    				'moving_items_services_id' => $movingDetails['moving_service_request_id'], 
		    				'transportation_id' => $transportId
		    			])
		    			->update([
		    				'hour_to_complete' => $movingDetails['transportation_vehicle_time_estimate'][$transportId], 
		    				'amount' => $amount,
		    				'updated_by' => $userId
		    			]);
		    		}
		    	}
		    	
		    	// Add the total amount, gst, hst, pst, service tax, insurance, comments which are applicable
				$serviceRequestResponse = new ServiceRequestResponse;

				$serviceRequestResponse->request_id 	= $movingDetails['moving_service_request_id'];
				$serviceRequestResponse->company_id 	= $requestDetails->company_id;
				$serviceRequestResponse->gst_amount 	= $gstAmount;
				$serviceRequestResponse->hst_amount 	= $hstAmount;
				$serviceRequestResponse->pst_amount 	= $pstAmount;
				$serviceRequestResponse->service_charge = $serviceCharge;
				$serviceRequestResponse->insurance 		= $movingDetails['insurance'];
				$serviceRequestResponse->discount 		= $movingDetails['discount'];
				$serviceRequestResponse->total_amount 	= $totalAmount;
				$serviceRequestResponse->total_remittance = $totalRemittance;
				$serviceRequestResponse->comment 		= $movingDetails['comment'];
				$serviceRequestResponse->created_by 	= $userId;

				if( $serviceRequestResponse->save() )
				{
					// Commit the transaction
					DB::commit();

					$response['errCode'] 	= 0;
	        		$response['errMsg'] 	= 'Response saved successfully';
				}
				else
				{
					// Rollback the transaction
					DB::rollBack();

					$response['errCode'] 	= 2;
	        		$response['errMsg'] 	= 'Some issue in updating the response';
				}
        	}
        	else
        	{
        		$response['errCode'] 	= 3;
	        	$response['errMsg'] 	= 'You cannot enter response on the same query again!';
        	}
        }
        else
        {
        	$response['errCode'] 	= 1;
        	$response['errMsg'] 	= 'Some issue';
        }

        return response()->json($response);
    }

    /**
     * Function to update the cable internet request quotation price related data
     * @param void
     * @return array
     */
    public function updateCableInternetServiceRequest()
    {
    	$frmData = Input::get('frmData');

    	$cableInternetDetails = array();
    	parse_str($frmData, $cableInternetDetails);
		
		// Get the logged-in user id
		$userId = Auth::id();

		// Get the province gst, hst, pst, service charge for the requested service
    	$requestDetails = DB::table('digital_service_requests as t1')
    					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
    					->join('provinces as t3', 't2.province_id', '=', 't3.id')
    					->where(['t1.id' => $cableInternetDetails['cable_internet_service_request_id'], 't1.status' => '1'])
    					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge', 't1.digital_service_company_id as company_id')
    					->first();

        $gstPercentage 	= 0;
        $hstPercentage 	= 0;
        $pstPercentage 	= 0;
        $serviceChargePercentage = 0;
        $response = array();
        if( count( $requestDetails ) > 0 )
        {
        	// Check if there is an entry for response already exist

        	$quotationRespone = ServiceRequestResponse::where(['request_id' => $cableInternetDetails['cable_internet_service_request_id'], 'company_id' => $requestDetails->company_id])->first();

        	if( count( $quotationRespone ) == 0 )
        	{
		        $pstPercentage 	= $requestDetails->pst;
		        $gstPercentage 	= $requestDetails->gst;
		        $hstPercentage 	= $requestDetails->hst;
		        $serviceChargePercentage = $requestDetails->service_charge;

		        // Calculate the gst, hst, pst, service charge amount for the requested services
		        $gstAmount 		= 0;
		        $hstAmount 		= 0;
		        $pstAmount 		= 0;
		        $serviceCharge 	= 0;
		        $subTotal 		= 0;
		        $insurance 		= 0;
		        $totalAmount 	= 0;
		        $totalRemittance= 0;

		        foreach( $cableInternetDetails['service_budget_estimate'] as $amount )
		        {
		        	$subTotal += $amount;
		        }

		        // Deduct the discount
		        if( $cableInternetDetails['discount'] != '' && $cableInternetDetails['discount'] != 0 )
		        {
		        	$subTotal -= $cableInternetDetails['discount'];
		        }

		        if( $gstPercentage != 0 )
		        {
		        	$gstAmount = round(( $gstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $hstPercentage != 0 )
		        {
		        	$hstAmount = round(( $hstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $pstPercentage != 0 )
		        {
		        	$pstAmount = round(( $pstPercentage / 100 ) * $subTotal, 2);
		        }

		        if( $serviceChargePercentage != 0 )
		        {
		        	$serviceCharge = round(( $serviceChargePercentage / 100 ) * $subTotal, 2);
		        }

		        $totalAmount = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount ), 2);

		        $totalRemittance = round(( $subTotal + $gstAmount + $hstAmount + $pstAmount - $serviceCharge ), 2);

    	        // Start transaction
    	        DB::beginTransaction();

    	    	// Update the cable internet application service request
    	    	if( is_array( $cableInternetDetails['service_budget_estimate'] ) && count( $cableInternetDetails['service_budget_estimate'] ) )
    	    	{
    	    		foreach( $cableInternetDetails['service_budget_estimate'] as $applianceId => $amount )
    	    		{
    	    			DigitalServiceTypeRequest::where([
    	    				'digital_service_request_id' => $cableInternetDetails['cable_internet_service_request_id'], 
    	    				'digital_service_type_id' => $applianceId
    	    			])
    	    			->update([
    	    				'service_hours' => $cableInternetDetails['service_time_estimate'][$applianceId], 
    	    				'amount' => $amount,
    	    				'updated_by' => $userId
    	    			]);
    	    		}
    	    	}

    	    	
    	    	// Add the total amount, gst, hst, pst, service tax, insurance, comments which are applicable
    			$serviceRequestResponse = new ServiceRequestResponse;

    			$serviceRequestResponse->request_id 	= $cableInternetDetails['cable_internet_service_request_id'];
    			$serviceRequestResponse->company_id 	= $requestDetails->company_id;
    			$serviceRequestResponse->gst_amount 	= $gstAmount;
    			$serviceRequestResponse->hst_amount 	= $hstAmount;
    			$serviceRequestResponse->pst_amount 	= $pstAmount;
    			$serviceRequestResponse->service_charge = $serviceCharge;
    			$serviceRequestResponse->insurance 		= $insurance;
    			$serviceRequestResponse->discount 		= $cableInternetDetails['discount'];
    			$serviceRequestResponse->total_amount 	= $totalAmount;
    			$serviceRequestResponse->total_remittance = $totalRemittance;
    			$serviceRequestResponse->comment 		= $cableInternetDetails['comment'];
    			$serviceRequestResponse->created_by 	= $userId;

    			if( $serviceRequestResponse->save() )
    			{
    				// Commit the transaction
    				DB::commit();

    				$response['errCode'] 	= 0;
            		$response['errMsg'] 	= 'Response saved successfully';
    			}
    			else
    			{
    				// Rollback the transaction
    				DB::rollBack();

    				$response['errCode'] 	= 2;
            		$response['errMsg'] 	= 'Some issue in updating the response';
    			}
    			
        	}
        	else
        	{
        		$response['errCode'] 	= 3;
	        	$response['errMsg'] 	= 'You cannot enter response on the same query again!';
        	}
        }
        else
        {
        	$response['errCode'] 	= 1;
        	$response['errMsg'] 	= 'Some issue';
        }

        return response()->json($response);
    }

    /**
     * Function to get the pst, gst, hst, service charge values
     * @param void
     * @return array
     */
    public function fetchProvinceTaxes()
    {
    	$serviceRequestId 	= Input::get('serviceRequestId');
    	$serviceType 		= Input::get('serviceType');

    	if( $serviceType == 'home_cleaning' )
    	{
        	$clientMovingToAddress = DB::table('home_cleaning_service_requests as t1')
	            					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
	            					->join('provinces as t3', 't2.province_id', '=', 't3.id')
	            					->where(['t1.id' => $serviceRequestId, 't1.status' => '1'])
	            					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge')
	            					->first();

	        $response['pst'] 			= $clientMovingToAddress->pst;
	        $response['gst'] 			= $clientMovingToAddress->gst;
	        $response['hst'] 			= $clientMovingToAddress->hst;
	        $response['service_charge']	= $clientMovingToAddress->service_charge;
    	}
    	else if( $serviceType == 'tech_concierge' )
    	{
        	$clientMovingToAddress = DB::table('tech_concierge_service_requests as t1')
	            					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
	            					->join('provinces as t3', 't2.province_id', '=', 't3.id')
	            					->where(['t1.id' => $serviceRequestId, 't1.status' => '1'])
	            					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge')
	            					->first();

	        $response['pst'] 			= $clientMovingToAddress->pst;
	        $response['gst'] 			= $clientMovingToAddress->gst;
	        $response['hst'] 			= $clientMovingToAddress->hst;
	        $response['service_charge']	= $clientMovingToAddress->service_charge;
    	}
    	else if( $serviceType == 'moving_company' )
    	{
        	$clientMovingToAddress = DB::table('moving_item_service_requests as t1')
	            					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
	            					->join('provinces as t3', 't2.province_id', '=', 't3.id')
	            					->where(['t1.id' => $serviceRequestId, 't1.status' => '1'])
	            					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge')
	            					->first();

	        $response['pst'] 			= $clientMovingToAddress->pst;
	        $response['gst'] 			= $clientMovingToAddress->gst;
	        $response['hst'] 			= $clientMovingToAddress->hst;
	        $response['service_charge']	= $clientMovingToAddress->service_charge;
    	}
    	else if( $serviceType == 'cable_internet' )
    	{
        	$clientMovingToAddress = DB::table('digital_service_requests as t1')
	            					->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
	            					->join('provinces as t3', 't2.province_id', '=', 't3.id')
	            					->where(['t1.id' => $serviceRequestId, 't1.status' => '1'])
	            					->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge')
	            					->first();

	        $response['pst'] 			= $clientMovingToAddress->pst;
	        $response['gst'] 			= $clientMovingToAddress->gst;
	        $response['hst'] 			= $clientMovingToAddress->hst;
	        $response['service_charge']	= $clientMovingToAddress->service_charge;
    	}

        return response()->json($response);
    }
}