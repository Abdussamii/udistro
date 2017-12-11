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

use Validator;
use Helper;

class DashboardController extends Controller
{
    /**
     * Function to return the company registration page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
    	return view('dashboard/register');
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
        	return redirect('dashboard/dashboard');
        }
        else 					// User is not logged-in, show the login page
        {
        	return view('dashboard/index');
        }
    }


    /**
     * Function for company login
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
			
			// $user = User::where('email', '=', $loginData['username'])->first();
			$user = User::where(['email' => $loginData['username'], 'status' => '1'])->first();

			if( count($user)  > 0 )
			{
		        if( $user->hasRole(['admin']) )	// list of allowed users
		        {
		            if(Auth::attempt(['email' => $loginData['username'], 'password' => $loginData['password'], 'status' => '1'], $remember))
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
	           	$response['errMsg']     = 'Invalid user credentials';
	        }
		}

		return response()->json($response);
    }

}