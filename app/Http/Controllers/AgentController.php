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
use Illuminate\Http\Request;

use App\User;
use App\Role;
use App\Permission;
use App\Province;
use App\UtilityServiceCategory;
use App\Country;
use App\State;
use App\UtilityServiceType;
use App\UtilityServiceProvider;
use App\CompanyCategory;
use App\PaymentPlan;
use App\PaymentPlanType;
use App\City;
use App\LoginAttempt;
use App\AgentClient;
use App\Message;
use App\Company;

use Validator;
use Helper;

class AgentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Function to return login view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('agent/index');
    }

    /**
     * Function for admin login
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
			// Check for the credential and role. Only agent can login here
			$user = User::where(['email' => $loginData['username'], 'status' => '1'])->first();

			if( count($user)  > 0 )
			{
		        if( $user->hasRole(['agent']) )	// list of allowed users
		        {
		        	// Check for the login count attempt
		        	$loginAttempt = Helper::loginAttempt($user->id, date('Y-m-d H:i:s'));

		        	if( $loginAttempt['errCode'] == 0 )
		        	{
			        	if(Auth::attempt(['email' => $loginData['username'], 'password' => $loginData['password'], 'status' => '1'], $remember))
			            {
			                // Get the logged-in user id
			                $userId = Auth::id();

			                // If user credentials are valid, update the last_login time in users table.
			                $user = User::find($userId);
			                $user->last_login = date('Y-m-d H:i:s');
			                $user->update();

			                // Update the login attempt count to zero
    	            		$loginAttempt = LoginAttempt::where(['user_id' => $user->id])->first();
		            		$loginAttempt->user_id 		= $user->id;
		            		$loginAttempt->last_login	= date('Y-m-d H:i:s');
			            	$loginAttempt->count 		= 0;
			            	$loginAttempt->save();

			                $response['errCode']    = 0;
			                $response['errMsg']     = 'Successful login';
			            }
			            else
			            {
			            	// Add/Update the login attempt count
			            	$attemptDetails = LoginAttempt::where(['user_id' => $user->id])->first();

			            	if( count( $attemptDetails ) == 0 )		// Add the data
			            	{
			            		$loginAttempt = new LoginAttempt;

			            		$loginAttempt->user_id 		= $user->id;
			            		$loginAttempt->last_login	= date('Y-m-d H:i:s');
				            	$loginAttempt->count 		= 0;

				            	$loginAttempt->save();
			            	}
			            	else 									// Update the data
			            	{
			            		$loginAttempt = LoginAttempt::find($attemptDetails->id);

			            		$loginAttempt->user_id 		= $user->id;
			            		$loginAttempt->last_login	= date('Y-m-d H:i:s');
				            	$loginAttempt->count 		= $attemptDetails->count + 1;

				            	$loginAttempt->save();
			            	}

			                $response['errCode']    = 2;
			                $response['errMsg']     = 'Invalid user credentials';
			            }
		        	}
		        	else
		        	{
		        		$response['errCode']    = 5;
			            $response['errMsg']     = $loginAttempt['errMsg'];
		        	}
		        }
		        else
		        {
		        	$response['errCode']    = 3;
		           	$response['errMsg']     = 'Invalid user credentials';
		        }
			}
			else
	        {
	        	$response['errCode']    = 4;
	           	$response['errMsg']     = 'Invalid user credentials';
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
    	// Get the client count
    	$clientCount = AgentClient::count();

    	return view('agent/dashboard', ['clientCount' => $clientCount]);
    }

    /**
     * Function to show agent contacts listing page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function clients()
    {
    	return view('agent/clients');
    }

    /**
     * Function to save the client details
     * @param void
     * @return array
     */
    public function saveClient()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $clientData);

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response =array();

        $validation = Validator::make(
		    array(
		        'client_fname'	=> $clientData['client_fname'],
		        'client_email' 	=> $clientData['client_email'],
		        'client_number'	=> $clientData['client_number'],
		        'client_status'	=> $clientData['client_status']
		    ),
		    array(
		        'client_fname' 	=> array('required'),
		        'client_email'	=> array('required', 'email'),
		        'client_number'	=> array('required', 'numeric'),
		        'client_status'	=> array('required')
		    ),
		    array(
		        'client_fname.required' => 'Please enter first name',
		        'client_email.required' => 'Please enter email',
		        'client_email.email' 	=> 'Please enter valid email',
		        'client_number.required'=> 'Please enter contact number',
		        'client_number.numeric' => 'Please enter valid contact number',
		        'client_status.required'=> 'Please select status',
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
			// Check if the client_id is available or not. If available, edit the client, otherwise add it.
			if( $clientData['client_id'] == '' )
			{
				// Save the client details
				$agentClient = new AgentClient;

				$agentClient->agent_id 		= $userId;
				$agentClient->fname 			= $clientData['client_fname'];
				$agentClient->lname 			= $clientData['client_mname'];
				$agentClient->oname 			= $clientData['client_lname'];
				$agentClient->email 			= $clientData['client_email'];
				$agentClient->contact_number 	= $clientData['client_number'];
				$agentClient->status 			= $clientData['client_status'];
				$agentClient->created_by 		= $userId;

				if( $agentClient->save() )
				{
					$response['errCode']    = 0;
				    $response['errMsg']     = 'Client added successfully';
				}
				else
				{
					$response['errCode']    = 1;
				    $response['errMsg']     = 'Some issue in adding the client';
				}
			}
			else
			{
				// Update the client details
				$agentClient = AgentClient::find($clientData['client_id']);

				// Check if the the client is associated with the agent or not

				if( $userId == $agentClient->agent_id )
				{
					$agentClient->agent_id 		= $userId;
					$agentClient->fname 			= $clientData['client_fname'];
					$agentClient->lname 			= $clientData['client_mname'];
					$agentClient->oname 			= $clientData['client_lname'];
					$agentClient->email 			= $clientData['client_email'];
					$agentClient->contact_number 	= $clientData['client_number'];
					$agentClient->status 			= $clientData['client_status'];
					$agentClient->updated_by 		= $userId;

					if( $agentClient->save() )
					{
						$response['errCode']    = 0;
					    $response['errMsg']     = 'Client added successfully';
					}
					else
					{
						$response['errCode']    = 1;
					    $response['errMsg']     = 'Some issue in adding the client';
					}
				}
				else
				{
					$response['errCode']    = 2;
					$response['errMsg']     = 'You cannot update this client, as this belongs to some other agent';
				}

			}
		}

		return response()->json($response);
    }

    /**
     * Function to fetch the clients list and show in datatable
     * @param void
     * @return array
     */
    public function fetchClients()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'fname',
            2 => 'oname',
            3 => 'lname',
            6 => 'status'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Get the records after applying the datatable filters
        $agentClients = AgentClient::where('fname','like', '%'.$sSearch.'%')
        			->where('agent_id','=', $userId)
                    ->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->select('id', 'fname', 'lname', 'oname', 'email', 'contact_number', 'status')
                    ->get();

        $iTotal = AgentClient::where('fname','like', '%'.$sSearch.'%')->where('agent_id','=', $userId)->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $agentClients ) > 0 )
        {
            foreach ($agentClients as $agentClient)
            {
            	$response['aaData'][$k] = array(
                    0 => $agentClient->id,
                    1 => ucfirst( strtolower( $agentClient->fname ) ),
                    2 => ucfirst( strtolower( $agentClient->oname ) ),
                    3 => ucfirst( strtolower( $agentClient->lname ) ),
                    4 => $agentClient->email,
                    5 => $agentClient->contact_number,
                    6 => Helper::getStatusText($agentClient->status),
                    7 => '<a href="javascript:void(0);" class="agent_invite_client" id="'. $agentClient->id .'" data-toggle="tooltip" title="Invite Client"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> &nbsp;&nbsp; <a href="javascript:void(0);" data-toggle="tooltip" title="Edit Client" id="'. $agentClient->id .'" class="edit_client"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function get the details of the selected client
     * @param void
     * @return array
     */
    public function getClientDetails()
    {
    	$clientId = Input::get('clientId');

    	// Get the logged in user id
        $userId = Auth::user()->id;

        $response = array();
    	if( $clientId != '' )
    	{
    		// Get the client details
    		$clientDetails = AgentClient::find($clientId);

    		// Check if the client is associated with the agent or not
    		if( $userId == $clientDetails->agent_id )
    		{
    			$response['errCode']    = 0;
			    $response['errMsg']     = 'Success';
			    $response['details']   	= array(
			    	'fname' 	=> $clientDetails->fname,
			    	'mname' 	=> $clientDetails->oname,
			    	'lname' 	=> $clientDetails->lname,
			    	'email' 	=> $clientDetails->email,
			    	'contact_no'=> $clientDetails->contact_number,
			    	'status' 	=> $clientDetails->status
			    );
    		}
    		else
    		{
    			$response['errCode']    = 1;
			    $response['errMsg']     = 'You cannot update this client, as this belongs to some other agent';
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to return agent profile page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
    	// Get the logged in user id
        $userId = Auth::user()->id;

    	$agentDetails = User::find($userId);

    	$companyDetails = $agentDetails->company;

    	$companyCategories = CompanyCategory::where(['status' => '1'])->get();

        // Get the country list
    	$countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();

       	// Get the province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

    	$cityArray = array();
    	if( count( $agentDetails ) > 0 && $agentDetails->province_id != '' )
    	{
	        // Get the cities list for the selected province as the city list is filtered to the selected province by using the ajax
			$cities = City::where(['province_id' => $agentDetails->province_id])->get();

			if( count( $cities ) > 0 )
			{
				foreach ($cities as $city)
				{
	    			$cityArray[] = array(
	    				'id' 	=> $city->id,
	    				'city' 	=> ucwords( strtolower( $city->name ) ),
	    			);
				}
			}
    	}
       	
    	return view('agent/profile', ['agentDetails' => $agentDetails, 'cityArray' => $cityArray, 'provinces' => $provinces, 'countries' => $countries, 'companyCategories' => $companyCategories, 'companyDetails' => $companyDetails]);
    }

    /**
     * Function to save agent profile details
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function saveProfileDetails() 
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $profileData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response = array();

		$validation = Validator::make(
		    array(
		        'agent_email'		    => $profileData['agent_email'],
		        'agent_fname'	        => $profileData['agent_fname'],
		        'agent_lname'		    => $profileData['agent_lname'],
		        'agent_address'	        => $profileData['agent_address'],
		        'agent_company_name'    => $profileData['agent_company_name'],
		        'agent_company_address'	=> $profileData['agent_company_address'],
		    ),
		    array(
		        'agent_email' 	        => array('required', 'email'),
		        'agent_fname' 	        => array('required'),
		        'agent_lname' 	        => array('required'),
		        'agent_address' 	    => array('required'),
		        'agent_company_name' 	=> array('required'),
		        'agent_company_address' => array('required'),
		    ),
		    array(
		        'agent_email.required' 	         => 'Please enter email',
		        'agent_fname.required' 	         => 'Please enter first name',
		        'agent_lname.required' 	         => 'Please enter last name',
		        'agent_address.required' 	     => 'Please enter address',
		        'agent_company_name.required' 	 => 'Please enter company name',
		        'agent_company_address.required' => 'Please enter compant address',
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
			$user = User::find($userId);

			$user->email 		= $profileData['agent_email'];
			$user->fname 		= $profileData['agent_fname'];			
			$user->lname 		= $profileData['agent_lname'];
			$user->address 		= $profileData['agent_address'];
			$user->province_id 	= $profileData['agent_province'];
			$user->city_id 		= $profileData['agent_city'];
			$user->postalcode 	= $profileData['agent_postalcode'];
			$user->country_id 	= $profileData['agent_country'];
			$user->updated_by 	= $userId;

			if( $user->save() )
			{
				if( count( $user->company ) > 0 && isset( $user->company[0]->id ) )
				{
					// Update the company details also
					$companyDetails = Company::find($user->company[0]->id);

					$companyDetails->company_name = $profileData['agent_company_name'];
					$companyDetails->company_category_id = $profileData['agent_company_category'];
					$companyDetails->address = $profileData['agent_company_address'];
					$companyDetails->province_id = $profileData['agent_company_province'];
					$companyDetails->city_id = $profileData['agent_company_city'];
					$companyDetails->postal_code = $profileData['agent_company_postalcode'];
					$companyDetails->country_id = $profileData['agent_company_country'];

					$companyDetails->save();
				}
				else
				{
					// Add the company details also
					$companyDetails = new Company;

					$companyDetails->company_name = $profileData['agent_company_name'];
					$companyDetails->company_category_id = $profileData['agent_company_category'];
					$companyDetails->address = $profileData['agent_company_address'];
					$companyDetails->province_id = $profileData['agent_company_province'];
					$companyDetails->city_id = $profileData['agent_company_city'];
					$companyDetails->postal_code = $profileData['agent_company_postalcode'];
					$companyDetails->country_id = $profileData['agent_company_country'];

					$companyDetails->save();
				}

				$response['errCode']    = 0;
			    $response['errMsg']     = 'Profile updated successfully';
			}
			else
			{
    			$response['errCode']    = 2;
			    $response['errMsg']     = 'Some error in updating the details';
			}
		}

		return response()->json($response);
    }

    /**
     * Function fetch the client details as well as its associated message and template details to show in popup
     * @param void
     * @return array
     */
    public function createInvitation()
    {
    	$clientId = Input::get('clientId');

    	// Get the logged in user id
        $userId = Auth::user()->id;

    	$response = array();
    	if( $clientId != '' )
    	{
    		// Get the message for the user
    		$message = Message::where(['agent_id' => $userId, 'status' => '1'])->select('message')->first();

    		// Get the client details
    		$clientDetails = AgentClient::find($clientId);

    		$clientName = ucwords( strtolower( $clientDetails->fname . ' ' . $clientDetails->oname . ' ' . $clientDetails->lname ) );

    		// Replace the [User Name] with the actual user name
    		$clientMessage = str_replace('[User Name]', $clientName, $message->message);

    		// Get the Moving from & Moving to addresses
    		

    		// Get the email template list
    	}

    	exit;
    }
}
