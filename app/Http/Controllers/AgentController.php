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
use App\EmailTemplate;
use App\StreetType;
use App\AgentClientMovingFromAddress;
use App\AgentClientMovingToAddress;
use App\AgentClientInvite;

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
    	// Get the country lists
    	$countries = Country::orderBy('name', 'asc')->get();

    	// Get the province lists
    	$provinces = Province::where(['status' => '1'])->select('id','abbreviation', 'name')->orderBy('name', 'asc')->get();

    	// Get the cities lists
    	$cities = City::where(['status' => '1'])->select('id', 'name')->orderBy('name', 'asc')->get();

    	// Get the street type lists
    	$streetTypes = StreetType::where(['status' => '1'])->select('id', 'type')->orderBy('type', 'asc')->get();

    	// Get the email template lists
    	$emailTemplates = EmailTemplate::where(['status' => '1'])->select('id', 'template_name')->orderBy('template_name', 'asc')->get();

		return view('agent/clients', ['countries' => $countries, 'provinces' => $provinces, 'cities' => $cities, 'streetTypes' => $streetTypes, 'emailTemplates' => $emailTemplates]);
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
                    7 => '<a href="javascript:void(0);" class="agent_invite_client" id="'. $agentClient->id .'" data-toggle="tooltip" title=""><i class="fa fa-envelope-o" aria-hidden="true"></i></a> &nbsp;&nbsp; <a href="javascript:void(0);" data-toggle="tooltip" title="" id="'. $agentClient->id .'" class="edit_client"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
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

    	// Get the company associated with the agent
    	$companyDetails = $agentDetails->company;

    	// Get the company categories list
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

    	// Get the message
    	$message = Message::where(['agent_id' => $userId])->first();

    	// Get the email template listing
    	$templates = EmailTemplate::where(['status' => '1'])->select('id', 'template_name')->get();

    	// Get the selected email template
    	$agentTemplate = $agentDetails->emailTemplate->first();

    	$agentTemplateContent = array();
    	if( count( $agentTemplate ) > 0 )
    	{
	    	// Get the selected template content
	    	$agentTemplateContent = EmailTemplate::where(['id' => $agentTemplate->id,'status' => '1'])->select('template_content')->first();
    	}

    	return view('agent/profile', ['agentDetails' => $agentDetails, 'cityArray' => $cityArray, 'provinces' => $provinces, 'countries' => $countries, 'companyCategories' => $companyCategories, 'companyDetails' => $companyDetails, 'message' => $message, 'templates' => $templates, 'agentTemplate' => $agentTemplate, 'agentTemplateContent' => $agentTemplateContent]);
    }

    /**
     * Function to save agent profile details
     * @param void
     * @return array
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
		        'agent_company_address.required' => 'Please enter company address',
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
			$user->twitter 		= $profileData['agent_twitter'];
			$user->linkedin 	= $profileData['agent_linkedin'];
			$user->facebook 	= $profileData['agent_facebook'];
			$user->website 		= $profileData['agent_website'];
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
					// Add the company details
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
     * Function to update the agent message
     * @param void
     * @return array
     */
    public function updateMssage() 
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $messageData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response = array();

		$validation = Validator::make(
		    array(
		        'agent_message'	=> $messageData['agent_message']
		    ),
		    array(
		        'agent_message'	=> array('required')
		    ),
		    array(
		        'agent_message.required' => 'Please enter message'
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
			$message = Message::where(['agent_id' => $userId, 'status' => '1'])->first();

			$message->message 	= $messageData['agent_message'];
			$message->updated_by= $userId;

			if( $message->save() )
			{
				$response['errCode']    = 0;
			    $response['errMsg']     = 'Message updated successfully';
			}
			else
			{
				$response['errCode']    = 2;
			    $response['errMsg']     = 'Some error in updating the message';
			}
		}

		return response()->json($response);
    }

    /**
     * Function to get the email template content
     * @param void
     * @return array
     */
    public function getEmailTemplateContent() 
    {
    	$templateId = Input::get('templateId');

    	$response = array();
    	if( $templateId != '' )
    	{
    		$emailTemplate = EmailTemplate::find($templateId);

    		if( count( $emailTemplate ) > 0 )
    		{
    			$response['errCode'] 	= 0;
    			$response['errMsg'] 	= 'Success';
    			$response['content'] 	= $emailTemplate->template_content;
    		}
    		else
    		{
    			$response['errCode'] 	= 1;
    			$response['errMsg'] 	= 'Error';
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to update agent email template
     * @param void
     * @return array
     */
    public function updateEmailTemplate()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $templateData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Get the logged in user id
        $userId = Auth::user()->id;

    	// Server Side Validation
        $response = array();

		$validation = Validator::make(
		    array(
		        'email_template' => $templateData['agent_email_template']
		    ),
		    array(
		        'email_template' => array('required')
		    ),
		    array(
		        'email_template.required' => 'Please select email template'
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

			// Save the email template or update if already exist
			$user->emailTemplate()->sync($templateData['agent_email_template']);

			$response['errCode']    = 0;
		    $response['errMsg']     = 'Template updated successfully';
		}

		return response()->json($response);
    }

    /**
     * Function to update agent image
     * @param void
     * @return array
     */
    public function updateAgentImage(Request $request)
    {
    	$agentImage = $request->file('fileData');

        // Get the logged in user id
        $userId = Auth::user()->id;

        $validation = Validator::make(
		    array(
		        'agentImage' => $agentImage
		    ),
		    array(
		        'agentImage' => array('required')
		    ),
		    array(
		        'agentImage.required' => 'Please select image to upload'
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
			$destinationPath = storage_path() . '/uploads/agents';

			if( $agentImage->isValid() )  // If the file is valid or not
			{
			    $fileExt  = $agentImage->getClientOriginalExtension();
			    $fileType = $agentImage->getMimeType();
			    $fileSize = $agentImage->getSize();

			    if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
			    {
			        // Rename the file
			        $fileNewName = str_random(10) . '.' . $fileExt;

			        if( $agentImage->move( $destinationPath, $fileNewName ) )
			        {
			        	// Update the image entry in table
			        	$user = User::find($userId);

			        	$user->image = $fileNewName;
			        	$user->updated_by = $userId;

			        	if( $user->save() )
			        	{
			        		$response['errCode']    = 0;
		        			$response['errMsg']     = 'Image uploaded successfully';
		        			$response['imgPath']    = url('/images/agents/' . $fileNewName);
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
    		// Check if the agent basic information is available or not as this information is required to show on the email
    		// If not, show a message to client to fill the basic information first and than invite the client
    		// The basic information include the name, address and the default message, as well as the email template

    		// Fetch the agent details
    		$agentDetails = User::find($userId);

    		// Fetch the agent message detail
    		$agentMessage = Message::where(['agent_id' => $userId])->select('id')->first();

    		// Fetch the agent email template detail
    		$agent = User::find($userId);
    		$agentEmailTemplate = $agent->emailTemplate->first();

    		if( $agentDetails->fname == '' || $agentDetails->address == '' || $agentDetails->province_id == '' || $agentDetails->city_id == '' || $agentDetails->postalcode == '' || $agentDetails->country_id == '' || $agentMessage == '' || $agentEmailTemplate == '' )
    		{
    			$response['errCode']    = 1;
		        $response['errMsg']     = 'Please fill the basic information including name, address, image and add the default message and email template!';
    		}
    		else
    		{
	    		// Get the message for the user
	    		$message = Message::where(['agent_id' => $userId, 'status' => '1'])->select('message')->first();

	    		// Get the client details
	    		$clientDetails = AgentClient::find($clientId);

	    		// From the client details, get the client name
	    		$clientName = trim( ucwords( strtolower( $clientDetails->fname . ' ' . $clientDetails->oname . ' ' . $clientDetails->lname ) ) );

	    		// Replace the [User Name] with the clinet name
	    		$clientMessage = str_replace('[User Name]', $clientName, $message->message);

	    		// Get the Moving from & Moving to addresses
	    		$movingFromAddress 	= AgentClientMovingFromAddress::where(['agent_client_id' => $clientId])->select('address', 'unit_type', 'unit_no', 'province_id', 'city_id', 'street_type_id','postalcode','country_id')->first();
    			$movingToAddress 	= AgentClientMovingToAddress::where(['agent_client_id' => $clientId])->select('address', 'unit_type', 'unit_no', 'province_id', 'city_id', 'street_type_id','postalcode','country_id', 'moving_date')->first();

    			// Get the default selected email template, if available
    			$user = User::find($userId);
    			$agentEmailTemplate = $user->emailTemplate->first();

	    		$response['errCode']    = 0;
		        $response['errMsg']     = 'Success';
		        $response['message']    = $clientMessage;
		        $response['oldAddress'] = $movingFromAddress;

		        if( count( $movingToAddress ) > 0 )
		        {
			        $response['newAddress'] = array(
			        	'address' 		=> $movingToAddress->address,
			        	'unit_type' 	=> $movingToAddress->unit_type,
			        	'unit_no' 		=> $movingToAddress->unit_no,
			        	'province_id' 	=> $movingToAddress->province_id,
			        	'city_id' 		=> $movingToAddress->city_id,
			        	'street_type_id'=> $movingToAddress->street_type_id,
			        	'postalcode' 	=> $movingToAddress->postalcode,
			        	'country_id' 	=> $movingToAddress->country_id,
			        	'moving_date' 	=> date('d-m-Y', strtotime($movingToAddress->moving_date))
			        );
		        }

		        $response['emailTemplate'] = 0;
		        if( count( $agentEmailTemplate ) > 0 )
		        {
		        	$response['emailTemplate'] = $agentEmailTemplate->id;
		        }
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to save the agent invitation details
     * @param void
     * @return array
     */
    public function saveInvitationDetails()
    {
    	// Get the serialized form data
        $frmData = Input::get('frmData');

        // Get the user choice, whether he/she want to update the default details or not
        $updateDefaultDetails = Input::get('updateDefaultDetails');

        // Parse the serialize form data to an array
        parse_str($frmData, $inviteDetails);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'client_old_address'	=> $inviteDetails['client_old_address'],
		        'client_old_unit_type'	=> $inviteDetails['client_old_unit_type'],
		        'client_old_province'	=> $inviteDetails['client_old_province'],
		        'client_old_city'		=> $inviteDetails['client_old_city'],
		        'client_old_postalcode'	=> $inviteDetails['client_old_postalcode'],
		        'client_old_country'	=> $inviteDetails['client_old_country'],
		        'client_new_address'	=> $inviteDetails['client_new_address'],
		        'client_new_unit_type'	=> $inviteDetails['client_new_unit_type'],
		        'client_new_province'	=> $inviteDetails['client_new_province'],
		        'client_new_city'		=> $inviteDetails['client_new_city'],
		        'client_new_postalcode'	=> $inviteDetails['client_new_postalcode'],
		        'client_new_country'	=> $inviteDetails['client_new_country'],
		        'client_moving_date'	=> $inviteDetails['client_moving_date'],
		        'client_message'		=> $inviteDetails['client_message'],
		        'client_email_template'	=> $inviteDetails['client_email_template']
		    ),
		    array(
		        'client_old_address'	=> array('required'),
		        'client_old_unit_type'	=> array('required'),
		        'client_old_province'	=> array('required'),
		        'client_old_city'		=> array('required'),
		        'client_old_postalcode'	=> array('required'),
		        'client_old_country'	=> array('required'),
		        'client_new_address'	=> array('required'),
		        'client_new_unit_type'	=> array('required'),
		        'client_new_province'	=> array('required'),
		        'client_new_city'		=> array('required'),
		        'client_new_postalcode'	=> array('required'),
		        'client_new_country'	=> array('required'),
		        'client_moving_date'	=> array('required'),
		        'client_message'		=> array('required'),
		        'client_email_template'	=> array('required')
		    ),
		    array(
		        'client_old_address.required'	=> 'Please enter address',
		        'client_old_unit_type.required'	=> 'Please select unit',
		        'client_old_province.required'	=> 'Please select province',
		        'client_old_city.required'		=> 'Please select city',
		        'client_old_postalcode.required'=> 'Please enter postalcode',
		        'client_old_country.required'	=> 'Please select country',
		        'client_new_address.required'	=> 'Please enter address',
		        'client_new_unit_type.required'	=> 'Please select unit',
		        'client_new_province.required'	=> 'Please select province',
		        'client_new_city.required'		=> 'Please select city',
		        'client_new_postalcode.required'=> 'Please enter postalcode',
		        'client_new_country.required'	=> 'Please select country',
		        'client_moving_date.required'	=> 'Please enter moving date',
		        'client_message.required'		=> 'Please enter message',
		        'client_email_template.required'=> 'Please select template'
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
			if( $updateDefaultDetails ) 	// Update the agent details and save the invitation details as well
			{
				// Check if the address exist. If exist, update it, otherwise insert it.
				$clientMovingFromAddress = AgentClientMovingFromAddress::where(['agent_client_id' => $inviteDetails['client_id']])->first();
				if( count( $clientMovingFromAddress ) == 0 )
				{
					$movingFromAddress = new AgentClientMovingFromAddress;

					$movingFromAddress->agent_client_id = $inviteDetails['client_id'];
					$movingFromAddress->address 		= $inviteDetails['client_old_address'];
					$movingFromAddress->unit_type 		= $inviteDetails['client_old_unit_type'];
					$movingFromAddress->unit_no 		= $inviteDetails['client_old_unit_no'];
					$movingFromAddress->province_id 	= $inviteDetails['client_old_province'];
					$movingFromAddress->city_id 		= $inviteDetails['client_old_city'];
					$movingFromAddress->street_type_id 	= $inviteDetails['client_old_street_type'];
					$movingFromAddress->postalcode 		= $inviteDetails['client_old_postalcode'];
					$movingFromAddress->country_id 		= $inviteDetails['client_old_country'];
					$movingFromAddress->status 			= '1';
					$movingFromAddress->created_by 		= $userId;

					$movingFromAddress->save();
				}
				else
				{
					$movingFromAddress = AgentClientMovingFromAddress::where(['agent_client_id' => $inviteDetails['client_id']])->first();

					$movingFromAddress->address 		= $inviteDetails['client_old_address'];
					$movingFromAddress->unit_type 		= $inviteDetails['client_old_unit_type'];
					$movingFromAddress->unit_no 		= $inviteDetails['client_old_unit_no'];
					$movingFromAddress->province_id 	= $inviteDetails['client_old_province'];
					$movingFromAddress->city_id 		= $inviteDetails['client_old_city'];
					$movingFromAddress->street_type_id 	= $inviteDetails['client_old_street_type'];
					$movingFromAddress->postalcode 		= $inviteDetails['client_old_postalcode'];
					$movingFromAddress->country_id 		= $inviteDetails['client_old_country'];
					$movingFromAddress->status 			= '1';
					$movingFromAddress->updated_by 		= $userId;

					$movingFromAddress->save();
				}

				$clientMovingToAddress = AgentClientMovingToAddress::where(['agent_client_id' => $inviteDetails['client_id']])->first();
				if( count( $clientMovingToAddress ) == 0 )
				{
					$movingToAddress = new AgentClientMovingToAddress;

					$movingToAddress->agent_client_id 	= $inviteDetails['client_id'];
					$movingToAddress->address 			= $inviteDetails['client_new_address'];
					$movingToAddress->unit_type 		= $inviteDetails['client_new_unit_type'];
					$movingToAddress->unit_no 			= $inviteDetails['client_new_unit_no'];
					$movingToAddress->province_id 		= $inviteDetails['client_new_province'];
					$movingToAddress->city_id 			= $inviteDetails['client_new_city'];
					$movingToAddress->street_type_id 	= $inviteDetails['client_new_street_type'];
					$movingToAddress->postalcode 		= $inviteDetails['client_new_postalcode'];
					$movingToAddress->country_id 		= $inviteDetails['client_new_country'];
					$movingToAddress->moving_date 		= date('Y-m-d', strtotime($inviteDetails['client_moving_date']));
					$movingToAddress->status 			= '1';
					$movingToAddress->created_by 		= $userId;

					$movingToAddress->save();
				}
				else
				{
					$movingToAddress = AgentClientMovingToAddress::where(['agent_client_id' => $inviteDetails['client_id']])->first();
					
					$movingToAddress->address 			= $inviteDetails['client_new_address'];
					$movingToAddress->unit_type 		= $inviteDetails['client_new_unit_type'];
					$movingToAddress->unit_no 			= $inviteDetails['client_new_unit_no'];
					$movingToAddress->province_id 		= $inviteDetails['client_new_province'];
					$movingToAddress->city_id 			= $inviteDetails['client_new_city'];
					$movingToAddress->street_type_id 	= $inviteDetails['client_new_street_type'];
					$movingToAddress->postalcode 		= $inviteDetails['client_new_postalcode'];
					$movingToAddress->country_id 		= $inviteDetails['client_new_country'];
					$movingToAddress->moving_date 		= date('Y-m-d', strtotime($inviteDetails['client_moving_date']));
					$movingToAddress->status 			= '1';
					$movingToAddress->updated_by 		= $userId;

					$movingToAddress->save();
				}
			}
			
			// Save the invitation details
			$agentClientInvite = new AgentClientInvite;

			$agentClientInvite->agent_id 			= $userId;
			$agentClientInvite->client_id 			= $inviteDetails['client_id'];
			$agentClientInvite->email_template_id 	= $inviteDetails['client_email_template'];
			$agentClientInvite->message_content 	= $inviteDetails['client_message'];
			$agentClientInvite->email_url 			= '';
			if( $inviteDetails['client_invitation_schedule_date'] != '' )
			{
				$agentClientInvite->schedule_status 	= '1';
				$agentClientInvite->schedule_datetime 	= date('Y-m-d', strtotime($inviteDetails['client_invitation_schedule_date']));
			}
			else
			{
				$agentClientInvite->schedule_status 	= '0';	
			}
			$agentClientInvite->status 				= '0';
			$agentClientInvite->created_at	 		= date('Y-m-d H:i:s');
			$agentClientInvite->created_by	 		= $userId;

			$agentClientInvite->save();

			$lastInviteId = $agentClientInvite->id;

			if( !is_null($lastInviteId)  )
			{
				// Create the email link
				if( app()->env == 'local' )
				{
					$emailLink = config('constants.LOCAL_APP_URL') . '/movers/authenticate?agent_id='. base64_encode($userId) .'&client_id='. base64_encode($inviteDetails['client_id']) .'&invitation_id=' . base64_encode($agentClientInvite->id);
				}
				else
				{
					$emailLink = config('constants.SERVER_APP_URL') . '/movers/authenticate?agent_id='. base64_encode($userId) .'&client_id='. base64_encode($inviteDetails['client_id']) .'&invitation_id=' . base64_encode($agentClientInvite->id);
				}

				// Update the email link
				$agentClientInvite = AgentClientInvite::find($lastInviteId);

				$agentClientInvite->email_url = $emailLink;
				
				$agentClientInvite->save();
			}

			$response['errCode']    = 0;
		    $response['errMsg']     = 'Invitation details updated successfully';
		}

		return response()->json($response);
    }
}
