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
use App\AgentPartner;
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
use App\ForgotPassword;
use App\EmailTemplateCategory;
use App\AgentClientRating;
use App\PaymentPlanSubscription;

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

		        	// Check if a valid payment plan exit or not
		        	$currDate = date('Y-m-d');

		        	$paymentPlanSubscription = 	PaymentPlanSubscription::where(['plan_type_id' => '1', 'subscriber_id' => $user->id, 'status' => '1'])
		        								->where('start_date', '<=', $currDate)
    											->where('end_date', '>=', $currDate)
    											->first();

    				if( count( $paymentPlanSubscription ) > 0 )
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
    					$response['errCode']    = 5;
	           			$response['errMsg']     = 'Your payment plan expired, please purchase a new plan';
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
     * Function for Change Password
     * @param void
     * @return array
     */
    public function getchangepassword()
    {
        return view('agent/changepassword');
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
     * Function to return dashboard view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
    	// Get the logged in user id
        $userId = Auth::user()->id;
    	
    	// Get the client count associated with the logged-in agent
    	$clientCount = AgentClient::where(['agent_id' => $userId])->count();

    	// Get the invite count send by the logged-in agent
    	$inviteCount = AgentClientInvite::where(['agent_id' => $userId])->count();

    	// Get the total accepted invite
		$acceptedInviteCount = AgentClientInvite::where(['agent_id' => $userId, 'status' => '2'])->count();		// status: 2 for email read or invitation accepted

    	// Get the reviews count for the agent
    	$agnetRating = AgentClientRating::where(['agent_id' => $userId])->groupBy('agent_id')->select(DB::raw('sum(rating) as rating'))->first();

    	// Get the client listing that is in critical zone
    	$criticalZone 	= date('Y-m-d', strtotime('+60 days'));
    	$criticalZoneClients = AgentClient::where(['agent_id' => $userId])->where('possession_date', '<=', $criticalZone)->count();

    	return view('agent/dashboard', ['clientCount' => $clientCount, 'inviteCount' => $inviteCount, 'acceptedInviteCount' => $acceptedInviteCount, 'agnetRating' => $agnetRating, 'criticalZoneClients' => $criticalZoneClients]);
    }

    /**
     * Function to return Email Preview
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function emailPreview()
    {
        $emailTemplateId = Input::get('emailTemplateId');
        $clientId = Input::get('clientId');

        // Get the email template content
        $emailTemplate = EmailTemplate::where(['id' => $emailTemplateId])->first();

        if( count( $emailTemplate ) > 0 )
        {
	        $emailTemplatePreview = $emailTemplate->template_content_to_send;

	        // Get the client details
	        $clientDetails = AgentClient::find($clientId);

	        if( count( $clientDetails ) > 0 )
	        {
	        	// Replace the [firstname] with the client first name
	        	$emailTemplatePreview = str_replace('[firstname]', ucwords( strtolower( $clientDetails->fname ) ), $emailTemplatePreview);

	        	// Replace the get_started_link https://www.udistro.ca/ link with javascript:void(0) so that it can't be clickable
				$emailTemplatePreview = str_replace('https://www.udistro.ca/', 'javascript:void(0);', $emailTemplatePreview);
	        }

	        $response['errCode'] 	= 0;
	        $response['errMsg']  	= 'Success';
	        $response['preview']	= $emailTemplatePreview;
        }
        else
        {
        	$response['errCode'] 	= 1;
	        $response['errMsg']  	= 'Error';
        }

        return response()->json($response);
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
    	$emailTemplates = EmailTemplate::where(['category_id' => 1, 'status' => '1'])->select('id', 'template_name')->orderBy('template_name', 'asc')->get();

		return view('agent/clients', ['countries' => $countries, 'provinces' => $provinces, 'cities' => $cities, 'streetTypes' => $streetTypes, 'emailTemplates' => $emailTemplates]);
    }

    /**
     * Function to show agent invites listing page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function invites()
    {

		return view('agent/invites');
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
				// Check if email & mobile number already exist
				$agent = AgentClient::where(['email' => $clientData['client_email']])->orWhere(['contact_number' => $clientData['client_number']])->first();

				if( count( $agent ) == 0 )
				{
					// Save the client details
					$agentClient = new AgentClient;

					$agentClient->agent_id 			= $userId;
					$agentClient->fname 			= $clientData['client_fname'];
					$agentClient->oname 			= '';
					$agentClient->lname 			= $clientData['client_lname'];
					$agentClient->email 			= $clientData['client_email'];
					$agentClient->contact_number 	= $clientData['client_number'];
					$agentClient->possession_date 	= date('Y-m-d', strtotime( $clientData['client_possession_date'] ));
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
					// Email exist
					if( $agent->email == $clientData['client_email'] )
					{
						$response['errCode']    = 4;
					    $response['errMsg']     = 'Email id already exist';
					}
					// Mobile exist
					else if( $agent->contact_number == $clientData['client_number'] )
					{
						$response['errCode']    = 5;
					    $response['errMsg']     = 'Contact number already exist';	
					}
				}
			}
			else
			{
				// Update the client details
				$agentClient = AgentClient::find($clientData['client_id']);

				// Check if the the client is associated with the agent or not

				if( $userId == $agentClient->agent_id )
				{
					// Check if the email id already exist
					$emailExist = AgentClient::where('id', '!=', $clientData['client_id'])->where(['email' => $clientData['client_email']])->first();

					if( count( $emailExist ) == 0 )
					{
						$agentClient->agent_id 			= $userId;
						$agentClient->fname 			= $clientData['client_fname'];
						$agentClient->lname 			= $clientData['client_lname'];
						$agentClient->oname 			= '';
						$agentClient->email 			= $clientData['client_email'];
						$agentClient->contact_number 	= $clientData['client_number'];
						$agentClient->possession_date 	= date('Y-m-d', strtotime( $clientData['client_possession_date'] ));
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
						$response['errCode']    = 3;
						$response['errMsg']     = 'Email id already exist';
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
            2 => 'lname',
            5 => 'possession_date',
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
                    ->select('id', 'fname', 'lname', 'oname', 'email', 'contact_number', 'status', 'possession_date')
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
            	if( $agentClient->possession_date != '0000-00-00' )
            	{
	            	// Show the posession date in red color
	            	$criticalZone 	= date('d-m-Y', strtotime('+45 days'));
	            	$possessionDate = date('d-m-Y', strtotime( $agentClient->possession_date ));
	            	$style = '';
	            	if( $criticalZone >= $possessionDate )
	            	{
	            		$style = 'style="color: red"';
	            	}
            	}
            	else
            	{
            		$possessionDate = 'NA';
            	}
 
            	$response['aaData'][$k] = array(
                    0 => $agentClient->id,
                    1 => ucfirst( strtolower( $agentClient->fname ) ),
                    2 => ucfirst( strtolower( $agentClient->lname ) ),
                    3 => $agentClient->email,
                    4 => $agentClient->contact_number,
                    5 => '<span '. $style .'>' . $possessionDate . '</span>',
                    6 => Helper::getStatusText($agentClient->status),
                    7 => '<a href="javascript:void(0);" class="agent_invite_client" id="'. $agentClient->id .'" data-toggle="tooltip" title=""><i class="fa fa-envelope-o" aria-hidden="true"></i></a>',
                    8 => '<a href="javascript:void(0);" data-toggle="tooltip" title="" id="'. $agentClient->id .'" class="edit_client"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to fetch the invited clients list and show in datatable
     * @param void
     * @return array
     */
    public function fetchInvitedClients()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

        // Get the logged in user id
        $userId = Auth::user()->id;

        $agentClients = DB::table('agent_clients as t1')
        				->leftJoin('agent_client_invites as t2', 't1.id', '=', 't2.client_id')
        				->limit(10)
        				->offset(0)
        				->where(['t2.agent_id' => $userId])
        				->select('t1.id', 't1.fname', 't1.lname', 't1.oname', 't1.email', 't1.contact_number', 't1.status')
        				->get();

        $iTotal = 0;

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
                    0 => $k + 1,
                    1 => ucfirst( strtolower( $agentClient->fname ) ),
                    2 => ucfirst( strtolower( $agentClient->lname ) ),
                    3 => $agentClient->email,
                    4 => $agentClient->contact_number,
                    5 => Helper::getStatusText($agentClient->status)
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to fetch the clients invites and show in datatable
     * @param void
     * @return array
     */
    public function fetchInvites()
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
       	$invites = DB::select(
                        DB::raw("SELECT t1.id, t2.fname, t2.lname, t2.email, t1.status 
                        	FROM agent_client_invites t1 
                        	LEFT JOIN agent_clients t2 ON t1.client_id = t2.id 
                        	LEFT JOIN email_templates as t3 ON t1.email_template_id = t3.id
                        	WHERE ( t1.agent_id = ".$userId." ) ORDER BY " . $sortBy . " " . $sortType ." LIMIT ".$start.", ".$length
                        )
                    );

       	// Get the total count without any condition to maintian the pagination
        $inviteCount = DB::select(
                            DB::raw("SELECT t1.id FROM agent_client_invites t1 LEFT JOIN agent_clients t2 ON t1.client_id = t2.id LEFT JOIN email_templates as t3 ON (t1.email_template_id = t3.id) WHERE (  t1.agent_id = " . $userId . ")")
                        );

        // Assign it to the datatable pagination variable
        $iTotal = count($inviteCount);

        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $invites ) > 0 )
        {
            foreach ($invites as $invite)
            {
                $response['aaData'][$k] = array(
                    0 => $invite->id,
                    1 => ucfirst( strtolower( $invite->fname ) ),
                    2 => ucfirst( strtolower( $invite->lname ) ),
                    3 => ucfirst( strtolower( $invite->email ) ),
                    4 => Helper::getInviteStatus($invite->status),
                    // 5 => Helper::getInviteScheduleStatus($invite->schedule_status),
                    5 => Helper::getInviteStatusAtClient($invite->id),
                    6 => '<a title="View Details" href="javascript:void(0);" id="'. $invite->id .'" class="view_invite"><i class="fa fa-eye" aria-hidden="true"></i></a> | <a title="Resend" href="javascript:void(0);" id="'. $invite->id .'" class="resend_invite"><i class="fa fa-send-o"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to resend invitation email
     * @param void
     * @return array
     */
    public function resendEmail()
    {
    	$inviteId = Input::get('inviteId');

    	// Change the schedule_status to '0', schedule_date to NULL, authentication to '0', status to '0'
    	$response = array();
    	if( AgentClientInvite::where(['id' => $inviteId])->update(['schedule_status' => '0', 'schedule_date' => NULL, 'authentication' => '0', 'status' => '0']) )
    	{
    		$response['errCode']    = 0;
			$response['errMsg']     = 'Email sent successfully';
    	}
    	else
    	{
    		$response['errCode']    = 1;
			$response['errMsg']     = 'Some issue';
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
			    	// 'mname' 	=> $clientDetails->oname,
			    	'lname' 	=> $clientDetails->lname,
			    	'email' 	=> $clientDetails->email,

			    	'possession_date' => ( $clientDetails->possession_date != '0000-00-00' ) ? date('d-m-Y', strtotime($clientDetails->possession_date)) : '',
			    	
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
     * Function get the details of the selected invite
     * @param void
     * @return array
     */
    public function getInviteDetails()
    {
        $inviteId = Input::get('inviteId');

        // Get the logged in user id
        $userId = Auth::user()->id;

        $response = array();
        if( $inviteId != '' )
        {
            // Get the invite details
            $inviteArray  = DB::table('client_activity_lists')
                                ->leftJoin('client_activity_logs', function ($join) use($inviteId) {
                                    $join->on('client_activity_lists.id', '=', 'client_activity_logs.activity_id')
                                         ->where('client_activity_logs.invitation_id', '=', $inviteId);
                                })
                                ->select('client_activity_lists.activity', 'client_activity_logs.action')
                                ->get();

            $html = '<table class="table"><thead><tr><th style="text-align: center;">#</th><th>Activity Name</th><th>Action</th></tr></thead><tbody>';
            //echo '<pre>'; print_r($inviteArray); die('a');
            foreach ($inviteArray as $key => $invities)
            {
                $html.= '<tr><td style="text-align: center;">'.($key + 1).'</td><td>'.ucwords($invities->activity).'</td><td>'.Helper::getInviteAction($invities->action).'</td></tr>';
            }
            $html.= '</tbody></table>';
        }

        return response()->json(array('html' => $html));
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
    	$companyDetails = $agentDetails->company->first();

    	// Get the company categories list
    	$companyCategories = CompanyCategory::where(['status' => '1'])->get();

        // Get the country list
    	$countries = Country::select('id', 'name')->orderBy('name', 'asc')->get();

       	// Get the province list
        $provinces  = Province::where(['status' => '1'])->orderBy('name', 'asc')->select('id', 'abbreviation', 'name')->get();

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
	    	$agentTemplateContent = EmailTemplate::where(['id' => $agentTemplate->id,'status' => '1'])->select('template_content_to_send')->first();
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
		        'agent_fname'	        => $profileData['agent_fname'],
		        'agent_lname'		    => $profileData['agent_lname'],
		    ),
		    array(
		        'agent_fname' 	        => array('required'),
		        'agent_lname' 	        => array('required'),
		    ),
		    array(
		        'agent_fname.required' 	         => 'Please enter first name',
		        'agent_lname.required' 	         => 'Please enter last name',
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

			$user->fname 		 = $profileData['agent_fname'];			
			$user->lname 		 = $profileData['agent_lname'];
            $user->gender        = $profileData['gender'];
            $user->business_name = $profileData['agent_bname'];
			$user->updated_by 	 = $userId;

			if( $user->save() )
			{

				$response['errCode']    = 0;
			    $response['errMsg']     = 'Profile info updated successfully';
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
     * Function to save agent contact details
     * @param void
     * @return array
     */
    public function saveContactDetails() 
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
                'agent_email'            => $profileData['agent_email'],
                'phone_number'           => $profileData['phone_number'],
            ),
            array(
                'agent_email'           => array('required', 'email'),
                'phone_number'          => array('required'),
            ),
            array(
                'agent_email.required'           => 'Please enter first name',
                'agent_email.email'              => 'Please enter valid email',
                'phone_number.required'          => 'Please enter phone number',
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

            $user->email            = $profileData['agent_email'];         
            $user->phone_number     = $profileData['phone_number'];
            $user->extension_number = $profileData['ex_number'];
            $user->fax              = $profileData['fax'];
            $user->website          = $profileData['agent_website'];
            $user->updated_by       = $userId;

            if( $user->save() )
            {

                $response['errCode']    = 0;
                $response['errMsg']     = 'Contact info updated successfully';
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
     * Function to save agent address details
     * @param void
     * @return array
     */
    public function saveAddressDetails() 
    {
        // Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $profileData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response = array();

        $validation = Validator::make(
            array(
                'agent_address1'   => $profileData['agent_address1'],
                'agent_city'       => $profileData['agent_city'],
                'agent_country'    => $profileData['agent_country'],
                'agent_province'   => $profileData['agent_province'],
                'agent_postalcode' => $profileData['agent_postalcode']
            ),
            array(
                'agent_address1'    => array('required'),
                'agent_city'        => array('required'),
                'agent_country'     => array('required'),
                'agent_province'    => array('required'),
                'agent_postalcode'  => array('required')
            ),
            array(
                'agent_address1.required'   => 'Please enter company address',
                'agent_city.required'       => 'Please select city',
                'agent_country.required'    => 'Please select country',
                'agent_province.required'   => 'Please select province',
                'agent_postalcode.required' => 'Please enter postal code'
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

            $user->address1      = $profileData['agent_address1'];
            $user->address2      = $profileData['agent_address2'];
            $user->city_id       = $profileData['agent_city'];
            $user->province_id   = $profileData['agent_province'];
            $user->postalcode    = $profileData['agent_postalcode'];
            $user->country_id    = $profileData['agent_country'];
            $user->updated_by    = $userId;

            if( $user->save() )
            {

                $response['errCode']    = 0;
                $response['errMsg']     = 'Address info updated successfully';
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
     * Function to save agent social details
     * @param void
     * @return array
     */
    public function saveSocialDetails() 
    {
        // Get the serialized form data
        $frmData = Input::get('frmData');

        // Parse the serialize form data to an array
        parse_str($frmData, $profileData);

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response = array();

        $user = User::find($userId);

        $user->twitter      = $profileData['agent_twitter'];
        $user->linkedin     = $profileData['agent_linkedin'];
        $user->skype        = $profileData['agent_skype'];
        $user->facebook     = $profileData['agent_facebook'];
        $user->gplus        = $profileData['agent_gplus'];
        $user->instagram    = $profileData['agent_instagram'];
        $user->updated_by   = $userId;

        if( $user->save() )
        {
            $response['errCode']    = 0;
            $response['errMsg']     = 'Social info updated successfully';
        }
        else
        {
            $response['errCode']    = 2;
            $response['errMsg']     = 'Some error in updating the details';
        }

        return response()->json($response);
    }

    /**
     * Function to save agent company details
     * @param void
     * @return array
     */
    public function saveCompanyDetails() 
    {
        // Get the serialized form data
        $agent_company_name         = Input::get('agent_company_name');
        $agent_company_category     = Input::get('agent_company_category');
        $agent_company_address      = Input::get('agent_company_address');
        $agent_company_province     = Input::get('agent_company_province');
        $agent_company_city         = Input::get('agent_company_city');
        $agent_company_postalcode   = Input::get('agent_company_postalcode');
        $agent_company_country      = Input::get('agent_company_country');
        $companyImage               = Input::file('fileData');
        //echo '<pre>'; print_r($agent_company_category); print_r($agent_company_province); print_r($agent_company_country); print_r($agent_company_category); die();
        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server Side Validation
        $response = array();

        $validation = Validator::make(
            array(
                'agent_company_name'    => $agent_company_name,
                'agent_company_address' => $agent_company_address,
            ),
            array(
                'agent_company_name'    => array('required'),
                'agent_company_address' => array('required'),
            ),
            array(
                'agent_company_name.required'    => 'Please enter company name',
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
                        $fileNewName = str_random(40) . '.' . $fileExt;

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


            $user = User::find($userId);
            if($response['errCode'] == 1 || $response['errCode'] == 2)
            {
                if( count( $user->company ) > 0 && isset( $user->company[0]->id ) )
                {
                    // Update the company details also
                    $companyDetails = Company::find($user->company[0]->id);

                    $companyDetails->company_name = $agent_company_name;
                    $companyDetails->company_category_id = $agent_company_category;
                    $companyDetails->address = $agent_company_address;
                    $companyDetails->province_id = $agent_company_province;
                    $companyDetails->city_id = $agent_company_city;
                    $companyDetails->postal_code = $agent_company_postalcode;
                    $companyDetails->country_id = $agent_company_country;
                    if($response['errCode'] == 1)
                    {
                        $companyDetails->image    = $fileNewName;
                        $response['image']  = URL::to('/').'/images/company/'.$fileNewName;
                    }

                    $companyDetails->save();
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Company info updated successfully';
                }
                else
                {
                    // Add the company details
                    $companyDetails = new Company;

                    $companyDetails->company_name = $agent_company_name;
                    $companyDetails->company_category_id = $agent_company_category;
                    $companyDetails->address = $agent_company_address;
                    $companyDetails->province_id = $agent_company_province;
                    $companyDetails->city_id = $agent_company_city;
                    $companyDetails->postal_code = $agent_company_postalcode;
                    $companyDetails->country_id = $agent_company_country;
                    if($response['errCode'] == 1)
                    {
                        $companyDetails->image    = $fileNewName;
                        $response['image']  = URL::to('/').'/images/company/'.$fileNewName;
                    }

                    $companyDetails->save();
                    $response['errCode']    = 0;
                    $response['errMsg']     = 'Company info updated successfully';
                }
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
     * Function to update agent image
     * @param void
     * @return array
     */
    public function updateAgentCompanyImage(Request $request)
    {
    	$agentImage = $request->file('fileData');

        // Get the logged in user id
        $userId = Auth::user()->id;

        // Get the company for the logged-in agent
        $user = User::find($userId);
        $userCompany = $user->company->first();

        if( count( $userCompany ) > 0 )
        {
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
				$destinationPath = storage_path() . '/uploads/company';

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
				        	$userCom = Company::find($userCompany->id);

				        	$userCom->image = $fileNewName;
				        	$userCom->updated_by = $userId;

				        	if( $userCom->save() )
				        	{
				        		$response['errCode']    = 0;
			        			$response['errMsg']     = 'Image uploaded successfully';
			        			$response['imgPath']    = url('images/company') . '/' .  $fileNewName;
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
        }
        else
        {
        	$response['errCode']    = 6;
			$response['errMsg']     = 'Missing company details';
        }

		return response()->json($response);
    }

    /**
     * Function to return email template listing view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function emailTemplates()
    {
    	// Get the email template categories
    	$emailTemplateCategories = EmailTemplateCategory::where(['status' => '1'])->select('id', 'name')->orderBy('id', 'asc')->get();

    	// Get the logged in agent id
    	$userId = Auth::user()->id;

    	// Get the client name and their email list
    	$clients = agentClient::where(['agent_id' => $userId])->select('id', 'fname', 'lname', 'email')->orderBy('fname', 'asc')->get();

        return view('agent/emailTemplates', ['emailTemplateCategories' => $emailTemplateCategories, 'clients' => $clients]);
    }

    /**
     * Function to show the email template list in datatable
     * @param void
     * @return array
     */
    public function fetchEmailTemplates()
    {
        $start      = Input::get('iDisplayStart');      // Offset
        $length     = Input::get('iDisplayLength');     // Limit
        $sSearch    = Input::get('sSearch');            // Search string
        $col        = Input::get('iSortCol_0');         // Column number for sorting
        $sortType   = Input::get('sSortDir_0');         // Sort type

        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'template_name',
            3 => 'status',
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];
        $userId = Auth::user()->id;

        // Get the records after applying the datatable filters
        $emailTemplates = EmailTemplate::where('template_name','like', '%'.$sSearch.'%')
                        ->orderBy($sortBy, $sortType)
                        ->limit($length)
                        ->offset($start)
                        ->where('created_by', '=', $userId)
                        ->select('id', 'template_name', 'template_content', 'status')
                        ->get();

        $iTotal = EmailTemplate::where('template_name','like', '%'.$sSearch.'%')->where('created_by', '=', $userId)->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $emailTemplates ) > 0 )
        {
            foreach ($emailTemplates as $emailTemplates)
            {
                $response['aaData'][$k] = array(
                    0 => $emailTemplates->id,
                    1 => ucfirst( strtolower( $emailTemplates->template_name ) ),
                    2 => '<div><a href="javascript:void(0);" class="datatable_template_check_preview">Check Preview</a><div class="datatable_template_preview" style="display:none;">'. $emailTemplates->template_content .'</div></div>',
                    3 => Helper::getStatusText($emailTemplates->status),
                    4 => '<a href="javascript:void(0);" id="'. $emailTemplates->id .'" class="edit_email_template"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to get the details of selected email template
     * @param void
     * @return array
     */
    public function getEmailTemplateDetails()
    {
        $templateId = Input::get('templateId');

        $response = array();
        if( $templateId != '' )
        {
            $templateDetails = EmailTemplate::find($templateId);

            if( count( $templateDetails ) > 0 )
            {
                $response['id']                 = $templateDetails->id;
                $response['template_name']      = $templateDetails->template_name;
                $response['template_content']   = $templateDetails->template_content;
                $response['status']             = $templateDetails->status;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save the email template details
     * @param void
     * @return array
     */
    public function saveEmailTemplate()
    {
        $emailCategoryId 	= Input::get('emailCategoryId');
        $templateName 		= Input::get('templateName');
        
        $htmlContentToView 	= Input::get('htmlContentToView');
        $htmlContentToSend 	= Input::get('htmlContentToSend');

        // Get the logged in user id
        $userId = Auth::user()->id;

        $response =array();

        // Server side validation
        $validation = Validator::make(
            array(
                'email_template_name'   => $templateName,
                'email_template_content'=> $htmlContentToSend
            ),
            array(
                'email_template_name'   => array('required'),
                'email_template_content'=> array('required')
            ),
            array(
                'email_template_name.required'      => 'Please enter template name',
                'email_template_content.required'   => 'Please enter some content'
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
        	// Get the logged-in user id
			$userId = Auth::id();

			// Check check whether they have remaining email quota, if yes decrement the count by 1
			if( Helper::manageEmailQuota($userId, 1) )
			{
	            // Check if the same email template already exist
	            $templateExist = EmailTemplate::where(['template_name' => $templateName])->first();

	            if( count( $templateExist ) == 0 )
	            {
	                $emailTemplate = new EmailTemplate;

	                $emailTemplate->template_name   = $templateName;
	                $emailTemplate->template_content_to_send = $htmlContentToSend;
	                $emailTemplate->template_content_to_view = $htmlContentToView;
	                $emailTemplate->category_id 	= $emailCategoryId;
	                $emailTemplate->status          = '1';
	                $emailTemplate->created_by      = $userId;

	                if( $emailTemplate->save() )
	                {
	                    $response['errCode']    = 0;
	                    $response['errMsg']     = 'Email template saved successfully';
	                }
	                else
	                {
	                    $response['errCode']    = 2;
	                    $response['errMsg']     = 'Some error in saving email template';
	                }
	            }
	            else
	            {
	                $response['errCode']    = 3;
	                $response['errMsg']     = 'Email template already exist with the same name';
	            }
			}
			else
			{
				$response['errCode']    = 3;
	            $response['errMsg']     = 'Your payment plan subscription is expired';
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
    		// $agentDetails = User::find($userId);

    		// Fetch the agent message detail
    		// $agentMessage = Message::where(['agent_id' => $userId])->select('id')->first();

    		// Fetch the agent email template detail
    		$agent = User::find($userId);

    		// $agentEmailTemplate = $agent->emailTemplate->first();

    		// Get the message for the user
    		// $message = Message::where(['agent_id' => $userId, 'status' => '1'])->select('message')->first();

    		// Get the client details
    		$clientDetails = AgentClient::find($clientId);

    		// From the client details, get the client name
    		// $clientName = trim( ucwords( strtolower( $clientDetails->fname . ' ' . $clientDetails->oname . ' ' . $clientDetails->lname ) ) );

    		// Replace the [User Name] with the clinet name
    		// $clientMessage = str_replace('[User Name]', $clientName, $message->message);

    		// Get the Moving from & Moving to addresses
    		$movingFromAddress 	= AgentClientMovingFromAddress::where(['agent_client_id' => $clientId])->select('address1', 'address2', 'province_id', 'city_id', 'postal_code', 'country_id')->first();

			$movingToAddress 	= AgentClientMovingToAddress::where(['agent_client_id' => $clientId])->select('address1', 'address2', 'province_id', 'city_id', 'postal_code', 'country_id', 'moving_date')->first();

			// Get the default selected email template, if available
			// $user = User::find($userId);
			// $agentEmailTemplate = $user->emailTemplate->first();

    		$response['errCode']    = 0;
	        $response['errMsg']     = 'Success';

	        if( count( $movingFromAddress ) > 0 )
	        {
		        $response['oldAddress'] = array(
		        	'address1' 		=> $movingFromAddress->address1,
                    'address2'   	=> $movingFromAddress->address2,
		        	'province_id' 	=> $movingFromAddress->province_id,
		        	'city_id' 		=> $movingFromAddress->city_id,
		        	'postal_code' 	=> $movingFromAddress->postal_code,
		        	'country_id' 	=> $movingFromAddress->country_id,
		        );
	        }

	        if( count( $movingToAddress ) > 0 )
	        {
		        $response['newAddress'] = array(
		        	'address1' 		=> $movingToAddress->address1,
                    'address2'      => $movingToAddress->address2,
		        	'province_id' 	=> $movingToAddress->province_id,
		        	'city_id' 		=> $movingToAddress->city_id,
		        	'postal_code' 	=> $movingToAddress->postal_code,
		        	'country_id' 	=> $movingToAddress->country_id,
		        	'moving_date' 	=> date('d-m-Y', strtotime($movingToAddress->moving_date))
		        );
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
		        'client_old_address'	=> $inviteDetails['client_old_address1'],
		        'client_old_province'	=> $inviteDetails['client_old_province'],
		        'client_old_city'		=> $inviteDetails['client_old_city'],
		        'client_old_postalcode'	=> $inviteDetails['client_old_postalcode'],
		        'client_old_country'	=> $inviteDetails['client_old_country'],
		        'client_new_address'	=> $inviteDetails['client_new_address1'],
		        'client_new_province'	=> $inviteDetails['client_new_province'],
		        'client_new_city'		=> $inviteDetails['client_new_city'],
		        'client_new_postalcode'	=> $inviteDetails['client_new_postalcode'],
		        'client_new_country'	=> $inviteDetails['client_new_country'],
		        'client_moving_date'	=> $inviteDetails['client_moving_date'],
		        'client_email_template'	=> $inviteDetails['client_email_template']
		    ),
		    array(
		        'client_old_address'	=> array('required'),
		        'client_old_province'	=> array('required'),
		        'client_old_city'		=> array('required'),
		        'client_old_postalcode'	=> array('required'),
		        'client_old_country'	=> array('required'),
		        'client_new_address'	=> array('required'),
		        'client_new_province'	=> array('required'),
		        'client_new_city'		=> array('required'),
		        'client_new_postalcode'	=> array('required'),
		        'client_new_country'	=> array('required'),
		        'client_moving_date'	=> array('required'),
		        'client_email_template'	=> array('required')
		    ),
		    array(
		        'client_old_address.required'	=> 'Please enter old address line 1',
		        'client_old_province.required'	=> 'Please select province',
		        'client_old_city.required'		=> 'Please select city',
		        'client_old_postalcode.required'=> 'Please enter postalcode',
		        'client_old_country.required'	=> 'Please select country',
		        'client_new_address.required'	=> 'Please enter new address line 1',
		        'client_new_province.required'	=> 'Please select province',
		        'client_new_city.required'		=> 'Please select city',
		        'client_new_postalcode.required'=> 'Please enter postalcode',
		        'client_new_country.required'	=> 'Please select country',
		        'client_moving_date.required'	=> 'Please enter moving date',
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
					$movingFromAddress->address1 		= $inviteDetails['client_old_address1'];
                    $movingFromAddress->address2        = $inviteDetails['client_old_address2'];
					$movingFromAddress->province_id 	= $inviteDetails['client_old_province'];
					$movingFromAddress->city_id 		= $inviteDetails['client_old_city'];
					$movingFromAddress->postal_code 	= $inviteDetails['client_old_postalcode'];
					$movingFromAddress->country_id 		= $inviteDetails['client_old_country'];
					$movingFromAddress->status 			= '1';
					$movingFromAddress->created_by 		= $userId;

					$movingFromAddress->save();
				}
				else
				{
					$movingFromAddress = AgentClientMovingFromAddress::where(['agent_client_id' => $inviteDetails['client_id']])->first();

					$movingFromAddress->agent_client_id = $inviteDetails['client_id'];
                    $movingFromAddress->address1        = $inviteDetails['client_old_address1'];
                    $movingFromAddress->address2        = $inviteDetails['client_old_address2'];
                    $movingFromAddress->province_id     = $inviteDetails['client_old_province'];
                    $movingFromAddress->city_id         = $inviteDetails['client_old_city'];
                    $movingFromAddress->postal_code     = $inviteDetails['client_old_postalcode'];
                    $movingFromAddress->country_id      = $inviteDetails['client_old_country'];
                    $movingFromAddress->status          = '1';
                    $movingFromAddress->updated_by      = $userId;

					$movingFromAddress->save();
				}

				$clientMovingToAddress = AgentClientMovingToAddress::where(['agent_client_id' => $inviteDetails['client_id']])->first();
				if( count( $clientMovingToAddress ) == 0 )
				{
					$movingToAddress = new AgentClientMovingToAddress;

					$movingToAddress->agent_client_id 	= $inviteDetails['client_id'];
					$movingToAddress->address1 			= $inviteDetails['client_new_address1'];
                    $movingToAddress->address2          = $inviteDetails['client_new_address2'];
					$movingToAddress->province_id 		= $inviteDetails['client_new_province'];
					$movingToAddress->city_id 			= $inviteDetails['client_new_city'];
					$movingToAddress->postal_code 		= $inviteDetails['client_new_postalcode'];
					$movingToAddress->country_id 		= $inviteDetails['client_new_country'];
					$movingToAddress->moving_date 		= date('Y-m-d', strtotime($inviteDetails['client_moving_date']));
					$movingToAddress->status 			= '1';
					$movingToAddress->created_by 		= $userId;

					$movingToAddress->save();
				}
				else
				{
					$movingToAddress = AgentClientMovingToAddress::where(['agent_client_id' => $inviteDetails['client_id']])->first();
					
					$movingToAddress->agent_client_id  = $inviteDetails['client_id'];
                    $movingToAddress->address1          = $inviteDetails['client_new_address1'];
                    $movingToAddress->address2          = $inviteDetails['client_new_address2'];
                    $movingToAddress->province_id       = $inviteDetails['client_new_province'];
                    $movingToAddress->city_id           = $inviteDetails['client_new_city'];
                    $movingToAddress->postal_code       = $inviteDetails['client_new_postalcode'];
                    $movingToAddress->country_id        = $inviteDetails['client_new_country'];
                    $movingToAddress->moving_date       = date('Y-m-d', strtotime($inviteDetails['client_moving_date']));
                    $movingToAddress->status            = '1';
                    $movingToAddress->created_by        = $userId;

					$movingToAddress->save();
				}
			}

			// Replace the [firstname] with the mover's first name
			$clientDetails = AgentClient::find($inviteDetails['client_id']);

			// Get the email template content
			$emailTemplate = EmailTemplate::find($inviteDetails['client_email_template']);
			$emailTemplateContent = $emailTemplate->template_content_to_send;

			$clientFName = ucwords( strtolower( $clientDetails->fname ) );
			$updatedTemplateContent = str_replace('[firstname]', $clientFName, $emailTemplateContent);
			
			// Save the invitation details
			$agentClientInvite = new AgentClientInvite;

			$agentClientInvite->agent_id 			= $userId;
			$agentClientInvite->client_id 			= $inviteDetails['client_id'];
			$agentClientInvite->email_template_id 	= $inviteDetails['client_email_template'];
			$agentClientInvite->message_content 	= $updatedTemplateContent;
			$agentClientInvite->email_url 			= '';
			if( $inviteDetails['client_invitation_schedule_date'] != '' )
			{
				$agentClientInvite->schedule_status = '1';
				$agentClientInvite->schedule_date 	= date('Y-m-d', strtotime($inviteDetails['client_invitation_schedule_date']));
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
					$emailLink = config('constants.LOCAL_APP_URL') . '/public/movers/authenticate?agent_id='. base64_encode($userId) .'&client_id='. base64_encode($inviteDetails['client_id']) .'&invitation_id=' . base64_encode($agentClientInvite->id);
				}
				else
				{
					$emailLink = config('constants.SERVER_APP_URL') . '/movers/authenticate?agent_id='. base64_encode($userId) .'&client_id='. base64_encode($inviteDetails['client_id']) .'&invitation_id=' . base64_encode($agentClientInvite->id);
				}

				// Update the email link
				$agentClientInvite = AgentClientInvite::find($lastInviteId);

				$agentClientInvite->email_url = $emailLink;
				
				$agentClientInvite->save();

				// Update this link in the html as well
				$emailContent 	= AgentClientInvite::find($lastInviteId);

				$messageContent = $emailContent->message_content;

				// Replace the "https://www.udistro.ca/" with the real link
				$updatedContent = str_replace('href="https://www.udistro.ca/"', 'href="' . $emailLink . '"', $messageContent);

				// Update the content in the table
				AgentClientInvite::where(['id' => $lastInviteId])->update(['message_content' => $updatedContent]);
			}

			$response['errCode']    = 0;
		    $response['errMsg']     = 'Template successfully sent';
		}

		return response()->json($response);
    }

    /**
     * Function to uplaod the email template image
     * @param void
     * @return array
     */
    public function uploadEmailImage() 
    {
        $image 	= Input::file('image');

    	// Get the logged in user id
    	$userId = Auth::user()->id;

    	// Server Side Validation
    	$response = array();

    	$validation = Validator::make(
    	    array(
    	        'image'=> $image
    	    ),
    	    array(
    	        'image'=> array('required')
    	    ),
    	    array(
    	        'image.required'  => 'Please select an image'
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
    		// Image destination folder
		    $destinationPath = storage_path() . '/uploads/email_template';
		    if( $image->isValid() )  // If the file is valid or not
		    {
		        $fileExt  = $image->getClientOriginalExtension();
		        $fileType = $image->getMimeType();
		        $fileSize = $image->getSize();

		        if( ( $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' ) && $fileSize <= 3000000 )     // 3 MB = 3000000 Bytes
		        {
		            // Rename the file
		            $fileNewName = str_random(20) . '.' . $fileExt;

		            if( $image->move( $destinationPath, $fileNewName ) )
		            {
		                $response['errCode']    = 0;
						$response['errMsg']     = 'File uploaded successfully';
						$response['filePath'] 	= url('/images/email_template/' . $fileNewName);
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
		            $response['errMsg']     = 'Only image file with size less then 3MB is allowed';
		        }
		    }
		    else
		    {
		        $response['errCode']    = 4;
		        $response['errMsg']     = 'Invalid file';
		    }
    	}

    	return response()->json($response);
    }
	
	/**
     * Function to save the partner details
     * @param void
     * @return Array
     */
    public function savePartnerDetails(Request $request)
    {
		$partner_id    		= $request->input('partner_id');
    	$f_name    			= $request->input('f_name');
		$l_name    			= $request->input('l_name');
		$partner_email    	= $request->input('partner_email');
    	$partner_status  	= $request->input('partner_status');
		$business_name  	= $request->input('business_name');
		
        // Get the logged in user id
        $userId = Auth::user()->id;

        // Server side validation
        $response =array();

		$validation = Validator::make(
		    array(
				'business_name'		=> $business_name,
		        'partner_email'		=> $partner_email,
				'partner_status'	=> $partner_status
				
		    ),
		    array(
				'business_name' 	=> array('required'),
		        'partner_email' 	=> array('required', 'email'),
				'partner_status' 	=> array('required')
				
		    ),
		    array(
		        'business_name'				=> 'Please enter the business name',
				'partner_email.required' 	=> 'Please enter the partner email',
				'partner_status.required' 	=> 'Please select status'
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
			if($partner_id == '') 
			{
				$agentPartner 							= new AgentPartner;
				$agentPartner->agent_id 				= $userId;
				$agentPartner->business_name			= $business_name;
				$agentPartner->fname					= $f_name;
				$agentPartner->lname					= $l_name;
				$agentPartner->partner_email			= $partner_email;
				$agentPartner->status					= $partner_status;
				
				if( $agentPartner->save() )
				{
					$response['errCode']    = 0;
					$response['errMsg']     = 'Partner has been successfully added';
								
				}
				else
				{
					$response['errCode']    = 2;
					$response['errMsg']     = 'Some error in adding partner';
				}			
			}
			else 
			{
				$agentPartner 							= AgentPartner::find($partner_id);
				$agentPartner->agent_id 				= $userId;
				$agentPartner->business_name			= $business_name;
				$agentPartner->fname					= $f_name;
				$agentPartner->lname					= $l_name;
				$agentPartner->partner_email			= $partner_email;
				$agentPartner->status					= $partner_status;
				
				if( $agentPartner->save() )
				{
					$response['errCode']    = 0;
					$response['errMsg']     = 'Partner Detail updated successfully';
				}
				else
				{
					$response['errCode']    = 2;
					$response['errMsg']     = 'Some error in updating the partner details';
				}
			}
		}
		return response()->json($response);
		
	}
	
	 /**
     * Function to show the pertner list in datatable
     * @param void
     * @return array
     */
    public function fetchPartners()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
			1 => 'business_name',
            2 => 'fname',
			3 => 'lname',
			4 => 'partner_email',
			5 => 'status'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $agentPartners = DB::table('agent_partners')
						->where('agent_partners.fname','like', '%'.$sSearch.'%')
						->orWhere('agent_partners.business_name', 'like', '%'.$sSearch.'%')
						->orWhere('agent_partners.partner_email', 'like', '%'.$sSearch.'%')
						->orWhere('agent_partners.lname', 'like', '%'.$sSearch.'%')
						->orderBy($sortBy, $sortType)
						->limit($length)
						->offset($start)
						->select('agent_partners.id', 'agent_partners.business_name', 'agent_partners.fname', 'agent_partners.lname', 'agent_partners.partner_email',  'agent_partners.status')
						->get();

        $iTotal = DB::table('agent_partners')
						->where('agent_partners.fname','like', '%'.$sSearch.'%')
						->orWhere('agent_partners.business_name', 'like', '%'.$sSearch.'%')
						->orWhere('agent_partners.partner_email', 'like', '%'.$sSearch.'%')
						->orWhere('agent_partners.lname', 'like', '%'.$sSearch.'%')
						->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $agentPartners ) > 0 )
        {
            foreach ($agentPartners as $agentPartner)
            {
            	$response['aaData'][$k] = array(
                    0 => $agentPartner->id,
					1 => ucfirst( strtolower( $agentPartner->business_name ) ),
                    2 => ucfirst( strtolower( $agentPartner->fname ) ),
					3 => ucfirst( strtolower( $agentPartner->lname ) ),
					4 => $agentPartner->partner_email,
					5 => Helper::getStatusText($agentPartner->status),
                    6 => '<a href="javascript:void(0);" id="'. $agentPartner->id .'" class="edit_partner"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }
	
	/**
     * Function to return the partners page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function partners()
    {
        return view('agent/partners');
    }
	
	
	/**
     * Function to get the details for the selected partner
     * @param void
     * @return array
     */
    public function getPartnerDetails()
    {
    	$partnerId = Input::get('partnerId');

    	$response = array();
    	if( $partnerId != '' )
    	{
			
			$agentPartner = AgentPartner::find($partnerId);
			if( count( $agentPartner ) > 0 )
    		{
				$response['business_name'] 	= $agentPartner->business_name;
				$response['f_name'] 		= $agentPartner->fname;
				$response['l_name'] 		= $agentPartner->lname;
				$response['partner_email'] 	= $agentPartner->partner_email;
				$response['partner_status'] = $agentPartner->status;
				
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function to return agent review board page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function reviews()
    {
        return view('agent/reviews');
    }

    /**
     * Function to fetch reviews and show in datatable
     * @param void
     * @return array
     */
    public function fetchReviews()
    {
    	$start      = Input::get('iDisplayStart');      // Offset
    	$length     = Input::get('iDisplayLength');     // Limit
    	$sSearch    = Input::get('sSearch');            // Search string
    	$col        = Input::get('iSortCol_0');         // Column number for sorting
    	$sortType   = Input::get('sSortDir_0');         // Sort type

    	// Datatable column number to table column name mapping
        $arr = array(
            0 => 't1.id',
            1 => 't2.fname',
            2 => 't2.lname',
            4 => 't1.rating'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the logged in user id
        $userId = Auth::user()->id;

        $reviews 	= DB::table('agent_client_ratings as t1')
        			->join('agent_clients as t2', 't1.client_id', '=', 't2.id')
        			->where('t1.agent_id','=', $userId)
        			->where('t2.fname','like', '%'.$sSearch.'%')
        			->orderBy($sortBy, $sortType)
                    ->limit($length)
                    ->offset($start)
                    ->select('t1.id', 't2.fname', 't2.lname', 't2.email', 't1.rating', 't1.comment', 't1.helpful')
                    ->get();

        $iTotal = DB::table('agent_client_ratings as t1')
        			->join('agent_clients as t2', 't1.client_id', '=', 't2.id')
        			->where('t1.agent_id','=', $userId)
                    ->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;
        if ( count( $reviews ) > 0 )
        {
            foreach ($reviews as $review)
            {
            	$rating = '';
            	for($i=1; $i <= $review->rating; $i++)
            	{
            		$rating .= '<i class="fa fa-star-o"></i> ';
            	}

            	$response['aaData'][$k] = array(
                    0 => $review->id,
                    1 => ucfirst( strtolower( $review->fname ) ),
                    2 => ucfirst( strtolower( $review->lname ) ),
                    3 => $review->email,
                    4 => $review->comment,
                    5 => ( $review->helpful ) ? 'Yes' : 'No',
                    6 => $rating,
                    
                    //6 => '<a href="https://www.facebook.com/sharer/sharer.php?u=https://www.udistro.ca/" target="_blank"><i class="fa fa-facebook-square"></i></a><a href="http://twitter.com/share?text=udistro&amp;url=https://www.udistro.ca/&amp;hashtags=udistro" target="_blank"><i class="fa fa fa-twitter-square"></i></a><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.udistro.ca/&amp;title=udistro&amp;summary=udistro" target="_blank"><i class="fa fa fa-linkedin-square"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }

    /**
     * Function to return payment view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function paymentPlan()
    {
    	// Get the logged-in user id
		$userId = Auth::id();

		$currDate = date('Y-m-d');

    	// Get the payment plan list
    	$paymentPlans 	= PaymentPlan::where(['plan_type_id' => '1', 'status' => '1'])	// plan_type_id : 1 is for agent
    					->orderBy('plan_name', 'asc')
    					->select('id', 'plan_name', 'plan_charges', 'discount', 'validity_days', 'allowed_count')
    					->get();

    	// Get the selected payment plan details with the date validation
    	$selectedPaymentPlan 	= DB::table('payment_plan_subscriptions as t1')
    							->join('payment_plans as t2', 't1.plan_id', '=', 't2.id')
    							->where(['t1.plan_type_id' => '1', 't1.subscriber_id' => $userId, 't1.status' => '1', 't2.status' => '1'])
    							->where('t1.start_date', '<=', $currDate)
    							->where('t1.end_date', '>=', $currDate)
    							->select('t1.id', 't2.plan_name', 't2.plan_charges', 't2.validity_days', 't1.start_date', 't1.end_date', 't1.quota', 't1.remaining_qouta')
    							->first();

    	return view('agent/paymentPlan', ['paymentPlans' => $paymentPlans, 'selectedPaymentPlan' => $selectedPaymentPlan]);
    }

    /**
     * Function to get the payment plan details for paypal payment
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getPlanDetails()
    {
    	$planId = Input::get('planId');

    	// Get the logged-in user id
		$userId = Auth::id();

    	$response = array();
    	
    	if( $planId != '' && $planId != 0 )
    	{
    		// Get the payment plan details
    		$paymentPlanDetails = PaymentPlan::find($planId);

    		// Get the agent details
    		$agentDetails = DB::table('users as t1')
    						->join('cities as t2', 't1.city_id', '=', 't2.id')
    						->where(['t1.id' => $userId, 't1.status' => '1'])
    						->select('t1.fname', 't1.lname', 't1.email', 't1.address1', 't1.address2', 't1.postalcode', 't1.phone_number', 't2.name as city')
    						->first();

    		$response['errCode']    = 0;
			$response['errMsg']     = 'Success';
    		$response['details'] 	= array(
    			'fname' 		=> ucwords( strtolower( $agentDetails->fname ) ),
    			'lname' 		=> ucwords( strtolower( $agentDetails->lname ) ),
    			'email' 		=> $agentDetails->email,
    			'address1' 		=> $agentDetails->address1,
    			'address2' 		=> $agentDetails->address2,
    			'city' 			=> $agentDetails->city,
    			'zip' 			=> $agentDetails->postalcode,
    			'contactNumber'	=> $agentDetails->phone_number,
    			'paymentAgainst'=> ucwords( strtolower( $paymentPlanDetails->plan_name ) ),
    			'amount' => $paymentPlanDetails->plan_charges
    		);
    	}

    	return response()->json($response);
    }
}
