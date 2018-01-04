<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Country;
use App\Province;
use App\City;
use App\AgentClient;
use App\AgentClientMovingFromAddress;
use App\AgentClientMovingToAddress;
use Illuminate\Support\Facades\DB;

use Helper;
use Validator;

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
        Auth::logout();

        // Rolewise redirection is required here
        return redirect('/');
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
		            $response['errMsg']     = 'Invitation details saved successfully';
		    	}
		    	else
		        {
		        	DB::rollBack();

		            $response['errCode']    = 3;
		            $response['errMsg']     = 'Some issue in sending invitation';
		        }
			}
		}

    	return response()->json($response);
    }
}
