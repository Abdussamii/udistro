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

            $response['errCode']    = 1;
            $response['errMsg']     = 'Some issue in sending invitation';
        }

    	return response()->json($response);
    }
}
