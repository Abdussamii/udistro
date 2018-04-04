<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Country;
use App\Province;
use App\City;
use App\AgentClient;
use App\AgentClientMovingFromAddress;
use App\AgentClientMovingToAddress;
use App\User;

use Helper;
use Validator;
use Mail;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Function to logout
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
    	// Check the logged in user role and redirect it accordingly
    	$userId = Auth::id();
    	$user 	= User::find($userId); 

    	if( isset( $user ) && count( $user ) > 0 )
    	{
    		$role = $user->roles->first();

			Auth::logout();

			// Rolewise redirection is required here
			if( $role->name == 'admin' )
			{
				return redirect('/administrator');
			}
			else if( $role->name == 'company_representative' )
			{
				return redirect('/company');
			}
			else if( $role->name == 'agent' )
			{
				return redirect('/agent');
			}
    	}
    	else
    	{
    		Auth::logout();

    		return redirect('/');
    	}
    }

    /**
     * Function to return get invitation view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getInvitation()
    {
    	// Get the province list
    	$provinces = Province::where(['status' => '1'])->select('id', 'abbreviation', 'name')->get();

    	// Get the cities list
    	$cities = City::where(['status' => '1'])->select('id', 'name')->get();

    	// Get the countries list
    	$countries = Country::get();

    	return view('getInvitation', ['countries' => $countries, 'provinces' => $provinces, 'cities' => $cities]);
    }

    /**
     * Function to save the invitation details
     * @param void
     * @return array
     */
    public function saveInvitationDetails()
    {
    	$frmData = Input::get('frmData');

    	$invitationDetails = array();
    	parse_str($frmData, $invitationDetails);
    	
    	// Get the udistro system agent id
    	$systemAgentId = Helper::getSystemAgent();

    	$response = array();

    	// Server side validation
    	$validation = Validator::make(
		    array(
		        'fname'	=> $invitationDetails['fname'],
		        'lname' => $invitationDetails['lname'],
		        'email'	=> $invitationDetails['email'],
		        'mobile'=> $invitationDetails['mobile'],

		        'moving_from_address1'	=> $invitationDetails['moving_from_address1'],
		        'moving_from_province'	=> $invitationDetails['moving_from_province'],
		        'moving_from_city'		=> $invitationDetails['moving_from_city'],
		        'moving_from_postalcode'=> $invitationDetails['moving_from_postalcode'],
		        'moving_from_country'	=> $invitationDetails['moving_from_country'],

				'moving_to_address1'	=> $invitationDetails['moving_to_address1'],
		        'moving_to_province'	=> $invitationDetails['moving_to_province'],
		        'moving_to_city'		=> $invitationDetails['moving_to_city'],
		        'moving_to_postalcode'	=> $invitationDetails['moving_to_postalcode'],
		        'moving_to_country'		=> $invitationDetails['moving_to_country'],

		        'moving_date' 			=> $invitationDetails['moving_date'],	        
		    ),
		    array(
		        'fname'	 				=> array('required'),
		        'lname' 				=> array('required'),
		        'email'					=> array('required', 'email'),
		        'mobile'				=> array('required', 'numeric'),
		        'moving_from_address1'	=> array('required'),
		        
		        'moving_from_province'	=> array('required'),
		        'moving_from_city'		=> array('required'),
		        'moving_from_postalcode'=> array('required'),
		        'moving_from_country'	=> array('required'),
				'moving_to_address1'	=> array('required'),
		        
		        'moving_to_province'	=> array('required'),
		        'moving_to_city'		=> array('required'),
		        'moving_to_postalcode'	=> array('required'),
		        'moving_to_country'		=> array('required'),
		        'moving_date' 			=> array('required'),
		    ),
		    array(
		        'fname.required'					=> 'Please enter first name',
		        'lname.required' 					=> 'Please enter last name',
		        'email.required'					=> 'Please enter email',
		        'email.email'						=> 'Please enter valid email',
		        'mobile.required'					=> 'Please enter mobile no',
		        'mobile.numeric'					=> 'Please enter valid mobile no',

		        'moving_from_address1.required'		=> 'Please enter moving from address',
		        'moving_from_province.required'		=> 'Please select moving from province',
		        'moving_from_city.required'			=> 'Please select moving from city',
		        'moving_from_postalcode.required'	=> 'Please enter moving from postal code',
		        'moving_from_country.required'		=> 'Please select moving from country',

				'moving_to_address1.required'		=> 'Please enter moving to address',
		        'moving_to_province.required'		=> 'Please select moving to province',
		        'moving_to_city.required'			=> 'Please select moving to city',
		        'moving_to_postalcode.required'		=> 'Please enter moving to postal code',
		        'moving_to_country.required'		=> 'Please select moving to country',

		        'moving_date.required' 				=> 'Please select moving date',
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
			if( $systemAgentId != 0 )
			{
				// Check if the selected date is 15 days ahead or not
				$futureDate 	= date('d-m-Y', strtotime('+15 days'));
				$selectedDate 	= date('d-m-Y', strtotime($invitationDetails['moving_date']));

				if( $selectedDate < $futureDate )
				{
					$response['errCode']    = 2;
			        $response['errMsg']     = 'Please select atleast 15 days ahead date';
				}
				else
				{
					DB::beginTransaction();

			    	$agentClient = new AgentClient;

			    	$agentClient->agent_id 		= $systemAgentId;
			    	$agentClient->fname 		= $invitationDetails['fname'];
			    	$agentClient->lname 		= $invitationDetails['lname'];
			    	$agentClient->email 		= $invitationDetails['email'];
			    	$agentClient->contact_number= $invitationDetails['mobile'];
			    	$agentClient->status 		= '1';

			    	if( $agentClient->save() )
			    	{
			    		$movingFromAddress 	= new AgentClientMovingFromAddress([
			    			'address1' 		=> $invitationDetails['moving_from_address1'],
			    			'address2' 		=> $invitationDetails['moving_from_address2'],
			    			'province_id' 	=> $invitationDetails['moving_from_province'],
			    			'city_id' 		=> $invitationDetails['moving_from_city'],
			    			'postal_code' 	=> $invitationDetails['moving_from_postalcode'],
			    			'country_id' 	=> $invitationDetails['moving_from_country'],
			    			'status' 		=> '1',
			    			'created_by' 	=> $systemAgentId,
			    		]);

			    		$movingToAddress 	= new AgentClientMovingToAddress([
			    			'address1' 		=> $invitationDetails['moving_to_address1'],
			    			'address2' 		=> $invitationDetails['moving_to_address2'],
			    			'province_id' 	=> $invitationDetails['moving_to_province'],
			    			'city_id' 		=> $invitationDetails['moving_to_city'],
			    			'postal_code' 	=> $invitationDetails['moving_to_postalcode'],
			    			'country_id' 	=> $invitationDetails['moving_to_country'],
			    			'moving_date'	=> date('Y-m-d', strtotime($invitationDetails['moving_date'])),
			    			'status' 		=> '1',
			    			'created_by' 	=> $systemAgentId,
			    		]);

			    		$agentClient->movingFromAddress()->save($movingFromAddress);

			    		$agentClient->movingToAddress()->save($movingToAddress);

			    		DB::commit();

			    		$response['errCode']    = 0;
			            $response['errMsg']     = 'Your request is successfully sent';
			    	}
			    	else
			        {
			        	DB::rollBack();

			            $response['errCode']    = 3;
			            $response['errMsg']     = 'Some issue in sending invitation';
			        }
				}
			}
			else
			{
				$response['errCode']    = 4;
			    $response['errMsg']     = 'No system agent available';
			}
		}

    	return response()->json($response);
    }

    /**
     * Function to return forgot password view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword()
    {
    	return view('forgotPassword');
    }

    /**
     * Function to check the email and send the password reset link
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function forgotPasswordEmail()
    {
    	$email = Input::get('email');

    	$response = array();
    	if( $email != '' )
    	{
    		// Check if it is a valid email. If valid send the password reset link on the same email
    		$user = User::where(['email' => $email, 'status' => '1'])->first();

    		if( count( $user ) == 1 )
    		{
    			// Save the entry in password_resets table and send the email
    			$token = Hash::make($email);

    			if( DB::table('password_resets')->insert(['email' => $email, 'token' => $token, 'created_at' => date('Y-m-d H:i:s')]) )
				{
					// Send the email
					if( app()->env == 'local' )
					{
						$emailLink = config('constants.LOCAL_APP_URL') . '/public/resetpassword/' . base64_encode($token);
					}
					else
					{
						$emailLink = config('constants.SERVER_APP_URL') . 'resetpassword/' . base64_encode($token);
					}

					// Email send code here
	    			$emailData = array(
	    				'name' 		=> ucwords( strtolower( $user->lname . ' ' . $user->fname ) ),
	    				'subject' 	=> 'Forgot Password',
	    				'email' 	=> $user->email,
	    				'url'		=> $emailLink,
	    			);

	    			Mail::send('emails.forgotPassword', ['emailData' => $emailData], function ($m) use ($emailData) {
	    			    $m->from('noreply@udistro.ca', 'Udistro');
	    			    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
	    			});

	    			$response['errCode']    = 0;
				    $response['errMsg']     = 'Password reset link is send on your email id';
				}
				else
				{
					$response['errCode']    = 1;
			    	$response['errMsg']     = 'Some issue in password reset';
				}
    		}
    		else
    		{
	    		$response['errCode']    = 2;
			    $response['errMsg']     = 'No such user exist';
    		}
    	}
    	else
    	{
    		$response['errCode']    = 3;
		    $response['errMsg']     = 'Please provide the email id';
    	}

    	return response()->json($response);
    }

    /**
     * Function to reset password
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function resetPassword($token='')
    {
    	$response = array();
    	if( $token != '' )
    	{
    		// Check if the token is valid or not
    		$token = base64_decode($token);

    		$validToken = DB::table('password_resets')->where(['token' => $token])->first();

    		if( count( $validToken ) == 1 )
    		{
    			$response['errCode']    = 0;
		    	$response['errMsg']     = 'valid token';
		    	$response['token']     	= $token;
    		}
    		else
    		{
    			$response['errCode']    = 2;
		    	$response['errMsg']     = 'Invalid token';
    		}
    	}
    	else
    	{
    		$response['errCode']    = 3;
		    $response['errMsg']     = 'Missing token';
    	}

    	return view('resetPassword', ['response' => $response]);
    }

    /**
     * Function to update password
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function updatePassword()
    {
    	$token = Input::get('token');
    	$password = Input::get('password');

    	// Get the email from password_resets
    	$user = DB::table('password_resets')->where(['token' => $token])->first();

    	$response = array();

    	if( count( $user ) == 1 )
    	{
    		// Get the user role
    		$userDetails = User::where(['email' => $user->email])->first();
    		$role = $userDetails->roles->first();

    		// Rolewise url redirection is required
    		$url = '';
    		if( $role->name == 'admin' )
    		{
    			$url = url('/admin');
    		}
    		else if( $role->name == 'company_representative' )
    		{
    			$url = url('/company');	
    		}
    		else if( $role->name == 'agent' )
    		{
    			$url = url('/agent');
    		}

    		// Update the password
    		$hash = Hash::make($password);

    		if(User::where(['email' => $user->email])->update(['password' => $hash]))
    		{
    			$response['errCode']    = 0;
    			$response['url']    	= $url;
		    	$response['errMsg']     = 'Password updated successfully';
    		}
    		else
    		{
    			$response['errCode']    = 1;
		    	$response['errMsg']     = 'Invalid token';
    		}
    	}
    	else
    	{
    		$response['errCode']    = 2;
		    $response['errMsg']     = 'Invalid token';
    	}

    	return response()->json($response);
    }
}
