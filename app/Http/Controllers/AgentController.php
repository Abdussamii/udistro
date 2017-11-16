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
			// Save the client details
			$agent = new AgentClient;

			$agent->agent_id 		= $userId;
			$agent->fname 			= $clientData['client_fname'];
			$agent->lname 			= $clientData['client_mname'];
			$agent->oname 			= $clientData['client_lname'];
			$agent->email 			= $clientData['client_email'];
			$agent->contact_number 	= $clientData['client_number'];
			$agent->status 			= $clientData['client_status'];
			$agent->created_by 		= $userId;

			if( $agent->save() )
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
        $agents = AgentClient::where('fname','like', '%'.$sSearch.'%')
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
        if ( count( $agents ) > 0 )
        {
            foreach ($agents as $agent)
            {
            	$response['aaData'][$k] = array(
                    0 => $agent->id,
                    1 => ucfirst( strtolower( $agent->fname ) ),
                    2 => ucfirst( strtolower( $agent->oname ) ),
                    3 => ucfirst( strtolower( $agent->lname ) ),
                    4 => $agent->email,
                    5 => $agent->contact_number,
                    6 => Helper::getStatusText($agent->status),
                    7 => '<a href="javascript:void(0);"><i class="fa fa-envelope-o" aria-hidden="true"></i></a> &nbsp;&nbsp; <a href="javascript:void(0);" id="'. $agent->id .'" class="edit_client"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

    	return response()->json($response);
    }
}