<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\PaymentPlan;
use App\AgentClientInvite;
use App\EmailTemplate;
use App\User;
use App\AgentClient;
use App\ClientActivityList;
use App\AgentClientRating;
use App\AgentClientMovingToAddress;
use App\AgentClientMovingFromAddress;
use App\UtilityServiceProvider;
use App\ClientActivityLog;
use App\ClientActivityFeedback;
use App\MovingItemCategory;
use App\MovingItemDetail;
use App\MovingItemServiceRequest;
use App\MovingOtherItemService;
use App\MovingTransportation;
use App\MovingItemDetailServiceRequest;
use App\MovingOtherItemServiceRequest;
use App\PaymentPlanSubscription;
use App\MovingTransportationTypeRequest;

use App\TechConciergePlace;
use App\TechConciergeAppliance;
use App\TechConciergeOtherDetail;

use App\TechConciergeServiceRequest;
use App\TechConciergePlaceServiceRequest;
use App\TechConciergeOtherDetailServiceRequest;
use App\TechConciergeAppliancesServiceRequest;
use App\QuotationLog;
use App\DigitalServiceType;
use App\DigitalAdditionalService;
use App\DigitalServiceRequest;
use App\DigitalServiceTypeRequest;
use App\DigitalAdditionalServiceTypeRequest;
use App\HomeCleaningSteamingService;
use App\HomeCleaningOtherPlace;
use App\HomeCleaningAdditionalService;
use App\HomeCleaningServiceRequest;
use App\HomeCleaningAdditionalServiceRequest;
use App\HomeCleaningOtherPlaceServiceRequest;
use App\HomeCleaningSteamingServiceRequest;
use App\ProvincialAgencyDetail;
use App\ServiceRequestResponse;
use App\PaymentTransactionDetail;
use App\ShareAnnouncementEmail;

use Validator;
use Helper;
use Session;

//newly added header files
use App\Company;
use App\AgentPartner;
use App\AgentPartnerDigitalServiceRequest;
use App\AgentPartnerDigitalServiceTypeRequest;
use App\AgentPartnerDigitalAdditionalServiceTypeRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Quotation;
use App\Mail\CompanyQuotationResponse;
use App\Mail\MoverQuotationRequest;

class MoversController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_navigationArray;

    public function __construct()
    {

        /**
            Footer Navigation DB Fetch 
        */
        $bottomNavigationArray = DB::table('cms_navigation_types')
            ->join('cms_navigation_categories', 'cms_navigation_types.id', '=', 'cms_navigation_categories.navigation_type_id')
            ->join('cms_navigation_cms_navigation_category', 'cms_navigation_cms_navigation_category.cms_navigation_category_id', '=', 'cms_navigation_categories.id')
            ->join('cms_navigations', 'cms_navigation_cms_navigation_category.cms_navigation_id', '=', 'cms_navigations.id')
            ->select('cms_navigation_categories.id', 'cms_navigation_categories.category', 'cms_navigations.navigation_text', 'cms_navigations.navigation_url')
            ->where('cms_navigation_types.id', '=', '2')
            ->where('cms_navigation_types.status', '=', '1')
            ->where('cms_navigation_categories.status', '=', '1')
            ->where('cms_navigation_cms_navigation_category.status', '=', '1')
            ->where('cms_navigations.status', '=', '1')
            ->get();

        $i=$j=0;
        $navigationArray = array();
        foreach ($bottomNavigationArray as $key => $bottomNavigation) {
            if($key != 0) {
                if($bottomNavigation->id != $id) {
                    $j=0;
                    $i++;
                } else {
                    $j++;
                }
            }
            $id = $bottomNavigation->id;
            $navigationArray[$i]['category'] = $bottomNavigation->category;
            $navigationArray[$i]['navigation'][$j]['navigation_text'] = $bottomNavigation->navigation_text;
            $navigationArray[$i]['navigation'][$j]['navigation_url'] = $bottomNavigation->navigation_url;
        }
        $this->_navigationArray = $navigationArray;
        
    }

    /**
     * Function to return login view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentPlan = PaymentPlan::get();
        $env = env('APP_ENV');
        $url = '';
        if($env == 'production')
            $url = 'public/';
        
    	return view('movers/index', ['paymentPlan' => $paymentPlan, 'navigationArray' => $this->_navigationArray, 'url' => $url]);
    }

    /**
     * Function to return movers authentication page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function authenticate()
    {
    	$agentId 		= base64_decode(Input::get('agent_id'));
    	$clientId 		= base64_decode(Input::get('client_id'));
    	$invitationId 	= base64_decode(Input::get('invitation_id'));

    	if( $agentId != '' && $clientId != '' && $invitationId != '')
    	{
    		// Check the user is authentic or not
    		$inviteDetails = AgentClientInvite::find($invitationId);

    		if( count( $inviteDetails ) > 0 )
    		{
    			if( $inviteDetails->authentication == '0' )		// Authentication is pending
    			{
    				return view('movers/authenticate', ['clientId' => $clientId, 'invitationId' => $invitationId]);
    			}
    			else 	// Authentication is done, redirect the user to my move page
    			{
    				return redirect('/movers/mymove?agent_id='. base64_encode( $agentId ) .'&client_id='. base64_encode( $clientId ) .'&invitation_id=​' . base64_encode( $invitationId ));
    			}
    		}
    	}
    	else
    	{
    		// Missing required parameters
    		return redirect('/');
    	}
    }

    /**
     * Function to return my move view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function checkUserAuthentication()
    {
    	$mobileNo = Input::get('mobileNo');
    	$clientId = Input::get('clientId');
    	$invitationId = Input::get('invitationId');

    	// Server Side Validation
        $response =array();

		$validation = Validator::make(
		    array(
		        'mobileNo'	=> $mobileNo,
		        'clientId' 	=> $clientId,
		        'invitationId' => $invitationId
		    ),
		    array(
		        'mobileNo' 	=> array('required', 'numeric'),
		        'clientId'	=> array('required', 'numeric'),
		        'invitationId' => array('required', 'numeric'),
		    ),
		    array(
		        'mobileNo.required' 	=> 'Please enter your mobile number',
		        'mobileNo.numeric'   	=> 'Please enter a valid mobile number',
		        'clientId.required'		=> 'Invalid user',
		        'clientId.numeric'		=> 'Invalid user',
		        'invitationId.required'	=> 'Invalid user',
		        'invitationId.numeric'	=> 'Invalid user',
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
			// Check if the mobile number is valid
			$authenticate = AgentClient::where(['id' => $clientId, 'contact_number' => $mobileNo])->first();

			if( count( $authenticate ) > 0 )
			{
				// Update the authentication status
				if( AgentClientInvite::where(['id' => $invitationId])->update(['authentication' => '1']) )
				{
					$response['errCode'] 	= 0;
					$response['errMsg'] 	= 'User verified successfully';
				}
				else
				{
					$response['errCode'] 	= 2;
					$response['errMsg'] 	= 'Some issue in authentication';
				}
			}
			else
			{
				$response['errCode'] 	= 3;
				$response['errMsg'] 	= 'Invalid User';
			}
		}

		return response()->json($response);
    }


    /**
     * Function to return my move view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function myMove()
    {
    	$agentId 		= base64_decode(Input::get('agent_id'));
    	$clientId 		= base64_decode(Input::get('client_id'));
    	$invitationId 	= base64_decode(Input::get('invitation_id'));

    	// Check if the user is authenticated or not. If not redirect it to the home page
    	$inviteDetails = AgentClientInvite::find($invitationId);
    	if( count( $inviteDetails ) > 0 )
    	{
    		if( $inviteDetails->authentication == '0' )		// Authentication is pending
    		{
    			return redirect('/');
    		}
    	}

    	// Get the email template id & message detail
    	$inviteDetails = AgentClientInvite::find($invitationId);

    	// Get the agent related details
    	$agentDetails = User::find($inviteDetails->agent_id);

    	// Get the client relalted details
    	$clientDetails = AgentClient::find($inviteDetails->client_id);

    	// Get the company related details
    	$companyDetails = $agentDetails->company->first();

    	// Client name
    	$clientName = ucwords( strtolower( trim($clientDetails->fname . ' ' . $clientDetails->lname) ) );

    	// Get the initials of name and convert it to uppercase
    	$clientInitials = $this->strAcronym($clientName, $max = 2, $acronym = '');

    	// Agent name
    	$agentName = ucwords( strtolower( trim($agentDetails->fname . ' ' . $agentDetails->lname) ) );

    	// Get the initials of name and convert it to uppercase
    	$agentInitials = $this->strAcronym($agentName, $max = 2, $acronym = '');

    	// Get the list of activities
    	$activities = ClientActivityList::where(['status' => '1', 'listing_event' => '1'])->select('id', 'activity', 'image_name', 'description', 'activity_class')->get();

    	// Fetch the rating for the agent
    	$agentRating = AgentClientRating::where(['agent_id' => $inviteDetails->agent_id])->avg('rating');

    	// Fetch the helpful count given by client to the agent
		$agentClientHelpfulCount = AgentClientRating::where(['agent_id' => $inviteDetails->agent_id, 'client_id' => $clientDetails->id, 'helpful' => '1'])->count();

		// Fetch the rating given by client to the agent
		$agentClientRating = AgentClientRating::where(['agent_id' => $inviteDetails->agent_id, 'client_id' => $clientDetails->id])->select('rating')->first();

    	// Fetch the helpful count for the agent
    	$agentHelpfulCount = AgentClientRating::where(['agent_id' => $inviteDetails->agent_id, 'helpful' => '1'])->count();

    	// Get the moving from address
    	$clientMovingFromAddress = AgentClientMovingFromAddress::where(['agent_client_id' => $clientDetails->id])->first();

    	// Get the moving to address
    	$clientMovingToAddress = AgentClientMovingToAddress::where(['agent_client_id' => $clientDetails->id])->first();

    	// Get the moving from province name
    	$clientMovingFromProvince = $clientMovingFromAddress->province;

    	// Get the moving to province name
    	$clientMovingToProvince = $clientMovingToAddress->province;

    	// Get the province of company
    	$companyProvince = $companyDetails->province;

    	// Get the city of company
    	$companyCity = $companyDetails->city;

    	// Get the list of service providers
    	$serviceProviders = UtilityServiceProvider::where(['status' => '1'])->select('id', 'company_name')->get();

    	// Check if the activity log already exist for logged-in
    	$activityLogExist = ClientActivityLog::where(['invitation_id' => $invitationId, 'client_id' => $inviteDetails->client_id, 'activity_id' => 1])->first();

    	if( count( $activityLogExist ) == 0 )
    	{
	    	// Update client_activity_logs table for login activity is done
	    	$activityLog = new ClientActivityLog;

	    	$activityLog->invitation_id = $invitationId;
	    	$activityLog->client_id 	= $inviteDetails->client_id;
	    	$activityLog->activity_id 	= 1;
	    	$activityLog->action 		= '1';

	    	$activityLog->save();
    	}

    	// Get the completed activity percentage
    	$completedActivitiesPercentage = Helper::calculateCompletedActivitiesPercentage($inviteDetails->client_id, $invitationId);

    	// Set the invitation id and clinet id in session
    	session(['agentId' => $inviteDetails->agent_id,'clientId' => $inviteDetails->client_id, 'invitationId' => $invitationId]);

    	// Get the list of completed activities to show them checked
    	$completedActivitiesList = ClientActivityLog::where(['invitation_id' => $invitationId, 'client_id' => $inviteDetails->client_id])->select('activity_id', 'action')->get();

    	$completedActivities = array();
    	if( count( $completedActivitiesList ) > 0 )
    	{
    		foreach ($completedActivitiesList as $activityList)
    		{
    			$completedActivities[$activityList->activity_id] = $activityList->action;
    		}
    	}

    	// Get the moving item categories
    	$movingItemCategories = MovingItemCategory::where('status', '1')->select('id', 'item_name')->orderBy('id', 'asc')->get();

    	// Get the moving item category details
    	$movingItemDetails = MovingItemDetail::where('status', '1')->select('id', 'moving_item_category_id', 'item_name', 'item_weight')->orderBy('id', 'asc')->get();

    	// Get the moving other item services list
    	$movingOtherItemList = MovingOtherItemService::get();

    	// Get the moving transportation list
    	$MovingTransportationList = MovingTransportation::get();

    	// Get the tech concierge places list
    	$techConciergePlaces = TechConciergePlace::orderBy('places', 'asc')->select('id', 'places')->get();

    	// Get the tech concierge appliances list
    	$techConciergeAppliances = TechConciergeAppliance::orderBy('appliances', 'asc')->select('id', 'appliances')->get();

    	// Get the tech concierge details list
    	$techConciergeOtherDetails = TechConciergeOtherDetail::get();

    	// Get digital services list
    	$digitalServiceTypes = DigitalServiceType::where(['status' => '1'])->select('id', 'service')->get();

    	// Get addtional digital services list
    	$digitalAdditionalServices = DigitalAdditionalService::where(['status' => '1'])->select('id', 'additional_service')->get();

    	// use App\HomeCleaningSteamingService;
    	// use App\HomeCleaningOtherPlace;
    	// use App\HomeCleaningAdditionalService;

    	// Get the list of home cleaning steaming services
    	$homeCleaningSteamingServices = HomeCleaningSteamingService::where(['status' => '1'])->select('id', 'steaming_service_for')->get();

    	// Get the list of home cleaning other places to clean
    	$homeCleaningOtherPlaces = HomeCleaningOtherPlace::where(['status' => '1'])->select('id', 'other_places')->get();

    	// Get the list of home cleaning additional services
    	$homeCleaningAdditionalService = HomeCleaningAdditionalService::where(['status' => '1'])->select('id', 'additional_service')->get();

    	// Get the provincial health agency data
    	$provincialAgencyDetails = ProvincialAgencyDetail::where(['status' => '1', 'province_id' => $clientMovingToAddress->province_id])->get();

    	// echo '<pre>';
    	// print_r( $provincialAgencyDetails->toArray() );
    	// exit;

    	return view('movers/myMove', 
    		[
    			'agentDetails' => $agentDetails, 
    			'clientDetails' => $clientDetails, 
    			'companyDetails' => $companyDetails, 
    			'clientInitials' => $clientInitials, 
    			'clientName' => $clientName, 
    			'agentName' => $agentName, 
    			'agentInitials' => $agentInitials, 
    			'activities' => $activities, 
    			'agentRating' => $agentRating, 
    			'agentHelpfulCount' => $agentHelpfulCount, 
    			'clientMovingFromProvince' => $clientMovingFromProvince, 
    			'clientMovingToProvince' => $clientMovingToProvince, 
    			'clientMovingFromAddress' => $clientMovingFromAddress, 
    			'clientMovingToAddress' => $clientMovingToAddress, 
    			'companyProvince' => $companyProvince, 
    			'companyCity' => $companyCity, 
    			'serviceProviders' => $serviceProviders, 
    			'completedActivitiesPercentage' => $completedActivitiesPercentage, 
    			'invitationId' => $invitationId, 
    			'completedActivities' => $completedActivities, 
    			'agentClientHelpfulCount' => $agentClientHelpfulCount, 
    			'agentClientRating' => $agentClientRating, 
    			'movingItemCategories' => $movingItemCategories, 
    			'movingItemDetails' => $movingItemDetails, 
    			'movingOtherItemList' => $movingOtherItemList, 
    			'MovingTransportationList' => $MovingTransportationList,

    			// Tech Concierge
    			'techConciergePlaces' 		=> $techConciergePlaces,
    			'techConciergeAppliances' 	=> $techConciergeAppliances,
    			'techConciergeOtherDetails' => $techConciergeOtherDetails,
    			
    			// Cable & Internet services
    			'digitalServiceTypes' 		=> $digitalServiceTypes,
    			'digitalAdditionalServices' => $digitalAdditionalServices,

    			// Home cleaning services
    			'homeCleaningSteamingServices' 	=> $homeCleaningSteamingServices,
    			'homeCleaningOtherPlaces' 		=> $homeCleaningOtherPlaces,
    			'homeCleaningAdditionalService' => $homeCleaningAdditionalService,

    			// Provincial health agency data for the province in which mover is moving to
    			'provincialAgencyDetails' 	=> $provincialAgencyDetails
    		]
    	);
    }

    /**
     * Function to return my move view
     * @param void
     * @return array
     */
    public function updateActivityStatus()
    {
    	$activityId = Input::get('activityId');
    	$action 	= Input::get('action');

    	// Get the client and invitation id from session
    	$clientId 		= Session::get('clientId');
    	$invitationId 	= Session::get('invitationId');

    	$response = array();

		// Check if there is some entry already exist
		$activityExist = ClientActivityLog::where(['invitation_id' => $invitationId, 'client_id' => $clientId, 'activity_id' => $activityId])->first();

		if( count( $activityExist ) == 0 )		// Add the entry
		{
			$activity = new ClientActivityLog;

			$activity->invitation_id= $invitationId;
	    	$activity->client_id 	= $clientId;
	    	$activity->activity_id 	= $activityId;
	    	$activity->action 		= $action;

	    	if( $activity->save() )
	    	{
	    		// Get the updated completed activity percentage
	    		$completedActivitiesPercentage = Helper::calculateCompletedActivitiesPercentage($clientId, $invitationId);

	    		$response['errCode'] 	= 0;
	    		$response['errMsg'] 	= 'Activity logged successfully';
	    		$response['percent']	= $completedActivitiesPercentage;
	    	}
	    	else
	    	{
	    		$response['errCode'] 	= 1;
	    		$response['errMsg'] 	= 'Some issue';
	    	}

		}
		else 									// Update the entry
		{
			$activity = ClientActivityLog::find($activityExist->id);

			$activity->invitation_id= $invitationId;
	    	$activity->client_id 	= $clientId;
	    	$activity->activity_id 	= $activityId;
	    	$activity->action 		= $action;

	    	if( $activity->save() )
	    	{
	    		// Get the updated completed activity percentage
	    		$completedActivitiesPercentage = Helper::calculateCompletedActivitiesPercentage($clientId, $invitationId);

	    		$response['errCode'] 	= 0;
	    		$response['errMsg'] 	= 'Activity logged successfully';
	    		$response['percent']	= $completedActivitiesPercentage;
	    	}
	    	else
	    	{
	    		$response['errCode'] 	= 1;
	    		$response['errMsg'] 	= 'Some issue';
	    	}
		}

		return response()->json($response);
    }

    /**
     * Function to save the agent feedback given by the client
     * @param void
     * @return array
     */
    public function updateAgentFeedback()
    {
    	$frmData = Input::get('frmData');

    	$feedbackData = array();

    	// Parse the serialize data
    	parse_str($frmData, $feedbackData);

    	// Get the client and invitation id from session
    	$agentId 		= Session::get('agentId', '');
    	$clientId 		= Session::get('clientId', '');
    	$invitationId 	= Session::get('invitationId', '');

    	$response = array();
    	if( $agentId != '' && $clientId != '' && $invitationId != '' )
    	{
    		// Check if rating already exist
    		$rating = AgentClientRating::where(['invitation_id' => $invitationId, 'agent_id' => $agentId, 'client_id' => $clientId])->first();

    		if( count( $rating ) == 0 )
    		{
	    		$agentClientRating = new AgentClientRating;

	    		$agentClientRating->invitation_id 	= $invitationId;
	    		$agentClientRating->agent_id 		= $agentId;
	    		$agentClientRating->client_id 		= $clientId;
	    		$agentClientRating->rating 			= $feedbackData['agent_rating'];
	    		$agentClientRating->comment 		= $feedbackData['agent_rating_message'];
	    		$agentClientRating->created_at 		= date('Y-m-d H:i:s');

	    		if( $agentClientRating->save() )
	    		{
	    			// Fetch the updated rating percentage
    				$agentRating = AgentClientRating::where(['agent_id' => $agentId])->avg('rating');

	    			$response['errCode'] 	= 0;
		    		$response['errMsg'] 	= 'Thanks for the feedback!';
		    		$response['agentRating']= is_null($agentRating) ? 0 : $agentRating;
	    		}
	    		else
	    		{
	    			$response['errCode'] 	= 1;
		    		$response['errMsg'] 	= 'Some issue in data saving';
	    		}
    		}
    		else
    		{
    			$agentClientRating = AgentClientRating::find($rating->id);

	    		$agentClientRating->invitation_id 	= $invitationId;
	    		$agentClientRating->agent_id 		= $agentId;
	    		$agentClientRating->client_id 		= $clientId;
	    		$agentClientRating->rating 			= $feedbackData['agent_rating'];
	    		$agentClientRating->comment 		= $feedbackData['agent_rating_message'];
	    		$agentClientRating->created_at 		= date('Y-m-d H:i:s');

	    		if( $agentClientRating->save() )
	    		{
	    			// Fetch the updated rating percentage
    				$agentRating = AgentClientRating::where(['agent_id' => $agentId])->avg('rating');

	    			$response['errCode'] 	= 0;
		    		$response['errMsg'] 	= 'Thanks for the feedback!';
		    		$response['agentRating']= is_null($agentRating) ? 0 : $agentRating;
	    		}
	    		else
	    		{
	    			$response['errCode'] 	= 1;
		    		$response['errMsg'] 	= 'Some issue in data saving';
	    		}
    		}
    	}
    	else
    	{
    		$response['errCode'] 	= 2;
	    	$response['errMsg'] 	= 'Invalid user';
    	}

    	return response()->json($response);
    }

    /**
     * Function to update the helpful click response
     * @param void
     * @return array
     */
    public function updateHelpfulCount()
    {
    	$newStatus = Input::get('newStatus');

    	// Get the client and invitation id from session
    	$agentId 		= Session::get('agentId', '');
    	$clientId 		= Session::get('clientId', '');
    	$invitationId 	= Session::get('invitationId', '');

    	$response = array();
    	if( $agentId != '' && $clientId != '' && $invitationId != '' )
    	{
    		// Check if rating already exist
    		$rating = AgentClientRating::where(['invitation_id' => $invitationId, 'agent_id' => $agentId, 'client_id' => $clientId])->first();

    		if( count( $rating ) == 0 )
    		{
	    		$agentClientRating = new AgentClientRating;

	    		$agentClientRating->invitation_id = $invitationId;
	    		$agentClientRating->agent_id 	= $agentId;
	    		$agentClientRating->client_id 	= $clientId;
	    		$agentClientRating->helpful 	= $newStatus;
	    		$agentClientRating->created_at 	= date('Y-m-d H:i:s');

	    		if( $agentClientRating->save() )
	    		{
	    			$response['errCode'] 	= 0;
		    		$response['errMsg'] 	= 'Thanks for the feedback!';
	    		}
	    		else
	    		{
	    			$response['errCode'] 	= 1;
		    		$response['errMsg'] 	= 'Some issue in data saving';
	    		}
    		}
    		else
    		{
    			$agentClientRating = AgentClientRating::find($rating->id);

	    		$agentClientRating->invitation_id = $invitationId;
	    		$agentClientRating->agent_id 	= $agentId;
	    		$agentClientRating->client_id 	= $clientId;
	    		$agentClientRating->helpful 	= $newStatus;
	    		$agentClientRating->created_at 	= date('Y-m-d H:i:s');

	    		if( $agentClientRating->save() )
	    		{
	    			$response['errCode'] 	= 0;
		    		$response['errMsg'] 	= 'Thanks for the feedback!';
	    		}
	    		else
	    		{
	    			$response['errCode'] 	= 1;
		    		$response['errMsg'] 	= 'Some issue in data saving';
	    		}
    		}
    	}
    	else
    	{
    		$response['errCode'] 	= 2;
	    	$response['errMsg'] 	= 'Invalid user';
    	}

    	return response()->json($response);
    }

    /**
     * Function to update the user feedback on individual activity
     * @param void
     * @return array
     */
    public function updateActivityFeedback()
    {
    	$activity = Input::get('activity');
    	$feedback = Input::get('feedback');

    	// Get the client and invitation id from session
    	$clientId 		= Session::get('clientId', '');
    	$invitationId 	= Session::get('invitationId', '');

    	$response = array();
    	if( $clientId != '' && $invitationId != '' && $activity != '' && $feedback != '' )
    	{
    		// Get the id of the activity by its class name
    		$activityDetails = ClientActivityList::where(['activity_class' => $activity])->select('id', 'activity')->first();

    		if( count( $activityDetails ) > 0 )
    		{
    			// Check if feedback already exist
    			$clientFeedback = ClientActivityFeedback::where(['invitation_id' => $invitationId, 'client_id' => $clientId, 'activity_id' => $activityDetails->id])->first();

    			if( count( $clientFeedback ) == 0 )								// No feedback exist, add it
    			{
	    			$ClientActivityFeedback = new ClientActivityFeedback;

					$ClientActivityFeedback->invitation_id 	= $invitationId;
					$ClientActivityFeedback->client_id 		= $clientId;
					$ClientActivityFeedback->activity_id 	= $activityDetails->id;
					$ClientActivityFeedback->feedback 		= $feedback;
					$ClientActivityFeedback->created_at 	= date('Y-m-d H:i:s');

					if( $ClientActivityFeedback->save() )
					{
						$response['errCode'] 	= 0;
	    				$response['errMsg'] 	= 'Thanks for the feedback';
					}
					else
					{
						$response['errCode'] 	= 1;
	    				$response['errMsg'] 	= 'Some error in saving the feedback';
					}
    			}
    			else 														// Feedback exist, update it
    			{
    				$ClientActivityFeedback = ClientActivityFeedback::where(['invitation_id' => $invitationId, 'client_id' => $clientId, 'activity_id' => $activityDetails->id])->first();

					$ClientActivityFeedback->invitation_id 	= $invitationId;
					$ClientActivityFeedback->client_id 		= $clientId;
					$ClientActivityFeedback->activity_id 	= $activityDetails->id;
					$ClientActivityFeedback->feedback 		= $feedback;
					$ClientActivityFeedback->created_at 	= date('Y-m-d H:i:s');

					if( $ClientActivityFeedback->save() )
					{
						$response['errCode'] 	= 0;
	    				$response['errMsg'] 	= 'Thanks for the feedback';
					}
					else
					{
						$response['errCode'] 	= 1;
	    				$response['errMsg'] 	= 'Some error in saving the feedback';
					}
    			}
    		}
    		else
    		{
    			$response['errCode'] 	= 3;
	    		$response['errMsg'] 	= 'Invalid activity selected';
    		}
    	}
    	else
    	{
    		$response['errCode'] 	= 4;
	    	$response['errMsg'] 	= 'Invalid request, missing required parameter';
    	}

    	return response()->json($response);
    }

    /**
     * Function save the user's moving query detail
     * @param void
     * @return array
     */
    public function saveUserMovingQuery()
    {
    	$frmData = Input::get('frmData');

    	// Get the client and invitation id from session
    	$clientId 		= Session::get('clientId', '');
    	$invitationId 	= Session::get('invitationId', '');

    	// Company category 
    	$companyCategory= 3;	// Moving company category

    	// To hold the required services
    	$requiredServices = array();

    	$details = array();
    	parse_str($frmData, $details);

    	// Check if the request already exist
    	$movingRequest = MovingItemServiceRequest::where(['status' => '1', 'agent_client_id' => $clientId, 'invitation_id' => $invitationId])->first();

    	$itemsQuantities 		= array();
    	$specialInstructions 	= array();
    	$movingHouseVehicleType = array();
    	$response = array();
    	
    	// if( count( $movingRequest ) == 0 )	// Hold it for now
    	if( 1 )
    	{
    		// Check how many services request are raised
    		if( isset( $details['moving_house_additional_service'][6] ) && $details['moving_house_additional_service'][6] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_1');
    		}
    		if( isset( $details['moving_house_additional_service'][7] ) && $details['moving_house_additional_service'][7] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_2');
    		}
    		if( isset( $details['moving_house_additional_service'][8] ) && $details['moving_house_additional_service'][8] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_3');
    		}
    		if( isset( $details['moving_house_additional_service'][9] ) && $details['moving_house_additional_service'][9] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_4');
    		}
    		if( isset( $details['moving_house_additional_service'][10] ) && $details['moving_house_additional_service'][10] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_5');
    		}
    		if( isset( $details['moving_house_vehicle_type'] ) && $details['moving_house_vehicle_type'] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_vehicle_type');
    		}

    		$filteredCompanies = $this->getFilteredMoverCompaniesList($clientId, $companyCategory, $requiredServices);

    		// Transaction start
    		DB::beginTransaction();

    		$successCount = 0;
    		if( count( $filteredCompanies ) > 0 )
    		{
    			foreach ($filteredCompanies as $filterCompany)
    			{
    				// Check the payment plan quota, if quota exceeds don't send the quotation
    				if( Helper::checkPaymentPlanSubscriptionQuota($filterCompany->company_id, 2) )	// company id, payment plan type id
    				{
	    				// Save the data in moving_item_service_requests
				    	$movingServiceRequest = new MovingItemServiceRequest;

				    	$movingServiceRequest->agent_client_id 	= $clientId;
				    	$movingServiceRequest->invitation_id 	= $invitationId;
				    	$movingServiceRequest->mover_company_id = $filterCompany->company_id;

				    	$movingServiceRequest->moving_to_house_type = $details['moving_house_to_type'];
				    	$movingServiceRequest->moving_to_floor = $details['moving_house_to_level'];
				    	$movingServiceRequest->moving_to_bedroom_count = $details['moving_house_to_bedroom_count'];
				    	$movingServiceRequest->moving_to_property_type = $details['moving_house_to_property_type'];

				    	$movingServiceRequest->moving_from_house_type = $details['moving_house_from_type'];
				    	$movingServiceRequest->moving_from_floor = $details['moving_house_from_level'];
				    	$movingServiceRequest->moving_from_bedroom_count = $details['moving_house_from_bedroom_count'];
				    	$movingServiceRequest->moving_from_property_type = $details['moving_house_from_property_type'];

				    	$movingServiceRequest->callback_option 	= isset( $details['moving_house_callback_option'] ) ? $details['moving_house_callback_option'] : 0;
				    	$movingServiceRequest->callback_time 	= isset( $details['moving_house_callback_time'] ) ? $details['moving_house_callback_time'] : null;

				    	$movingServiceRequest->transportation_vehicle_type = isset( $details['moving_house_vehicle_type'] ) ? $details['moving_house_vehicle_type'] : null;

				    	$movingServiceRequest->insurance = isset( $details['moving_house_need_insurance'] ) ? $details['moving_house_need_insurance'] : null;

				    	$movingServiceRequest->primary_no 	= $details['moving_house_callback_primary_no'];
				    	$movingServiceRequest->secondary_no = $details['moving_house_callback_secondary_no'];
				    	
				    	$movingServiceRequest->moving_date = date('Y-m-d H:i:s', strtotime( $details['moving_house_date'] ) );
				    	$movingServiceRequest->additional_information = $details['moving_house_additional_information'];
				    	$movingServiceRequest->status = '1';
				    	$movingServiceRequest->created_by = $clientId;

				    	if( $movingServiceRequest->save() )
				    	{
				    		$successCount++;

				    		// Update the payment plan remaining quota count
				    		PaymentPlanSubscription::where('subscriber_id', '=', $filterCompany->company_id)			// subscriber is either company / agent
		    										->where('plan_type_id', '=', '2')									// plan type is either for company / agent
		    										->where('status', '=', '1')
		    										->update(['remaining_qouta' => DB::raw('remaining_qouta - 1')]);

				    		// Get the items quantities
				    		foreach( $details['item_quantity'] as $itemKey => $itemValue )
				    		{
				    			if( $itemValue != '' && $itemValue > 0 )
				    			{
				    				$itemsQuantities[] = array(
				    					'moving_items_service_id' => $movingServiceRequest->id,
				    					'moving_items_details_id' => $itemKey,
				    					'quantity' => $itemValue,
				    					'created_at' => date('Y-m-d H:i:s'),
				    					'created_by' => $clientId
				    				);
				    			}
				    		}

				    		// Get the data for moving_other_item_service_requests
				    		if( isset( $details['moving_house_special_instruction'] ) && count( $details['moving_house_special_instruction'] ) > 0 )
				    		{
				    			foreach( $details['moving_house_special_instruction'] as $itemKey => $itemValue )
				    			{
					    			$specialInstructions[] = array(
					    				'other_moving_items_services_id' => $itemKey,
					    				'moving_items_service_id' => $movingServiceRequest->id,
					    				'created_at' => date('Y-m-d H:i:s'),
					    				'created_by' => $clientId
					    			);
					    		}
				    		}

				    		// Get the Transportation Vehicle type selection
				    		if( isset( $details['moving_house_vehicle_type'] ) )
				    		{
				    			$movingHouseVehicleType[] = array(
				    				'transportation_id' => 1,
				    				'moving_items_services_id' => $movingServiceRequest->id,
				    				'created_at' => date('Y-m-d H:i:s'),
					    			'created_by' => $clientId
				    			);
				    		}
				    	}

				    	// Add the company email entry
			    		$createdAt = date('Y-m-d H:i:s');
			    		DB::table('company_request_emails')->insert(['comapny_id' => $filterCompany->company_id, 'client_id' => $clientId, 'invitation_id' => $invitationId, 'email_send_status' => '0', 'created_at' => $createdAt]);
    				}
    			}
    		}

	    	if( $successCount > 0 )
	    	{
	    		// Save the data in moving_item_detail_service_requests table
	    		if( count( $itemsQuantities ) > 0 )
	    		{
	    			MovingItemDetailServiceRequest::insert($itemsQuantities);
	    		}

	    		// Save the data in moving_other_item_service_requests
	    		if( count( $itemsQuantities ) > 0 )
	    		{
	    			MovingOtherItemServiceRequest::insert($specialInstructions);
	    		}

	    		// Save the data in moving_item_detail_service_requests
	    		if( count( $movingHouseVehicleType ) > 0 )
	    		{
	    			MovingTransportationTypeRequest::insert($movingHouseVehicleType);
	    		}

	    		// Commit transaction
	    		DB::commit();

	    		$response['errCode'] 	= 0;
	    		$response['errMsg'] 	= 'Request added successfully';
				
				//get company deatil
				$companyDetail = Company::findOrFail($filterCompany->company_id);
				
				$agentClient = AgentClient::findOrFail($clientId);
				$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
				
				//email needs to be sent to this company
				// Mail::to( $companyDetail->email )->send(new MoverQuotationRequest($agentClientName, $companyDetail->company_name, $filterCompany->company_id, $clientId, $invitationId));
	    	}
	    	else
	    	{
	    		$response['errCode'] 	= 1;
	    		$response['errMsg'] 	= 'No matching company found for the selected services';
	    	}
    	}
    	else
    	{
    		$response['errCode'] 	= 2;
	    	$response['errMsg'] 	= 'Request already exist';
    	}

    	return response()->json($response);
    }

    /**
	 * To get the list of mover companies satisfying all the criteria to get the mover's quotations
	 *
	 * 		- Rules
	 * 		# Company must be active
	 * 		# Company category must match
	 * 		# Availability Mode must be true
	 * 		# Must have a payment plan
	 * 		# Services (Atleast 30% match)
	 * 		# Target Area must lies with in the working area of company or company working on multiple locations
	 *
	 * @param int
	 * @param int
	 * @param array
	 * @return array
	 */
	public function getFilteredMoverCompaniesList($clientId, $companyCategory, $requiredServices)
	{
		// Get the moving from and moving to address of client
		$clientMovingFromAddress = 	DB::table('agent_client_moving_from_addresses as t1')
									->leftJoin('provinces as t2', 't2.id', '=', 't1.province_id')
									->leftJoin('cities as t3', 't3.id', '=', 't1.city_id')
									->leftJoin('countries as t4', 't4.id', '=', 't1.country_id')
									->where(['t1.agent_client_id' => $clientId, 't1.status' => '1'])
									->select('t1.id', 't1.address1', 't1.address2', 't2.name as province', 't3.name as city', 't1.postal_code', 't4.name as country')
									->first();

		// Get the latitude, longitude of the mover from the Google Map API
		$clientMovingFromAddressCoordinates = array();
		// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingFromAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		// $mapApiResponse = json_decode(file_get_contents($url), true);

		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingFromAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$mapApiResponse = json_decode(curl_exec($ch), true);

		if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
		{
			$clientMovingFromAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
		}

		// Get the list of companies which are active, availability mode is on, must have a payment plan, company category also match
		$companies = DB::table('companies as t1')
							->leftJoin('company_categories as t2', 't1.company_category_id', '=', 't2.id')
							->leftJoin('payment_plan_subscriptions as t3', 't3.subscriber_id', '=', 't1.id')
							->where(['t1.status' => '1', 'availability_mode' => '1'])		// status must be active, availability_mode must be on
							->where(['t2.id' => $companyCategory])							// company category must match
							->where(['t3.plan_type_id' => '2', 't3.status' => '1'])			// for company payment plan
							->select('t1.id as company_id', 't1.company_name', 't1.address1', 't1.working_globally', 't1.target_area')
							->get();

		// Check if any company satisfy all the rules or not
		$filteredCompanies 	= array();
		$companyCoordinates = array();
		$minimumPercentage	= 30;
		if( count( $companies ) > 0 )
		{
			// Get the list of all the services provided by these companies, if atleast 30% match, then only send the quotation
			foreach ($companies as $company)
			{
				$services =	DB::table('category_services as t1')
							->leftJoin('category_service_company as t2', 't2.category_service_id', '=', 't1.id')
							->where(['t2.company_id' => $company->company_id, 't1.status' => '1'])
							->select('t1.id', 't1.service')
							->get();

				$matchedServices = 0;
				if( count( $services ) > 0 )
				{
					foreach ($services as $service)
					{
						if( $service->id == 7 )		// Truck Renters
						{
							if( in_array('moving_house_vehicle_type', $requiredServices) )
							{
								$matchedServices++;
							}
						}

						if( $service->id == 8 )		// Boxing service
						{
							if( in_array('moving_house_additional_service_2', $requiredServices) )
							{
								$matchedServices++;
							}
						}

						if( $service->id == 9 )		// Assembling service
						{
							if( in_array('moving_house_additional_service_3', $requiredServices) )
							{
								$matchedServices++;
							}
						}

						if( $service->id == 10 ) 	// Disassembling service
						{
							if( in_array('moving_house_additional_service_3', $requiredServices) )
							{
								$matchedServices++;
							}
						}

						if( $service->id == 11 ) 	// Shuttle Service
						{
							if( in_array('moving_house_additional_service_5', $requiredServices) )
							{
								$matchedServices++;
							}
						}

						if( $service->id == 12 ) 	// Transport service
						{
							if( in_array('moving_house_vehicle_type', $requiredServices) )
							{
								$matchedServices++;
							}
						}

						if( $service->id == 13 ) 	// Storage Service
						{
							if( in_array('moving_house_additional_service_4', $requiredServices) )
							{
								$matchedServices++;
							}
						}

						if( $service->id == 14 ) 	// Packing Service
						{
							if( in_array('moving_house_additional_service_1', $requiredServices) )
							{
								$matchedServices++;
							}
						}
					}
				}

				if( ( $matchedServices / count( $services ) * 100 ) >= $minimumPercentage )
				{
					// For the companies who are not working globally, get the lat long of the address
					if( $company->working_globally != '1' )
					{
						// Get the latitude, longitude of the company address from the Google Map API
						// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
						// $mapApiResponse = json_decode(file_get_contents($url), true);

						$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$mapApiResponse = json_decode(curl_exec($ch), true);

						if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
						{
							$companyCoordinates = $mapApiResponse['results'][0]['geometry']['location'];

							$distance = Helper::distance($companyCoordinates['lat'], $companyCoordinates['lng'], $clientMovingFromAddressCoordinates['lat'], $clientMovingFromAddressCoordinates['lng'], "K");

							if( $distance <= $company->target_area )
							{
								$filteredCompanies[] = $company;
							}
						}
					}
					else
					{
						$filteredCompanies[] = $company;
					}
				}

			}
		}

		return $filteredCompanies;
	}

	/**
     * Function to save the user's tech concierge query detail
     * @param void
     * @return array
     */
    public function saveTechConciergeQuery()
    {
    	$frmData = Input::get('frmData');

    	$techConciergeDetails = array();
    	parse_str($frmData, $techConciergeDetails);

    	// Company category 
    	$companyCategory= 5;	// Tech Concierge company category

    	// Get the client and invitation id from session
    	$clientId 		= Session::get('clientId', '');
    	$invitationId 	= Session::get('invitationId', '');

    	// Required services list
    	$requiredServices = array('installer', 'plumbing', 'painting');

    	$filteredCompanies = $this->getFilteredTechConciergeCompaniesList($clientId, $companyCategory, $requiredServices);

    	// Transaction start
		DB::beginTransaction();

		$response = array();
		$successCount = 0;
		$techConciergePlaces = array();
		$techConciergeAppliances = array();
		$techConciergeOtherDetails = array();
		if( count( $filteredCompanies ) > 0 )
		{
			foreach ($filteredCompanies as $filterCompany)
			{
				// Check the payment plan, if the plan expires don't send the quotations
				if( Helper::checkPaymentPlanSubscriptionQuota($filterCompany->company_id, 2) )	// company id, payment plan type id
				{
					$techConciergeRequest = new TechConciergeServiceRequest;

					$techConciergeRequest->agent_client_id = $clientId;
					$techConciergeRequest->invitation_id = $invitationId;
					$techConciergeRequest->company_id = $filterCompany->company_id;

					$techConciergeRequest->moving_to_house_type = $techConciergeDetails['moving_house_to_type'];
					$techConciergeRequest->moving_to_floor = $techConciergeDetails['moving_house_to_level'];
					$techConciergeRequest->moving_to_bedroom_count = $techConciergeDetails['moving_house_to_bedroom_count'];
					$techConciergeRequest->moving_to_property_type = $techConciergeDetails['moving_house_to_property_type'];
					
					$techConciergeRequest->primary_no = $techConciergeDetails['tech_concierge_callback_primary_no'];
					$techConciergeRequest->secondary_no = $techConciergeDetails['tech_concierge_callback_secondary_no'];
					$techConciergeRequest->additional_information = $techConciergeDetails['tech_concierge_additional_information'];

					$techConciergeRequest->availability_date1 		= date('Y-m-d', strtotime($techConciergeDetails['availability_date1']));
					$techConciergeRequest->availability_time_from1 	= $techConciergeDetails['availability_time_from1'];
					$techConciergeRequest->availability_time_upto1 	= $techConciergeDetails['availability_time_upto1'];
					$techConciergeRequest->availability_date2 		= date('Y-m-d', strtotime($techConciergeDetails['availability_date2']));
					$techConciergeRequest->availability_time_from2 	= $techConciergeDetails['availability_time_from2'];
					$techConciergeRequest->availability_time_upto2 	= $techConciergeDetails['availability_time_upto2'];
					$techConciergeRequest->availability_date3 		= date('Y-m-d', strtotime($techConciergeDetails['availability_date3']));
					$techConciergeRequest->availability_time_from3 	= $techConciergeDetails['availability_time_from3'];
					$techConciergeRequest->availability_time_upto3 	= $techConciergeDetails['availability_time_upto3'];

					$techConciergeRequest->status = '1';
					$techConciergeRequest->created_by = $clientId;

					if( $techConciergeRequest->save() )
					{
						// Commit transaction
	    				DB::commit();

						if( isset( $techConciergeDetails['tech_concierge_places'] ) && count( $techConciergeDetails['tech_concierge_places'] ) > 0 )
						{
							foreach( $techConciergeDetails['tech_concierge_places'] as $place )
							{
								$techConciergePlaces[] = array(
									'service_request_id' => $techConciergeRequest->id,
									'place_id' => $place,
									'created_at' => date('Y-m-d H:i:s'),
									'created_by' => $clientId
								);
							}
						}

						if( isset( $techConciergeDetails['tech_concierge_appliances'] ) && count( $techConciergeDetails['tech_concierge_appliances'] ) > 0 )
						{
							foreach( $techConciergeDetails['tech_concierge_appliances'] as $appliance )
							{
								$techConciergeAppliances[] = array(
									'service_request_id' => $techConciergeRequest->id,
									'appliance_id' => $appliance,
									'created_at' => date('Y-m-d H:i:s'),
									'created_by' => $clientId
								);
							}
						}

						if( isset( $techConciergeDetails['tech_concierge_details'] ) && count( $techConciergeDetails['tech_concierge_details'] ) > 0 )
						{
							foreach( $techConciergeDetails['tech_concierge_details'] as $key => $value )
							{
								if( $value == 1 )
								{
									$techConciergeOtherDetails[] = array(
										'service_request_id' => $techConciergeRequest->id,
										'other_detail_id' => $key,
										'created_at' => date('Y-m-d H:i:s'),
										'created_by' => $clientId
									);
								}
							}
						}

						$successCount++;
					}

		    		// Add the quotation entry
		    		$date = date('Y-m-d');
		    		$paymentPlanSubscription = 	PaymentPlanSubscription::where('subscriber_id', '=', $filterCompany->company_id)	// subscriber is either company / agent
												->where('plan_type_id', '=', '2')			// plan type is either for company / agent
												->where('start_date', '<=', $date)			// plan start date must lie between the today's date
												->where('end_date', '>=', $date) 			// plan end date must lie between the today's date
												->where('status', '=', '1')
												->first();

		    		if( count( $paymentPlanSubscription ) > 0 )
		    		{
		    			$quotation = new QuotationLog;

						$quotation->company_id = $filterCompany->company_id;
						$quotation->client_id = $clientId;
						$quotation->payment_plan_id = $paymentPlanSubscription->plan_id; 
						$quotation->created_at = date('Y-m-d H:i:s');
						$quotation->status = '1';

						$quotation->save();						
		    		}

		    		// Add the company email entry
		    		$createdAt = date('Y-m-d H:i:s');
		    		DB::table('company_request_emails')->insert(['comapny_id' => $filterCompany->company_id, 'client_id' => $clientId, 'invitation_id' => $invitationId, 'email_send_status' => '0', 'created_at' => $createdAt]);

				}
			}

			if( $successCount > 0 )
	    	{
	    		TechConciergePlaceServiceRequest::insert( $techConciergePlaces );

	    		TechConciergeAppliancesServiceRequest::insert( $techConciergeAppliances );

	    		TechConciergeOtherDetailServiceRequest::insert( $techConciergeOtherDetails );

	    		$response['errCode'] 	= 0;
	    		$response['errMsg'] 	= 'Request added successfully';
				
				//get company deatil
				$companyDetail = Company::findOrFail($filterCompany->company_id);
				
				$agentClient = AgentClient::findOrFail($clientId);
				$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
				
				//email needs to be sent to this company
				// Mail::to( $companyDetail->email )->send(new MoverQuotationRequest($agentClientName, $companyDetail->company_name, $filterCompany->company_id, $clientId, $invitationId));
				
	    	}
	    	else
	    	{
	    		$response['errCode'] 	= 1;
	    		$response['errMsg'] 	= 'No matching company found';
	    	}
		}
		else
		{
			$response['errCode'] 	= 2;
	    	$response['errMsg'] 	= 'No matching company found';
		}

		return response()->json($response);
    }

    /**
	 * To get the list of tech concierge companies satisfying all the criteria to get the mover's quotations
	 *
	 * 		- Rules
	 * 		# Company must be active
	 * 		# Company category must match
	 * 		# Availability Mode must be true
	 * 		# Must have a payment plan
	 * 		# Services (Atleast 30% match)
	 * 		# Target Area must lies with in the working area of company or company working on multiple locations
	 *
	 * @param int
	 * @param int
	 * @param array
	 * @return array
	 */
	public function getFilteredTechConciergeCompaniesList($clientId, $companyCategory, $requiredServices)
	{
		// Get the moving from and moving to address of client
		$clientMovingToAddress = 	DB::table('agent_client_moving_to_addresses as t1')
									->leftJoin('provinces as t2', 't2.id', '=', 't1.province_id')
									->leftJoin('cities as t3', 't3.id', '=', 't1.city_id')
									->leftJoin('countries as t4', 't4.id', '=', 't1.country_id')
									->where(['t1.agent_client_id' => $clientId, 't1.status' => '1'])
									->select('t1.id', 't1.address1', 't1.address2', 't2.name as province', 't3.name as city', 't1.postal_code', 't4.name as country')
									->first();

		// Get the latitude, longitude of the mover from the Google Map API
		$clientMovingToAddressCoordinates = array();
		
		// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		// $mapApiResponse = json_decode(file_get_contents($url), true);

		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$mapApiResponse = json_decode(curl_exec($ch), true);

		if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
		{
			$clientMovingToAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
		}

		// Get the list of companies which are active, availability mode is on, must have a payment plan, company category also match
		$companies = DB::table('companies as t1')
							->leftJoin('company_categories as t2', 't1.company_category_id', '=', 't2.id')
							->leftJoin('payment_plan_subscriptions as t3', 't3.subscriber_id', '=', 't1.id')
							->where(['t1.status' => '1', 'availability_mode' => '1'])		// status must be active, availability_mode must be on
							->where(['t2.id' => $companyCategory])							// company category must match
							->where(['t3.plan_type_id' => '2', 't3.status' => '1'])			// for company payment plan
							->select('t1.id as company_id', 't1.company_name', 't1.address1', 't1.working_globally', 't1.target_area')
							->get();

		// Check if any company satisfy all the rules or not
		$filteredCompanies 	= array();
		$companyCoordinates = array();
		$minimumPercentage	= 30;
		if( count( $companies ) > 0 )
		{
			// Get the list of all the services provided by these companies, if atleast 30% match, then only send the quotation
			foreach ($companies as $company)
			{
				$services =	DB::table('category_services as t1')
							->leftJoin('category_service_company as t2', 't2.category_service_id', '=', 't1.id')
							->where(['t2.company_id' => $company->company_id, 't1.status' => '1'])
							->select('t1.id', 't1.service')
							->get();

				$matchedServices = 0;
				if( count( $services ) > 0 )
				{
					foreach ($services as $service)
					{
						if( in_array( strtolower($service->service), $requiredServices) )
						{
							$matchedServices++;
						}
					}
				}

				if( ( $matchedServices / count( $services ) * 100 ) >= $minimumPercentage )
				{
					// For the companies who are not working globally, get the lat long of the address
					if( $company->working_globally != '1' )
					{
						// Get the latitude, longitude of the company address from the Google Map API
						// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
						// $mapApiResponse = json_decode(file_get_contents($url), true);

						$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$mapApiResponse = json_decode(curl_exec($ch), true);

						if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
						{
							$companyCoordinates = $mapApiResponse['results'][0]['geometry']['location'];

							$distance = Helper::distance($companyCoordinates['lat'], $companyCoordinates['lng'], $clientMovingFromAddressCoordinates['lat'], $clientMovingFromAddressCoordinates['lng'], "K");

							if( $distance <= $company->target_area )
							{
								$filteredCompanies[] = $company;
							}
						}
					}
					else
					{
						$filteredCompanies[] = $company;
					}
				}

			}
		}

		return $filteredCompanies;
	}

	/**
     * Function to save the user's cable & internet query detail
     * @param void
     * @return array
     */
    public function saveCableInternetQuery()
    {
    	$frmData = Input::get('frmData');

    	$cableInternetDetails = array();
    	parse_str($frmData, $cableInternetDetails);

    	// Company category 
    	$companyCategory= 4;	// Cable Internet company category

    	// Get the client and invitation id from session
    	$clientId 		= Session::get('clientId', '');
    	$invitationId 	= Session::get('invitationId', '');

    	// Required services list
    	$requiredServices = array('tv', 'internet', 'phone', 'fax', 'security system');

    	$filteredCompanies = $this->getFilteredCableInternetCompaniesList($clientId, $companyCategory, $requiredServices);

    	// Transaction start
		DB::beginTransaction();

		$response = array();
		$successCount = 0;

		$digitalServicesApplied = array();
		$additionalDigitalServicesApplied = array();
		
		//get the agent id through agent client id
		$agentClient = AgentClient::findOrFail($clientId);
		$agentId	 = $agentClient->agent_id;
		
		//Check whether agent has partner that can receive quotation
		$agentPartners = AgentPartner::where(['status' => '1', 'agent_id' => $agentId])->select('id', 'partner_email')->get();
		$agentPartnersNo = count( $agentPartners );
		if( $agentPartnersNo > 0 )
		{	
			foreach ($agentPartnersNo as $agentPartner)
			{
				$digitalServiceRequest = new AgentPartnerDigitalServiceRequest;

				$digitalServiceRequest->agent_client_id = $clientId;
				$digitalServiceRequest->invitation_id = $invitationId;
				$digitalServiceRequest->agent_partner_id = $agentPartner->id;

				$digitalServiceRequest->moving_from_house_type = $cableInternetDetails['cable_internet_house_from_type'];
				$digitalServiceRequest->moving_from_floor = $cableInternetDetails['cable_internet_house_from_level'];
				$digitalServiceRequest->moving_from_bedroom_count = $cableInternetDetails['cable_internet_house_from_bedroom_count'];
				$digitalServiceRequest->moving_from_property_type = $cableInternetDetails['cable_internet_from_property_type'];
				$digitalServiceRequest->moving_to_house_type = $cableInternetDetails['cable_internet_house_to_type'];
				$digitalServiceRequest->moving_to_floor = $cableInternetDetails['cable_internet_house_to_level'];
				$digitalServiceRequest->moving_to_bedroom_count = $cableInternetDetails['cable_internet_house_to_bedroom_count'];
				$digitalServiceRequest->moving_to_property_type = $cableInternetDetails['cable_internet_house_to_property_type'];

				$digitalServiceRequest->have_cable_internet_already = isset( $cableInternetDetails['cable_internet_service_before'] ) ? $cableInternetDetails['cable_internet_service_before'] : '0' ;
				$digitalServiceRequest->employment_status = isset( $cableInternetDetails['cable_internet_employment_status'] ) ? $cableInternetDetails['cable_internet_employment_status'] : '0';
				$digitalServiceRequest->want_to_receive_electronic_bill = isset( $cableInternetDetails['cable_internet_bill_electronically'] ) ? $cableInternetDetails['cable_internet_bill_electronically'] : '0';
				$digitalServiceRequest->want_to_contract_plan = isset( $cableInternetDetails['cable_internet_contract_plan'] ) ? $cableInternetDetails['cable_internet_contract_plan'] : '0';
				$digitalServiceRequest->want_to_setup_preauthorise_payment = isset( $cableInternetDetails['cable_internet_preauthorise_payment'] ) ? $cableInternetDetails['cable_internet_preauthorise_payment'] : '0';
				$digitalServiceRequest->callback_option = isset( $cableInternetDetails['cable_internet_callback_option'] ) ? $cableInternetDetails['cable_internet_callback_option'] : '0';
				
				if( isset( $cableInternetDetails['cable_internet_callback_time'] ) )
				{
					$digitalServiceRequest->callback_time = $cableInternetDetails['cable_internet_callback_time'];
				}
				
				$digitalServiceRequest->primary_no = $cableInternetDetails['cable_internet_callback_primary_no'];
				$digitalServiceRequest->secondary_no = $cableInternetDetails['cable_internet_callback_secondary_no'];
				$digitalServiceRequest->additional_information = $cableInternetDetails['cable_internet_additional_info'];
				$digitalServiceRequest->status = '1';
				$digitalServiceRequest->created_by = $clientId;

				if( $digitalServiceRequest->save() )
				{
					// Commit transaction
	    			DB::commit();

					if( isset( $cableInternetDetails['cable_internet_service_type'] ) && count( $cableInternetDetails['cable_internet_service_type'] ) > 0 )
					{
						foreach( $cableInternetDetails['cable_internet_service_type'] as $serviceId )
						{
							$digitalServicesApplied[] = array(
								'digital_service_request_id' => $digitalServiceRequest->id,
								'digital_service_type_id' => $serviceId,
								'created_at' => date('Y-m-d H:i:s'),
								'status' => '1',
								'created_by' => $clientId
							);
						}
					}

					if( isset( $cableInternetDetails['cable_internet_additional_service'] ) && count( $cableInternetDetails['cable_internet_additional_service'] ) > 0 )
					{
						foreach( $cableInternetDetails['cable_internet_additional_service'] as $additionalServiceId )
						{
							$additionalDigitalServicesApplied[] = array(
								'digital_service_request_id' => $digitalServiceRequest->id,
								'digital_additional_service_type_id' => $additionalServiceId,
								'created_at' => date('Y-m-d H:i:s'),
								'status' => '1',
								'created_by' => $clientId
							);
						}
					}

					$successCount++;
				}

		    	if( $successCount > 0 )
				{
					AgentPartnerDigitalServiceTypeRequest::insert( $digitalServicesApplied );

					AgentPartnerDigitalAdditionalServiceTypeRequest::insert( $additionalDigitalServicesApplied );

					$response['errCode'] 	= 0;
					$response['errMsg'] 	= 'Request added successfully';
					
					// Mail::to( $agentPartner->partner_email )->send(new Quotation($agentPartner, $digitalServiceRequest));

				}
				else
				{
					$response['errCode'] 	= 1;
					$response['errMsg'] 	= 'Error in adding the request to the server';
				}

			}

		}		
		elseif( count( $filteredCompanies ) > 0 )
		{
			foreach ($filteredCompanies as $filterCompany)
			{
				// Check the payment plan, if the plan expires don't send the quotations
				if( Helper::checkPaymentPlanSubscriptionQuota($filterCompany->company_id, 2) )	// company id, payment plan type id
				{
					$digitalServiceRequest = new DigitalServiceRequest;

					$digitalServiceRequest->agent_client_id = $clientId;
					$digitalServiceRequest->invitation_id = $invitationId;
					$digitalServiceRequest->digital_service_company_id = $filterCompany->company_id;

					$digitalServiceRequest->moving_from_house_type = $cableInternetDetails['cable_internet_house_from_type'];
					$digitalServiceRequest->moving_from_floor = $cableInternetDetails['cable_internet_house_from_level'];
					$digitalServiceRequest->moving_from_bedroom_count = $cableInternetDetails['cable_internet_house_from_bedroom_count'];
					$digitalServiceRequest->moving_from_property_type = $cableInternetDetails['cable_internet_from_property_type'];
					$digitalServiceRequest->moving_to_house_type = $cableInternetDetails['cable_internet_house_to_type'];
					$digitalServiceRequest->moving_to_floor = $cableInternetDetails['cable_internet_house_to_level'];
					$digitalServiceRequest->moving_to_bedroom_count = $cableInternetDetails['cable_internet_house_to_bedroom_count'];
					$digitalServiceRequest->moving_to_property_type = $cableInternetDetails['cable_internet_house_to_property_type'];

					$digitalServiceRequest->have_cable_internet_already = isset( $cableInternetDetails['cable_internet_service_before'] ) ? $cableInternetDetails['cable_internet_service_before'] : '0';
					$digitalServiceRequest->employment_status = isset( $cableInternetDetails['cable_internet_employment_status'] ) ? $cableInternetDetails['cable_internet_employment_status'] : '0';
					$digitalServiceRequest->want_to_receive_electronic_bill = isset( $cableInternetDetails['cable_internet_bill_electronically'] ) ? $cableInternetDetails['cable_internet_bill_electronically'] : '0';
					$digitalServiceRequest->want_to_contract_plan = isset( $cableInternetDetails['cable_internet_contract_plan'] ) ? $cableInternetDetails['cable_internet_contract_plan'] : '0';
					$digitalServiceRequest->want_to_setup_preauthorise_payment = isset( $cableInternetDetails['cable_internet_preauthorise_payment'] ) ? $cableInternetDetails['cable_internet_preauthorise_payment'] : '0';
					$digitalServiceRequest->callback_option = isset( $cableInternetDetails['cable_internet_callback_option'] ) ? $cableInternetDetails['cable_internet_callback_option'] : '0'; 
					if( isset( $cableInternetDetails['cable_internet_callback_time'] ) )
					{
						$digitalServiceRequest->callback_time = $cableInternetDetails['cable_internet_callback_time'];
					}

					$digitalServiceRequest->primary_no = $cableInternetDetails['cable_internet_callback_primary_no'];
					$digitalServiceRequest->secondary_no = $cableInternetDetails['cable_internet_callback_secondary_no'];
					$digitalServiceRequest->additional_information = $cableInternetDetails['cable_internet_additional_info'];
					$digitalServiceRequest->status = '1';
					$digitalServiceRequest->created_by = $clientId;

					if( $digitalServiceRequest->save() )
					{
						// Commit transaction
	    				DB::commit();

						if( isset( $cableInternetDetails['cable_internet_service_type'] ) && count( $cableInternetDetails['cable_internet_service_type'] ) > 0 )
						{
							foreach( $cableInternetDetails['cable_internet_service_type'] as $serviceId )
							{
								$digitalServicesApplied[] = array(
									'digital_service_request_id' => $digitalServiceRequest->id,
									'digital_service_type_id' => $serviceId,
									'created_at' => date('Y-m-d H:i:s'),
									'status' => '1',
									'created_by' => $clientId
								);
							}
						}

						if( isset( $cableInternetDetails['cable_internet_additional_service'] ) && count( $cableInternetDetails['cable_internet_additional_service'] ) > 0 )
						{
							foreach( $cableInternetDetails['cable_internet_additional_service'] as $additionalServiceId )
							{
								$additionalDigitalServicesApplied[] = array(
									'digital_service_request_id' => $digitalServiceRequest->id,
									'digital_additional_service_type_id' => $additionalServiceId,
									'created_at' => date('Y-m-d H:i:s'),
									'status' => '1',
									'created_by' => $clientId
								);
							}
						}

						$successCount++;
					}

		    		// Add the quotation entry
		    		$date = date('Y-m-d');
		    		$paymentPlanSubscription = 	PaymentPlanSubscription::where('subscriber_id', '=', $filterCompany->company_id)	// subscriber is either company / agent
												->where('plan_type_id', '=', '2')			// plan type is either for company / agent
												->where('start_date', '<=', $date)			// plan start date must lie between the today's date
												->where('end_date', '>=', $date) 			// plan end date must lie between the today's date
												->where('status', '=', '1')
												->first();

		    		if( count( $paymentPlanSubscription ) > 0 )
		    		{
		    			$quotation = new QuotationLog;

						$quotation->company_id = $filterCompany->company_id;
						$quotation->client_id = $clientId;
						$quotation->payment_plan_id = $paymentPlanSubscription->plan_id; 
						$quotation->created_at = date('Y-m-d H:i:s');
						$quotation->status = '1';

						$quotation->save();						
		    		}

		    		// Add the company email entry
		    		$createdAt = date('Y-m-d H:i:s');
		    		DB::table('company_request_emails')->insert(['comapny_id' => $filterCompany->company_id, 'client_id' => $clientId, 'invitation_id' => $invitationId, 'email_send_status' => '0', 'created_at' => $createdAt]);

				}
			}

			if( $successCount > 0 )
	    	{
	    		DigitalServiceTypeRequest::insert( $digitalServicesApplied );

	    		DigitalAdditionalServiceTypeRequest::insert( $additionalDigitalServicesApplied );

	    		$response['errCode'] 	= 0;
	    		$response['errMsg'] 	= 'Request added successfully';
				
				//get company deatil
				$companyDetail = Company::findOrFail($filterCompany->company_id);
				
				$agentClient = AgentClient::findOrFail($clientId);
				$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
				
				//email needs to be sent to this company
				// Mail::to( $companyDetail->email )->send(new MoverQuotationRequest($agentClientName, $companyDetail->company_name, $filterCompany->company_id, $clientId, $invitationId));
	    	}
	    	else
	    	{
	    		$response['errCode'] 	= 1;
	    		$response['errMsg'] 	= 'No matching company found';
	    	}

		}
		else
		{
			$response['errCode'] 	= 2;
	    	$response['errMsg'] 	= 'No matching company found';
		}

		return response()->json($response);
    }

    /**
	 * To get the list of cable & internet companies satisfying all the criteria to get the mover's quotations
	 *
	 * 		- Rules
	 * 		# Company must be active
	 * 		# Company category must match
	 * 		# Availability Mode must be true
	 * 		# Must have a payment plan
	 * 		# Services (Atleast 30% match)
	 * 		# Target Area must lies with in the working area of company or company working on multiple locations
	 *
	 * @param int
	 * @param int
	 * @param array
	 * @return array
	 */
	public function getFilteredCableInternetCompaniesList($clientId, $companyCategory, $requiredServices)
	{
		// Get the moving from and moving to address of client
		$clientMovingToAddress = 	DB::table('agent_client_moving_to_addresses as t1')
									->leftJoin('provinces as t2', 't2.id', '=', 't1.province_id')
									->leftJoin('cities as t3', 't3.id', '=', 't1.city_id')
									->leftJoin('countries as t4', 't4.id', '=', 't1.country_id')
									->where(['t1.agent_client_id' => $clientId, 't1.status' => '1'])
									->select('t1.id', 't1.address1', 't1.address2', 't2.name as province', 't3.name as city', 't1.postal_code', 't4.name as country')
									->first();

		// Get the latitude, longitude of the mover from the Google Map API
		$clientMovingToAddressCoordinates = array();
		
		// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		// $mapApiResponse = json_decode(file_get_contents($url), true);

		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$mapApiResponse = json_decode(curl_exec($ch), true);
		
		if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
		{
			$clientMovingToAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
		}

		// Get the list of companies which are active, availability mode is on, must have a payment plan, company category also match
		$companies = DB::table('companies as t1')
					->leftJoin('company_categories as t2', 't1.company_category_id', '=', 't2.id')
					->leftJoin('payment_plan_subscriptions as t3', 't3.subscriber_id', '=', 't1.id')
					->where(['t1.status' => '1', 'availability_mode' => '1'])		// status must be active, availability_mode must be on
					->where(['t2.id' => $companyCategory])							// company category must match
					->where(['t3.plan_type_id' => '2', 't3.status' => '1'])			// for company payment plan
					->select('t1.id as company_id', 't1.company_name', 't1.address1', 't1.working_globally', 't1.target_area')
					->get();

		// Check if any company satisfy all the rules or not
		$filteredCompanies 	= array();
		$companyCoordinates = array();
		$minimumPercentage	= 30;
		if( count( $companies ) > 0 )
		{
			// Get the list of all the services provided by these companies, if atleast 30% match, then only send the quotation
			foreach ($companies as $company)
			{
				$services =	DB::table('category_services as t1')
							->leftJoin('category_service_company as t2', 't2.category_service_id', '=', 't1.id')
							->where(['t2.company_id' => $company->company_id, 't1.status' => '1'])
							->select('t1.id', 't1.service')
							->get();

				$matchedServices = 0;
				if( count( $services ) > 0 )
				{
					foreach ($services as $service)
					{
						if( in_array( strtolower($service->service), $requiredServices) )
						{
							$matchedServices++;
						}
					}
				}

				if( ( $matchedServices / count( $services ) * 100 ) >= $minimumPercentage )
				{
					// For the companies who are not working globally, get the lat long of the address
					if( $company->working_globally != '1' )
					{
						// Get the latitude, longitude of the company address from the Google Map API
						// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
						// $mapApiResponse = json_decode(file_get_contents($url), true);

						$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$mapApiResponse = json_decode(curl_exec($ch), true);

						if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
						{
							$companyCoordinates = $mapApiResponse['results'][0]['geometry']['location'];

							$distance = Helper::distance($companyCoordinates['lat'], $companyCoordinates['lng'], $clientMovingFromAddressCoordinates['lat'], $clientMovingFromAddressCoordinates['lng'], "K");

							if( $distance <= $company->target_area )
							{
								$filteredCompanies[] = $company;
							}
						}
					}
					else
					{
						$filteredCompanies[] = $company;
					}
				}

			}
		}

		return $filteredCompanies;
	}

	/**
     * Function to save the user's home cleaning query detail
     * @param void
     * @return array
     */
    public function saveHomeCleaningQuery()
    {
    	$frmData = Input::get('frmData');

    	$homeCleaningDetails = array();
    	parse_str($frmData, $homeCleaningDetails);

    	// Company category 
    	$companyCategory= 2;	// Home Cleaning Service Company

    	// Get the client and invitation id from session
    	$clientId 		= Session::get('clientId', '');
    	$invitationId 	= Session::get('invitationId', '');

		$filteredCompanies = $this->getFilteredHomeCleaningCompaniesList($clientId, $companyCategory);

     	// Transaction start
 		DB::beginTransaction();

 		$response = array();
 		$successCount = 0;

 		$otherPlacesToClean = array();
 		$additionalServices = array();
 		$steamServices  	= array();
 		if( count( $filteredCompanies ) > 0 )
 		{
 			foreach ($filteredCompanies as $filterCompany)
 			{
 				// Check the payment plan, if the plan expires don't send the quotations
 				if( Helper::checkPaymentPlanSubscriptionQuota($filterCompany->company_id, 2) )	// company id, payment plan type id
 				{
 					$homeCleaningServiceRequest = new HomeCleaningServiceRequest;

 					$homeCleaningServiceRequest->agent_client_id = $clientId;
 					$homeCleaningServiceRequest->invitation_id 	= $invitationId;
 					$homeCleaningServiceRequest->company_id = $filterCompany->company_id;

 					$homeCleaningServiceRequest->move_out_cleaning 	= $homeCleaningDetails['home_cleaning_moveout'];
 					$homeCleaningServiceRequest->move_in_cleaning 	= $homeCleaningDetails['home_cleaning_movein'];

 					$homeCleaningServiceRequest->moving_from_house_type = $homeCleaningDetails['home_cleaning_house_from_type'];
 					$homeCleaningServiceRequest->moving_from_floor = $homeCleaningDetails['home_cleaning_house_from_level'];
 					$homeCleaningServiceRequest->moving_from_bedroom_count = $homeCleaningDetails['home_cleaning_house_from_bedroom_count'];
 					$homeCleaningServiceRequest->moving_from_property_type = $homeCleaningDetails['home_cleaning_house_from_property_type'];

 					$homeCleaningServiceRequest->moving_to_house_type = $homeCleaningDetails['home_cleaning_house_to_type'];
 					$homeCleaningServiceRequest->moving_to_floor = $homeCleaningDetails['home_cleaning_house_to_level'];
 					$homeCleaningServiceRequest->moving_to_bedroom_count = $homeCleaningDetails['home_cleaning_house_to_bedroom_count'];
 					$homeCleaningServiceRequest->moving_to_property_type = $homeCleaningDetails['home_cleaning_house_to_property_type'];

 					$homeCleaningServiceRequest->home_condition = isset( $homeCleaningDetails['home_cleaning_condition'] ) ? $homeCleaningDetails['home_cleaning_condition'] : '';
 					$homeCleaningServiceRequest->home_cleaning_level = isset( $homeCleaningDetails['home_cleaning_levels'] ) ? $homeCleaningDetails['home_cleaning_levels'] : '';
 					$homeCleaningServiceRequest->home_cleaning_area = isset( $homeCleaningDetails['home_cleaning_area'] ) ? $homeCleaningDetails['home_cleaning_area'] : '';
 					$homeCleaningServiceRequest->home_cleaning_people_count = isset( $homeCleaningDetails['home_cleaning_peoples_count'] ) ? $homeCleaningDetails['home_cleaning_peoples_count'] : '';
 					$homeCleaningServiceRequest->home_cleaning_pet_count = isset( $homeCleaningDetails['home_cleaning_pets_count'] ) ? $homeCleaningDetails['home_cleaning_pets_count'] : '';
 					$homeCleaningServiceRequest->home_cleaning_bathroom_count = isset( $homeCleaningDetails['home_cleaning_bathrooms_count'] ) ? $homeCleaningDetails['home_cleaning_bathrooms_count'] : '';

 					$homeCleaningServiceRequest->cleaning_behind_refrigerator_and_stove = isset( $homeCleaningDetails['home_cleaning_behind_refrigerator_stove'] ) ? $homeCleaningDetails['home_cleaning_behind_refrigerator_stove'] : '0';
 					$homeCleaningServiceRequest->baseboard_to_be_washed = isset( $homeCleaningDetails['home_cleaning_baseboard'] ) ? $homeCleaningDetails['home_cleaning_baseboard'] : '0';

 					$homeCleaningServiceRequest->primary_no = $homeCleaningDetails['home_cleaning_callback_primary_no'];
 					$homeCleaningServiceRequest->secondary_no = $homeCleaningDetails['home_cleaning_callback_secondary_no'];

 					$homeCleaningServiceRequest->additional_information = $homeCleaningDetails['home_cleaning_additional_information'];
 					$homeCleaningServiceRequest->status = '1';
 					$homeCleaningServiceRequest->created_by = $clientId;

 					if( $homeCleaningServiceRequest->save() )
 					{
 						// Commit transaction
 	    				DB::commit();

 						if( isset( $homeCleaningDetails['home_cleaning_steaming_services'] ) && count( $homeCleaningDetails['home_cleaning_steaming_services'] ) > 0 )
 						{
 							foreach( $homeCleaningDetails['home_cleaning_steaming_services'] as $serviceId )
 							{
 								$steamServices[] = array(
 									'service_request_id' => $homeCleaningServiceRequest->id,
 									'steaming_service_id' => $serviceId,
 									'created_at' => date('Y-m-d H:i:s'),
 									'status' => '1',
 									'created_by' => $clientId
 								);
 							}
 						}

 						if( isset( $homeCleaningDetails['home_cleaning_other_places'] ) && count( $homeCleaningDetails['home_cleaning_other_places'] ) > 0 )
 						{
 							foreach( $homeCleaningDetails['home_cleaning_other_places'] as $serviceId )
 							{
 								$otherPlacesToClean[] = array(
 									'service_request_id' => $homeCleaningServiceRequest->id,
 									'other_place_id' => $serviceId,
 									'created_at' => date('Y-m-d H:i:s'),
 									'status' => '1',
 									'created_by' => $clientId
 								);
 							}
 						}

 						if( isset( $homeCleaningDetails['home_cleaning_additional_services'] ) && count( $homeCleaningDetails['home_cleaning_additional_services'] ) > 0 )
 						{
 							foreach( $homeCleaningDetails['home_cleaning_additional_services'] as $key => $value )
 							{
 								if( $value != '' )
 								{
	 								$additionalServices[] = array(
	 									'service_request_id' => $homeCleaningServiceRequest->id,
	 									'additional_request_id' => $key,
	 									'quantity' => $value,
	 									'created_at' => date('Y-m-d H:i:s'),
	 									'status' => '1',
	 									'created_by' => $clientId
	 								);
 								}
 							}
 						}

 						$successCount++;
 						
 					}

 					// Add the quotation entry
 		    		$date = date('Y-m-d');
 		    		$paymentPlanSubscription = 	PaymentPlanSubscription::where('subscriber_id', '=', $filterCompany->company_id)	// subscriber is either company / agent
 												->where('plan_type_id', '=', '2')			// plan type is either for company / agent
 												->where('start_date', '<=', $date)			// plan start date must lie between the today's date
 												->where('end_date', '>=', $date) 			// plan end date must lie between the today's date
 												->where('status', '=', '1')
 												->first();

 		    		if( count( $paymentPlanSubscription ) > 0 )
 		    		{
 		    			$quotation = new QuotationLog;

 						$quotation->company_id = $filterCompany->company_id;
 						$quotation->client_id = $clientId;
 						$quotation->payment_plan_id = $paymentPlanSubscription->plan_id; 
 						$quotation->created_at = date('Y-m-d H:i:s');
 						$quotation->status = '1';

 						$quotation->save();						
 		    		}

 		    		// Add the company email entry
		    		$createdAt = date('Y-m-d H:i:s');
		    		DB::table('company_request_emails')->insert(['comapny_id' => $filterCompany->company_id, 'client_id' => $clientId, 'invitation_id' => $invitationId, 'email_send_status' => '0', 'created_at' => $createdAt]);
 				}
 			}

			if( $successCount > 0 )
	    	{
				HomeCleaningAdditionalServiceRequest::insert( $additionalServices );

	    		HomeCleaningOtherPlaceServiceRequest::insert( $otherPlacesToClean );

	    		HomeCleaningSteamingServiceRequest::insert( $steamServices );

	    		$response['errCode'] 	= 0;
	    		$response['errMsg'] 	= 'Request added successfully';
				
				//get company deatil
				$companyDetail = Company::findOrFail($filterCompany->company_id);
				
				$agentClient = AgentClient::findOrFail($clientId);
				$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
				
				//email needs to be sent to this company
				// Mail::to( $companyDetail->email )->send(new MoverQuotationRequest($agentClientName, $companyDetail->company_name, $filterCompany->company_id, $clientId, $invitationId));
	    	}
	    	else
	    	{
	    		$response['errCode'] 	= 1;
	    		$response['errMsg'] 	= 'No matching company found';
	    	}
 		}
 		else
 		{
 			$response['errCode'] 	= 2;
	    	$response['errMsg'] 	= 'No matching company found';
 		}

 		return response()->json($response);
    }

    /**
     * Function for Quotation Response
     * @param void
     * @return array
     */
    public function quotationResponse()
    {
    	$agentId 		= base64_decode(Input::get('agent_id'));
       	$clientId 		= base64_decode(Input::get('client_id'));
       	$invitationId 	= base64_decode(Input::get('invitation_id'));

       	session(['agentId' => $agentId,'clientId' => $clientId, 'invitationId' => $invitationId]);

        return view('movers/quotationResponse');
    }


    /**
     * Function to return the datatable of Quotation Response
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function getQuotationResponse()
    {
        $start      = Input::get('iDisplayStart');      // Offset
        $length     = Input::get('iDisplayLength');     // Limit
        $sSearch    = Input::get('sSearch');            // Search string
        $col        = Input::get('iSortCol_0');         // Column number for sorting
        $sortType   = Input::get('sSortDir_0');         // Sort type

        // Get the client and invitation id from session
    	$clientId 		= Session::get('clientId');
    	$invitationId 	= Session::get('invitationId');

    	// Get the gst, pst, hst, service charge for the client
    	$clientProvinceCharges 	= DB::table('agent_clients as t1')
    							->leftJoin('agent_client_moving_to_addresses as t2', 't1.id', '=', 't2.agent_client_id')
    							// ->leftJoin('provinces as t3', 't2.province_id', 't3.id', '=', 't3.id')
    							->leftJoin('provinces as t3', 't2.province_id', '=', 't3.id')
    							->where(['t1.id' => $clientId])
    							->select('t3.pst', 't3.gst', 't3.hst', 't3.service_charge')
    							->first();
        
        $techConciergeArray = DB::table('tech_concierge_service_requests as t1')
                                ->leftJoin('companies as t2', 't1.company_id', '=', 't2.id')
                                // ->where('t1.agent_client_id', '=', $clientId)
                                // ->where('t1.invitation_id', '=', $invitationId)
                                ->where(['t1.agent_client_id' => $clientId, 't1.invitation_id' => $invitationId, 'company_response' => '1'])
                                ->select('t1.id', 't2.company_name', 't2.id as company_id', 't1.id as request_id', 't1.created_at', 't1.updated_at', 't1.discount')
                                ->get();

        $homeCleaningArray = DB::table('home_cleaning_service_requests as t1')
                                ->leftJoin('companies as t2', 't1.company_id', '=', 't2.id')
                                // ->where('t1.agent_client_id', '=', $clientId)
                                // ->where('t1.invitation_id', '=', $invitationId)
                                ->where(['t1.agent_client_id' => $clientId, 't1.invitation_id' => $invitationId, 'company_response' => '1'])
                                ->select('t1.id', 't2.company_name', 't2.id as company_id', 't1.id as request_id', 't1.created_at', 't1.updated_at', 't1.discount')
                                ->get();

        $movingItemArray = DB::table('moving_item_service_requests as t1')
                                ->leftJoin('companies as t2', 't1.mover_company_id', '=', 't2.id')
                                // ->where('t1.agent_client_id', '=', $clientId)
                                // ->where('t1.invitation_id', '=', $invitationId)
                                ->where(['t1.agent_client_id' => $clientId, 't1.invitation_id' => $invitationId, 'company_response' => '1'])
                                ->select('t1.id', 't2.company_name', 't2.id as company_id', 't1.id as request_id', 't1.created_at', 't1.updated_at', 't1.discount', 't1.insurance_amount')
                                ->get();

        $digitalArray = DB::table('digital_service_requests as t1')
                                ->leftJoin('companies as t2', 't1.digital_service_company_id', '=', 't2.id')
                                // ->where('t1.agent_client_id', '=', $clientId)
                                // ->where('t1.invitation_id', '=', $invitationId)
                                ->where(['t1.agent_client_id' => $clientId, 't1.invitation_id' => $invitationId, 'company_response' => '1'])
                                ->select('t1.id', 't2.company_name', 't2.id as company_id', 't1.id as request_id', 't1.created_at', 't1.updated_at', 't1.discount')
                                ->get();

        // Assign it to the datatable pagination variable
        $iTotal = count($techConciergeArray) + count($homeCleaningArray) + count($movingItemArray) + count($digitalArray);
        
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k=0;

        if ( count( $digitalArray ) > 0 )
        {
            foreach ($digitalArray as $Array)
            {
				// Get the review count
            	$reviews = DB::select(DB::raw("SELECT t3.rating from companies as t1 LEFT JOIN company_user as t2 ON t1.id = t2.company_id LEFT JOIN agent_client_ratings as t3 ON t3.agent_id = t2.user_id WHERE t1.id = " . $Array->company_id));

            	$reviewCount = 0;
            	if( isset( $reviews ) && count( $reviews ) > 0 )
            	{
            		foreach ($reviews as $review)
            		{
            			$reviewCount += $review->rating;
            		}
            	}

            	// Calculate response time
            	$createdAt = $Array->created_at;
            	$updatedAt = $Array->updated_at;
            	$createdAt 	= new \DateTime($Array->created_at);
            	$updatedAt 	= new \DateTime($Array->updated_at);
            	$interval 	= date_diff($createdAt,$updatedAt);
            	$responseTime = $interval->format('%i');

            	// Get all the values and calculate the total amount
            	$digitalServiceTypeRequests = DigitalServiceTypeRequest::where(['digital_service_request_id' => $Array->id])->select('amount')->get();
            	$digitalAdditionalServiceTypeRequests = DigitalAdditionalServiceTypeRequest::where(['digital_service_request_id' => $Array->id])->select('amount')->get();

            	$totalAmount= 0;
            	$discount 	= 0;
            	$gst = 0;
            	$hst = 0;
            	$pst = 0;
            	$serviceCharge = 0;
            	if( count( $clientProvinceCharges ) > 0 )
            	{
            		if( count( $digitalServiceTypeRequests ) > 0 )
            		{
            			foreach( $digitalServiceTypeRequests as $digitalServiceTypeRequest )
            			{
            				$totalAmount += $digitalServiceTypeRequest->amount;
            			}
            		}

            		if( count( $digitalAdditionalServiceTypeRequests ) > 0 )
            		{
            			foreach( $digitalAdditionalServiceTypeRequests as $digitalAdditionalServiceTypeRequest )
            			{
            				$totalAmount += $digitalAdditionalServiceTypeRequest->amount;
            			}
            		}

            		// Substract the discount
            		$discount = $Array->discount;
            		$totalAmount = $totalAmount - $discount;

            		// Calculate GST
            		$gst = ( $totalAmount / 100 ) * $clientProvinceCharges->gst;

            		// Calculate HST
            		$hst = ( $totalAmount / 100 ) * $clientProvinceCharges->hst;

            		// Calculate PST
            		$pst = ( $totalAmount / 100 ) * $clientProvinceCharges->pst;

            		// Calculate Service Charge
            		$serviceCharge = ( $totalAmount / 100 ) * $clientProvinceCharges->service_charge;

            		$totalAmount = $totalAmount + $gst + $hst + $pst + $serviceCharge;
            	}
            	
                $response['aaData'][$k] = array(
                    0 => $k+1,
                    1 => ucfirst( strtolower($Array->company_name) ),
                    2 => '$' . number_format($totalAmount, 2),
                    3 => ( $responseTime == 0 || $responseTime == 1 ) ? $responseTime . ' Minute' : $responseTime . ' Minutes',
                    4 => $reviewCount,
                    5 => '<a href="javascript:void(0);" id="'. $Array->company_id .'@@@@'. $Array->id .'" class="view_cable_internet_service"><i class="fa fa-eye" aria-hidden="true"></i></a>',
                    6 => '<a href="javascript:void(0);" class="make_payment" data-amount="'. $totalAmount .'" data-service="cable_internet_service" id="'. $Array->id .'"><i class="fa fa-paypal" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

        if ( count( $techConciergeArray ) > 0 )
        {
        	foreach ($techConciergeArray as $Array)
            {
            	// Get the review count
            	$reviews = DB::select(DB::raw("SELECT t3.rating from companies as t1 LEFT JOIN company_user as t2 ON t1.id = t2.company_id LEFT JOIN agent_client_ratings as t3 ON t3.agent_id = t2.user_id WHERE t1.id = " . $Array->company_id));

            	$reviewCount = 0;
            	if( isset( $reviews ) && count( $reviews ) > 0 )
            	{
            		foreach ($reviews as $review)
            		{
            			$reviewCount += $review->rating;
            		}
            	}

            	// Calculate response time
            	$createdAt = $Array->created_at;
            	$updatedAt = $Array->updated_at;
            	$createdAt 	= new \DateTime($Array->created_at);
            	$updatedAt 	= new \DateTime($Array->updated_at);
            	$interval 	= date_diff($createdAt,$updatedAt);
            	$responseTime = $interval->format('%i');

            	// Get all the values and calculate the total amount
            	$techConciergeAppliancesServiceRequests = TechConciergeAppliancesServiceRequest::where(['service_request_id' => $Array->id])->select('amount')->get();
            	$techConciergePlaceServiceRequests = TechConciergePlaceServiceRequest::where(['service_request_id' => $Array->id])->select('amount')->get();

            	$totalAmount= 0;
            	$discount 	= 0;
            	$gst = 0;
            	$hst = 0;
            	$pst = 0;
            	$serviceCharge = 0;
            	if( count( $clientProvinceCharges ) > 0 )
            	{
            		if( count( $techConciergeAppliancesServiceRequests ) > 0 )
            		{
            			foreach( $techConciergeAppliancesServiceRequests as $techConciergeAppliancesServiceRequest )
            			{
            				$totalAmount += $techConciergeAppliancesServiceRequest->amount;
            			}
            		}

            		if( count( $techConciergePlaceServiceRequests ) > 0 )
            		{
            			foreach( $techConciergePlaceServiceRequests as $techConciergePlaceServiceRequest )
            			{
            				$totalAmount += $techConciergePlaceServiceRequest->amount;
            			}
            		}

            		// Substract the discount
            		$discount = $Array->discount;
            		$totalAmount = $totalAmount - $discount;

            		// Calculate GST
            		$gst = ( $totalAmount / 100 ) * $clientProvinceCharges->gst;

            		// Calculate HST
            		$hst = ( $totalAmount / 100 ) * $clientProvinceCharges->hst;

            		// Calculate PST
            		$pst = ( $totalAmount / 100 ) * $clientProvinceCharges->pst;

            		// Calculate Service Charge
            		$serviceCharge = ( $totalAmount / 100 ) * $clientProvinceCharges->service_charge;

            		$totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst + $serviceCharge ), 2, '.', '');
            	}

                $response['aaData'][$k] = array(
                    0 => $k+1,
                    1 => ucfirst( strtolower($Array->company_name) ),
                    2 => '$' . $totalAmount,
                    3 => ( $responseTime == 0 || $responseTime == 1 ) ? $responseTime . ' Minute' : $responseTime . ' Minutes',
                    4 => $reviewCount,
                    5 => '<a href="javascript:void(0);" id="'. $Array->company_id .'@@@@'. $Array->id .'" class="view_tech_concierge_service"><i class="fa fa-eye" aria-hidden="true"></i></a>',
                    6 => '<a href="javascript:void(0);" class="make_payment" data-amount="'. $totalAmount .'" data-service="tech_concierge_service" id="'. $Array->id .'"><i class="fa fa-paypal" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        }

        if ( count( $homeCleaningArray ) > 0 )
        {
            foreach ($homeCleaningArray as $Array)
            {
            	// Get the review count
            	$reviews = DB::select(DB::raw("SELECT t3.rating from companies as t1 LEFT JOIN company_user as t2 ON t1.id = t2.company_id LEFT JOIN agent_client_ratings as t3 ON t3.agent_id = t2.user_id WHERE t1.id = " . $Array->company_id));

            	$reviewCount = 0;
            	if( isset( $reviews ) && count( $reviews ) > 0 )
            	{
            		foreach ($reviews as $review)
            		{
            			$reviewCount += $review->rating;
            		}
            	}

            	// Calculate response time
            	$createdAt = $Array->created_at;
            	$updatedAt = $Array->updated_at;
            	$createdAt 	= new \DateTime($Array->created_at);
            	$updatedAt 	= new \DateTime($Array->updated_at);
            	$interval 	= date_diff($createdAt,$updatedAt);
            	$responseTime = $interval->format('%i');

            	// Get all the values and calculate the total amount
            	$homeCleaningAdditionalServiceRequests 	= HomeCleaningAdditionalServiceRequest::where(['service_request_id' => $Array->id])->select('amount')->get();
            	$homeCleaningOtherPlaceServiceRequests 	= HomeCleaningOtherPlaceServiceRequest::where(['service_request_id' => $Array->id])->select('amount')->get();
            	$homeCleaningSteamingServiceRequests 	= HomeCleaningSteamingServiceRequest::where(['service_request_id' => $Array->id])->select('amount')->get();

            	$totalAmount= 0;
            	$discount 	= 0;
            	$gst = 0;
            	$hst = 0;
            	$pst = 0;
            	$serviceCharge = 0;
            	if( count( $clientProvinceCharges ) > 0 )
            	{
            		if( count( $homeCleaningAdditionalServiceRequests ) > 0 )
            		{
            			foreach( $homeCleaningAdditionalServiceRequests as $homeCleaningAdditionalServiceRequest )
            			{
            				$totalAmount += $homeCleaningAdditionalServiceRequest->amount;
            			}
            		}

            		if( count( $homeCleaningOtherPlaceServiceRequests ) > 0 )
            		{
            			foreach( $homeCleaningOtherPlaceServiceRequests as $homeCleaningOtherPlaceServiceRequest )
            			{
            				$totalAmount += $homeCleaningOtherPlaceServiceRequest->amount;
            			}
            		}

            		if( count( $homeCleaningSteamingServiceRequests ) > 0 )
            		{
            			foreach( $homeCleaningSteamingServiceRequests as $homeCleaningSteamingServiceRequest )
            			{
            				$totalAmount += $homeCleaningSteamingServiceRequest->amount;
            			}
            		}

            		// Substract the discount
            		$discount = $Array->discount;
            		$totalAmount = $totalAmount - $discount;

            		// Calculate GST
            		$gst = ( $totalAmount / 100 ) * $clientProvinceCharges->gst;

            		// Calculate HST
            		$hst = ( $totalAmount / 100 ) * $clientProvinceCharges->hst;

            		// Calculate PST
            		$pst = ( $totalAmount / 100 ) * $clientProvinceCharges->pst;

            		// Calculate Service Charge
            		$serviceCharge = ( $totalAmount / 100 ) * $clientProvinceCharges->service_charge;

            		$totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst + $serviceCharge ), 2, '.', '');
            	}

                $response['aaData'][$k] = array(
                    0 => $k+1,
                    1 => ucfirst( strtolower($Array->company_name) ),
                    2 => '$' . $totalAmount,
                    3 => ( $responseTime == 0 || $responseTime == 1 ) ? $responseTime . ' Minute' : $responseTime . ' Minutes',
                    4 => $reviewCount,
                    5 => '<a href="javascript:void(0);" id="'. $Array->company_id .'@@@@'. $Array->id .'" class="view_home_cleaning_service"><i class="fa fa-eye" aria-hidden="true"></i></a>',
                    6 => '<a href="javascript:void(0);" class="make_payment" data-amount="'. $totalAmount .'" data-service="home_cleaning_service" id="'. $Array->id .'"><i class="fa fa-paypal" aria-hidden="true"></i></a>'
                );
                $k++;
            }
        } 

        if ( count( $movingItemArray ) > 0 )
        {
            foreach ($movingItemArray as $Array)
            {
            	// Get the review count
            	$reviews = DB::select(DB::raw("SELECT t3.rating from companies as t1 LEFT JOIN company_user as t2 ON t1.id = t2.company_id LEFT JOIN agent_client_ratings as t3 ON t3.agent_id = t2.user_id WHERE t1.id = " . $Array->company_id));

            	$reviewCount = 0;
            	if( isset( $reviews ) && count( $reviews ) > 0 )
            	{
            		foreach ($reviews as $review)
            		{
            			$reviewCount += $review->rating;
            		}
            	}

            	// Calculate response time
            	$createdAt = $Array->created_at;
            	$updatedAt = $Array->updated_at;
            	$createdAt 	= new \DateTime($Array->created_at);
            	$updatedAt 	= new \DateTime($Array->updated_at);
            	$interval 	= date_diff($createdAt,$updatedAt);
            	$responseTime = $interval->format('%i');

            	// Get all the values and calculate the total amount
            	$movingItemDetailServiceRequests 	= MovingItemDetailServiceRequest::where(['moving_items_service_id' => $Array->id])->select('amount')->get();
            	$movingOtherItemServiceRequests 	= MovingOtherItemServiceRequest::where(['moving_items_service_id' => $Array->id])->select('amount')->get();
            	$movingTransportationTypeRequests 	= MovingTransportationTypeRequest::where(['moving_items_services_id' => $Array->id])->select('amount')->get();

            	$totalAmount= 0;
            	$discount 	= 0;
            	$gst = 0;
            	$hst = 0;
            	$pst = 0;
            	$serviceCharge = 0;
            	if( count( $clientProvinceCharges ) > 0 )
            	{
            		if( count( $movingItemDetailServiceRequests ) > 0 )
            		{
            			foreach( $movingItemDetailServiceRequests as $movingItemDetailServiceRequest )
            			{
            				if( $movingItemDetailServiceRequest->amount != '' || !is_null( $movingItemDetailServiceRequest->amount ) )
            				{
            					$totalAmount += $movingItemDetailServiceRequest->amount;
            				}
            			}
            		}

            		if( count( $movingOtherItemServiceRequests ) > 0 )
            		{
            			foreach( $movingOtherItemServiceRequests as $movingOtherItemServiceRequest )
            			{
            				if( $movingOtherItemServiceRequest->amount != '' || !is_null( $movingOtherItemServiceRequest->amount ) )
            				{
            					$totalAmount += $movingOtherItemServiceRequest->amount;
            				}
            			}
            		}

            		if( count( $movingTransportationTypeRequests ) > 0 )
            		{
            			foreach( $movingTransportationTypeRequests as $movingTransportationTypeRequest )
            			{
            				if( $movingTransportationTypeRequest->amount != '' || !is_null( $movingTransportationTypeRequest->amount ) )
            				{
            					$totalAmount += $movingTransportationTypeRequest->amount;
            				}
            			}
            		}

            		// Add the amount value as well
            		$insuranceAmount = 0;
            		if( $Array->insurance_amount != '' && !is_null( $Array->insurance_amount ) )
            		{
            			$insuranceAmount = $Array->insurance_amount;
            		}
            		$totalAmount += $insuranceAmount;

            		// Substract the discount
            		$discount = $Array->discount;
            		$totalAmount = $totalAmount - $discount;

            		// Calculate GST
            		$gst = ( $totalAmount / 100 ) * $clientProvinceCharges->gst;

            		// Calculate HST
            		$hst = ( $totalAmount / 100 ) * $clientProvinceCharges->hst;

            		// Calculate PST
            		$pst = ( $totalAmount / 100 ) * $clientProvinceCharges->pst;

            		// Calculate Service Charge
            		$serviceCharge = ( $totalAmount / 100 ) * $clientProvinceCharges->service_charge;

            		$totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst + $serviceCharge ), 2, '.', '');
            	}

                $response['aaData'][$k] = array(
                    0 => $k+1,
                    1 => ucfirst( strtolower($Array->company_name) ),
                    2 => '$' . $totalAmount,
                    3 => ( $responseTime == 0 || $responseTime == 1 ) ? $responseTime . ' Minute' : $responseTime . ' Minutes',
                    4 => $reviewCount,
                    5 => '<a href="javascript:void(0);" id="'. $Array->company_id .'@@@@'. $Array->id .'" class="view_moving_item_service"><i class="fa fa-eye" aria-hidden="true"></i></a>',
                    6 => '<a href="javascript:void(0);" class="make_payment" data-amount="'. $totalAmount .'" data-service="moving_service" id="'. $Array->id .'"><i class="fa fa-paypal" aria-hidden="true"></i></a>'
                );
                $k++;
            }
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
        $companyId = Input::get('companyId');

        $response = array();
        if( $techConciergeId != '' )
        {
            $techConciergeArray = TechConciergeServiceRequest::find($techConciergeId);

            if( count( $techConciergeArray ) > 0 )
            {
                $response['moving_to_house_type']       = ucwords( strtolower( $techConciergeArray->moving_to_house_type ) );
                $response['moving_to_floor']            = $techConciergeArray->moving_to_floor;
                $response['moving_to_bedroom_count']    = $techConciergeArray->moving_to_bedroom_count;
                $response['moving_to_property_type']    = ucwords( strtolower( $techConciergeArray->moving_to_property_type ) );

                $response['availability_date1']         = date('d-m-Y', strtotime( $techConciergeArray->availability_date1 ) );
                $response['availability_date2']         = date('d-m-Y', strtotime( $techConciergeArray->availability_date2 ) );
                $response['availability_date3']         = date('d-m-Y', strtotime( $techConciergeArray->availability_date3 ) );

                $response['availability_time_from1']    = $techConciergeArray->availability_time_from1;
                $response['availability_time_upto1']    = $techConciergeArray->availability_time_upto1;
                $response['availability_time_from2']    = $techConciergeArray->availability_time_from2;
                $response['availability_time_upto2']    = $techConciergeArray->availability_time_upto2;
                $response['availability_time_from3']    = $techConciergeArray->availability_time_from3;
                $response['availability_time_upto3']    = $techConciergeArray->availability_time_upto3;

                $response['additional_information']     = $techConciergeArray->additional_information;

                // Get the moving from address
                $clientMovingFromAddress = DB::table('tech_concierge_service_requests as t1')
                                        ->join('agent_client_moving_from_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                                        ->join('provinces as t3', 't2.province_id', '=', 't3.id')
                                        ->join('cities as t4', 't2.city_id', '=', 't4.id')
                                        ->join('countries as t5', 't2.country_id', '=', 't5.id')
                                        ->where(['t1.id' => $techConciergeId, 't1.status' => '1'])
                                        ->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country')
                                        ->first();

                // Get the moving to address
                $clientMovingToAddress = DB::table('tech_concierge_service_requests as t1')
                                        ->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                                        ->join('provinces as t3', 't2.province_id', '=', 't3.id')
                                        ->join('cities as t4', 't2.city_id', '=', 't4.id')
                                        ->join('countries as t5', 't2.country_id', '=', 't5.id')
                                        ->where(['t1.id' => $techConciergeId, 't1.status' => '1'])
                                        ->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country', 't3.pst', 't3.gst', 't3.hst', 't3.service_charge')
                                        ->first();

                $response['pst']            = round($clientMovingToAddress->pst, 2) . '%';
                $response['gst']            = round($clientMovingToAddress->gst, 2) . '%';
                $response['hst']            = round($clientMovingToAddress->hst, 2) . '%';
                $response['service_charge'] = round($clientMovingToAddress->service_charge, 2) . '%';

                $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

                $response['moving_to_address']  = $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

                $html = '';

                // Get the list of appliances to install
                $appliances = DB::table('tech_concierge_appliances_service_requests as t1')
                            ->join('tech_concierge_appliances as t2', 't1.appliance_id', '=', 't2.id')
                            ->where(['t1.service_request_id' => $techConciergeId])
                            ->select('t1.id as service_request_id', 't2.id as service_id', 't2.appliances', 't1.service_hours', 't1.amount')
                            ->get();

                if( count( $appliances ) > 0 )
                {
                    foreach( $appliances as $appliance )
                    {
                        $html .= '<tr>';

                        $html .= '<td>Appliances you plan to install</td>';
                        $html .= '<td>'. ucwords( strtolower( $appliance->appliances ) ) .'</td>';
                        $html .= '<td>NA</td>';
                        $html .= '<td>'. ucwords( strtolower( $appliance->service_hours ) ) .'</td>';
                        $html .= '<td>'. ucwords( strtolower( $appliance->amount ) ) .'</td>';

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
                            ->select('t1.id as service_request_id', 't2.id as service_id', 't2.places', 't1.service_hours', 't1.amount')
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

                /*$taxDetails = DB::table('service_request_responses')->where(['request_id' => $techConciergeId, 'company_id' => $companyId])->first();

                if( count( $taxDetails ) > 0 )
                {
                	// Calculate the subtotal
                	$subtotal = number_format( ( $taxDetails->total_amount - $taxDetails->gst_amount - $taxDetails->hst_amount - $taxDetails->pst_amount ) , 2, '.', '');

	                $response['gst_amount']     		= $taxDetails->gst_amount;
	                $response['hst_amount']     		= $taxDetails->hst_amount;
	                $response['pst_amount']     		= $taxDetails->pst_amount;
	                $response['service_charge_amount'] 	= $taxDetails->service_charge;
	                $response['total_amount']   		= $taxDetails->total_amount;
	                $response['discount']       		= $taxDetails->discount;
	                $response['subtotal']       		= $subtotal;

	                $response['comment']       			= ucfirst( strtolower( $taxDetails->comment ) );
                }*/

                // Get all the values and calculate the total amount
                $appliancesServiceRequests 	= TechConciergeAppliancesServiceRequest::where(['service_request_id' => $techConciergeArray->id])->select('amount')->get();
                $otherDetailServiceRequests = TechConciergeOtherDetailServiceRequest::where(['service_request_id' => $techConciergeArray->id])->select('amount')->get();
                $placeServiceRequests 		= TechConciergePlaceServiceRequest::where(['service_request_id' => $techConciergeArray->id])->select('amount')->get();

                $totalAmount= 0;
                $discount 	= 0;
                $gst = 0;
                $hst = 0;
                $pst = 0;
                $serviceCharge = 0;
                
                if( count( $appliancesServiceRequests ) > 0 )
            	{
            		foreach( $appliancesServiceRequests as $appliancesServiceRequest )
            		{
            			$totalAmount += $appliancesServiceRequest->amount;
            		}
            	}

            	if( count( $otherDetailServiceRequests ) > 0 )
            	{
            		foreach( $otherDetailServiceRequests as $otherDetailServiceRequest )
            		{
            			$totalAmount += $otherDetailServiceRequest->amount;
            		}
            	}

            	if( count( $placeServiceRequests ) > 0 )
            	{
            		foreach( $placeServiceRequests as $placeServiceRequest )
            		{
            			$totalAmount += $placeServiceRequest->amount;
            		}
            	}

            	// Substract the discount
            	$discount = number_format($techConciergeArray->discount, 2, '.', '');
            	$totalAmount = $totalAmount - $discount;

        		//  Calculate the subtotal
        		$subtotal = number_format( ( $totalAmount ) , 2, '.', '');

            	// Calculate GST
            	$gst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->gst, 2, '.', '');

            	// Calculate HST
            	$hst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->hst, 2, '.', '');

            	// Calculate PST
            	$pst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->pst, 2, '.', '');

            	// Calculate Service Charge
            	$serviceCharge = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->service_charge, 2, '.', '');

            	$totalAmount = number_format( $totalAmount + $gst + $hst + $pst + $serviceCharge, 2, '.', '');


        	    $response['subtotal']     			= $subtotal;
        	    $response['gst_amount']     		= $gst;
        	    $response['hst_amount']     		= $hst;
        	    $response['pst_amount']     		= $pst;
        	    $response['service_charge_amount'] 	= $serviceCharge;
        	    $response['total_amount']   		= $totalAmount;
        	    $response['discount']       		= $discount;
        	    $response['comment']       			= ucfirst( strtolower( $techConciergeArray->comment ) );

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
        $companyId = Input::get('companyId');

        $response = array();
        if( $homeServiceId != '' )
        {
            $homeServiceArray = HomeCleaningServiceRequest::find($homeServiceId);

            if( count( $homeServiceArray ) > 0 )
            {
                $response['move_out_cleaning']                          = $homeServiceArray->move_out_cleaning;
                $response['move_in_cleaning']                           = $homeServiceArray->move_in_cleaning;

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
                $response['baseboard_to_be_washed']                     = $homeServiceArray->baseboard_to_be_washed;
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

                $response['pst']            = round($clientMovingToAddress->pst, 2) . '%';
                $response['gst']            = round($clientMovingToAddress->gst, 2) . '%';
                $response['hst']            = round($clientMovingToAddress->hst, 2) . '%';
                $response['service_charge'] = round($clientMovingToAddress->service_charge, 2) . '%';

                // Get the selected Steaming carpet cleaning services by mover
                $steamingServices = DB::table('home_cleaning_steaming_service_requests as t1')
                                    ->join('home_cleaning_steaming_services as t2', 't1.steaming_service_id', '=', 't2.id')
                                    ->where(['t1.service_request_id' => $homeServiceId])
                                    ->select('t1.id as service_request_id', 't2.id as service_id', 't2.steaming_service_for', 't1.amount', 't1.hour_to_complete')
                                    ->get();

                // Get the selected Other places to clean by mover
                $otherPlacesToClean = DB::table('home_cleaning_other_place_service_requests as t1')
                                    ->join('home_cleaning_other_places as t2', 't1.other_place_id', '=', 't2.id')
                                    ->where(['t1.service_request_id' => $homeServiceId])
                                    ->select('t1.id as service_request_id', 't2.id as places_id', 't2.other_places', 't1.amount', 't1.hour_to_complete')
                                    ->get();

                // Get the Additional Services selected by mover
                $additionalServices = DB::table('home_cleaning_additional_service_requests as t1')
                                    ->join('home_cleaning_additional_services as t2', 't1.additional_request_id', '=', 't2.id')
                                    ->where(['t1.service_request_id' => $homeServiceId])
                                    ->select('t1.id as service_request_id', 't2.id as additional_service_id', 't1.quantity', 't2.additional_service', 't1.amount', 't1.hour_to_complete')
                                    ->get();

                $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

                $response['moving_to_address']  = $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

                $html = '';
                if( count( $steamingServices ) > 0 )
                {
                    foreach( $steamingServices as $steamingService )
                    {
                        $html .= '<tr>';

                        $html .= '<td>Steaming carpet cleaning</td>';
                        $html .= '<td>'. ucwords( strtolower( $steamingService->steaming_service_for ) ) .'</td>';
                        $html .= '<td>NA</td>';
                        $html .= '<td>'. ucwords( strtolower( $steamingService->hour_to_complete ) ) .'</td>';
                        $html .= '<td>'. ucwords( strtolower( $steamingService->amount ) ) .'</td>';
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
                        $html .= '<td>'. ucwords( strtolower( $otherPlace->hour_to_complete ) ) .'</td>';
                        $html .= '<td>'. ucwords( strtolower( $otherPlace->amount ) ) .'</td>';
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
                        $html .= '<td>'. ucwords( strtolower( $additionalService->hour_to_complete ) ) .'</td>';
                        $html .= '<td>'. ucwords( strtolower( $additionalService->amount ) ) .'</td>';
                        $html .= '</tr>';
                    }
                }

                $response['request_services_details'] = $html;

                // Get all the values and calculate the total amount
            	$homeCleaningAdditionalServiceRequests 	= HomeCleaningAdditionalServiceRequest::where(['service_request_id' => $homeServiceArray->id])->select('amount')->get();
            	$homeCleaningOtherPlaceServiceRequests 	= HomeCleaningOtherPlaceServiceRequest::where(['service_request_id' => $homeServiceArray->id])->select('amount')->get();
            	$homeCleaningSteamingServiceRequests 	= HomeCleaningSteamingServiceRequest::where(['service_request_id' => $homeServiceArray->id])->select('amount')->get();

                $totalAmount= 0;
                $discount 	= 0;
                $gst = 0;
                $hst = 0;
                $pst = 0;
                $serviceCharge = 0;
                
                if( count( $homeCleaningAdditionalServiceRequests ) > 0 )
            	{
            		foreach( $homeCleaningAdditionalServiceRequests as $homeCleaningAdditionalServiceRequest )
            		{
            			$totalAmount += $homeCleaningAdditionalServiceRequest->amount;
            		}
            	}

            	if( count( $homeCleaningOtherPlaceServiceRequests ) > 0 )
            	{
            		foreach( $homeCleaningOtherPlaceServiceRequests as $homeCleaningOtherPlaceServiceRequest )
            		{
            			$totalAmount += $homeCleaningOtherPlaceServiceRequest->amount;
            		}
            	}

            	if( count( $homeCleaningSteamingServiceRequests ) > 0 )
            	{
            		foreach( $homeCleaningSteamingServiceRequests as $homeCleaningSteamingServiceRequest )
            		{
            			$totalAmount += $homeCleaningSteamingServiceRequest->amount;
            		}
            	}

            	// Substract the discount
            	$discount = number_format($homeServiceArray->discount, 2, '.', '');
            	$totalAmount = $totalAmount - $discount;

        		//  Calculate the subtotal
        		$subtotal = number_format( ( $totalAmount ) , 2, '.', '');

            	// Calculate GST
            	$gst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->gst, 2, '.', '');

            	// Calculate HST
            	$hst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->hst, 2, '.', '');

            	// Calculate PST
            	$pst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->pst, 2, '.', '');

            	// Calculate Service Charge
            	$serviceCharge = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->service_charge, 2, '.', '');

            	$totalAmount = number_format( $totalAmount + $gst + $hst + $pst + $serviceCharge, 2, '.', '');


        	    $response['subtotal']     			= $subtotal;
        	    $response['gst_amount']     		= $gst;
        	    $response['hst_amount']     		= $hst;
        	    $response['pst_amount']     		= $pst;
        	    $response['service_charge_amount'] 	= $serviceCharge;
        	    $response['total_amount']   		= $totalAmount;
        	    $response['discount']       		= $discount;
        	    $response['comment']       			= ucfirst( strtolower( $homeServiceArray->comment ) );
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
        $companyId = Input::get('companyId');

        $response = array();
        if( $cableInternetId != '' )
        {
            $cableInternetServiceDetails = DigitalServiceRequest::find($cableInternetId);

            $response['moving_from_house_type']     = ucwords( strtolower( $cableInternetServiceDetails['moving_from_house_type'] ) );
            $response['moving_from_floor']          = $cableInternetServiceDetails['moving_from_floor'];
            $response['moving_from_bedroom_count']  = $cableInternetServiceDetails['moving_from_bedroom_count'];
            $response['moving_from_property_type']  = ucwords( strtolower( $cableInternetServiceDetails['moving_from_property_type'] ) );

            $response['moving_to_house_type']       = ucwords( strtolower( $cableInternetServiceDetails['moving_to_house_type'] ) );
            $response['moving_to_floor']            = $cableInternetServiceDetails['moving_to_floor'];
            $response['moving_to_bedroom_count']    = $cableInternetServiceDetails['moving_to_bedroom_count'];
            $response['moving_to_property_type']    = ucwords( strtolower( $cableInternetServiceDetails['moving_to_property_type'] ) );

            $response['have_cable_internet_already']        = ( $cableInternetServiceDetails['have_cable_internet_already'] == 1 ) ? 'Yes' : 'No';
            $response['employment_status']                  = ( $cableInternetServiceDetails['employment_status'] == 1 ) ? 'Yes' : 'No';
            $response['want_to_receive_electronic_bill']    = ( $cableInternetServiceDetails['want_to_receive_electronic_bill'] == 1 ) ? 'Yes' : 'No';
            $response['want_to_contract_plan']              = ( $cableInternetServiceDetails['want_to_contract_plan'] == 1 ) ? 'Yes' : 'No';
            $response['want_to_setup_preauthorise_payment'] = ( $cableInternetServiceDetails['want_to_setup_preauthorise_payment'] == 1 ) ? 'Yes' : 'No';

            $response['additional_information']             = ucfirst( strtolower( $cableInternetServiceDetails['additional_information'] ) );

            // Get the moving from address
            $clientMovingFromAddress = DB::table('digital_service_requests as t1')
                                    ->join('agent_client_moving_from_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                                    ->join('provinces as t3', 't2.province_id', '=', 't3.id')
                                    ->join('cities as t4', 't2.city_id', '=', 't4.id')
                                    ->join('countries as t5', 't2.country_id', '=', 't5.id')
                                    ->where(['t1.id' => $cableInternetId, 't1.status' => '1'])
                                    ->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country')
                                    ->first();

            // Get the moving to address
            $clientMovingToAddress = DB::table('digital_service_requests as t1')
                                    ->join('agent_client_moving_to_addresses as t2', 't1.agent_client_id', '=', 't2.agent_client_id')
                                    ->join('provinces as t3', 't2.province_id', '=', 't3.id')
                                    ->join('cities as t4', 't2.city_id', '=', 't4.id')
                                    ->join('countries as t5', 't2.country_id', '=', 't5.id')
                                    ->where(['t1.id' => $cableInternetId, 't1.status' => '1'])
                                    ->select('t2.address1', 't3.name as province', 't4.name as city', 't5.name as country', 't3.gst', 't3.hst', 't3.pst', 't3.service_charge')
                                    ->first();

            $response['pst']            = round($clientMovingToAddress->pst, 2) . '%';
            $response['gst']            = round($clientMovingToAddress->gst, 2) . '%';
            $response['hst']            = round($clientMovingToAddress->hst, 2) . '%';
            $response['service_charge'] = round($clientMovingToAddress->service_charge, 2) . '%';

            $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

            $response['moving_to_address']  = $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

            // Get the selected services
            $services = DB::table('digital_service_type_requests as t1')
                        ->join('digital_service_types as t2', 't1.digital_service_type_id', '=', 't2.id')
                        ->where(['t1.digital_service_request_id' => $cableInternetId])
                        ->select('t1.id as service_request_id', 't2.id as service_id', 't2.service', 't1.service_hours', 't1.amount')
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
                    $html .= '<td>'. ucwords( strtolower( $service->service_hours ) ) .'</td>';
                    $html .= '<td>'. ucwords( strtolower( $service->amount ) ) .'</td>';

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

            // Get all the values and calculate the total amount
            $digitalServiceTypeRequests = DigitalServiceTypeRequest::where(['digital_service_request_id' => $cableInternetServiceDetails->id])->select('amount')->get();
            $digitalAdditionalServiceTypeRequests = DigitalAdditionalServiceTypeRequest::where(['digital_service_request_id' => $cableInternetServiceDetails->id])->select('amount')->get();

            $totalAmount= 0;
            $discount 	= 0;
            $gst = 0;
            $hst = 0;
            $pst = 0;
            $serviceCharge = 0;
            
            if( count( $digitalServiceTypeRequests ) > 0 )
        	{
        		foreach( $digitalServiceTypeRequests as $digitalServiceTypeRequest )
        		{
        			$totalAmount += $digitalServiceTypeRequest->amount;
        		}
        	}

        	if( count( $digitalAdditionalServiceTypeRequests ) > 0 )
        	{
        		foreach( $digitalAdditionalServiceTypeRequests as $digitalAdditionalServiceTypeRequest )
        		{
        			$totalAmount += $digitalAdditionalServiceTypeRequest->amount;
        		}
        	}

        	// Substract the discount
        	$discount = number_format($cableInternetServiceDetails->discount, 2, '.', '');
        	$totalAmount = $totalAmount - $discount;

    		//  Calculate the subtotal
    		$subtotal = number_format( ( $totalAmount ) , 2, '.', '');

        	// Calculate GST
        	$gst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->gst, 2, '.', '');

        	// Calculate HST
        	$hst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->hst, 2, '.', '');

        	// Calculate PST
        	$pst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->pst, 2, '.', '');

        	// Calculate Service Charge
        	$serviceCharge = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->service_charge, 2, '.', '');

        	$totalAmount = number_format( $totalAmount + $gst + $hst + $pst + $serviceCharge, 2, '.', '');


    	    $response['subtotal']     			= $subtotal;
    	    $response['gst_amount']     		= $gst;
    	    $response['hst_amount']     		= $hst;
    	    $response['pst_amount']     		= $pst;
    	    $response['service_charge_amount'] 	= $serviceCharge;
    	    $response['total_amount']   		= $totalAmount;
    	    $response['discount']       		= $discount;
    	    $response['comment']       			= ucfirst( strtolower( $cableInternetServiceDetails->comment ) );

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
        $companyId = Input::get('companyId');

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

                $response['pst']            = round($clientMovingToAddress->pst, 2) . '%';
                $response['gst']            = round($clientMovingToAddress->gst, 2) . '%';
                $response['hst']            = round($clientMovingToAddress->hst, 2) . '%';
                $response['service_charge'] = round($clientMovingToAddress->service_charge, 2) . '%';

                $response['moving_from_address']= $clientMovingFromAddress->address1 . ', ' . $clientMovingFromAddress->city . ', ' . $clientMovingFromAddress->province . ', ' . $clientMovingFromAddress->country;

                $response['moving_to_address']  = $clientMovingToAddress->address1 . ', ' . $clientMovingToAddress->city . ', ' . $clientMovingToAddress->province . ', ' . $clientMovingToAddress->country;

                $html = '';
                // Get the Other Places to install appliances in
                $itemDetails = DB::table('moving_item_detail_service_requests as t1')
                            ->join('moving_item_details as t2', 't1.moving_items_details_id', '=', 't2.id')
                            ->where(['t1.moving_items_service_id' => $movingCompanyId])
                            ->select('t1.id as service_request_id', 't2.id as service_id', 't2.item_name', 't2.item_weight', 't1.move_hours', 't1.amount')
                            ->get();

                if( count( $itemDetails ) > 0 )
                {
                    foreach( $itemDetails as $itemDetail )
                    {
                        $html .= '<tr>';

                        $html .= '<td>Detail job description</td>';
                        $html .= '<td>'. ucwords( strtolower( $itemDetail->item_name ) ) .'</td>';
                        $html .= '<td>'. $itemDetail->item_weight .'</td>';
                        $html .= '<td>'. ucwords( strtolower( $itemDetail->move_hours ) ) .'</td>';
                        $html .= '<td>'. ucwords( strtolower( $itemDetail->amount ) ) .'</td>';

                        $html .= '</tr>';
                    }
                }

                if( $movingCompaniesArray['transportation_vehicle_type'] != '' && !is_null( $movingCompaniesArray['transportation_vehicle_type'] ) )
                {
                    // Get the moving transportations
                    // $movingTransportations = MovingTransportation::get();

                    $movingTransportations = DB::table('moving_transportation_type_requests as t1')
				                            ->join('moving_transportations as t2', 't1.moving_items_services_id', '=', 't2.id')
				                            ->where(['t1.transportation_id' => $movingCompanyId])
				                            ->select('t1.id as service_request_id', 't2.id as transportation_id', 't2.transportation_type', 't1.hour_to_complete', 't1.amount')
				                            ->get();

                    if( count( $movingTransportations ) > 0 )
                    {
                        foreach( $movingTransportations as $movingTransportation )
                        {
                            $html .= '<tr>';

                            $html .= '<td>'. $movingTransportation->transportation_type .'</td>';
                            $html .= '<td>'. ucwords( strtolower( $response['transportation_vehicle_type'] ) ) .'</td>';
                            $html .= '<td>NA</td>';
                            $html .= '<td>'. $movingTransportation->hour_to_complete .'</td>';
                            $html .= '<td>'. $movingTransportation->amount .'</td>';

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
                
                // $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingFromAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
                // $mapApiResponse = json_decode(file_get_contents($url), true);

                $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingFromAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $mapApiResponse = json_decode(curl_exec($ch), true);
                if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
                {
                    $clientMovingFromAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
                }

                $clientMovingToAddressCoordinates = array();
                
                // $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
                // $mapApiResponse = json_decode(file_get_contents($url), true);

                $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $mapApiResponse = json_decode(curl_exec($ch), true);
                
                if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
                {
                    $clientMovingToAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
                }

                // Calculate the distance between the two address
                $distance = 0;
                if( count( $clientMovingFromAddressCoordinates ) > 0 && count( $clientMovingToAddressCoordinates ) > 0 )
                {
                	$distance = Helper::distance($clientMovingToAddressCoordinates['lat'], $clientMovingToAddressCoordinates['lng'], $clientMovingFromAddressCoordinates['lat'], $clientMovingFromAddressCoordinates['lng'], "K");
                }

                $response['distance'] = round($distance, 2) . 'KM';

                /*$taxDetails = DB::table('service_request_responses')->where(['request_id' => $movingCompanyId, 'company_id' => $companyId])->first();

                if( count( $taxDetails ) > 0 )
                {
                	// Calculate the subtotal
                	$subtotal = number_format( ( $taxDetails->total_amount - $taxDetails->gst_amount - $taxDetails->hst_amount - $taxDetails->pst_amount ) , 2, '.', '');

                    $response['gst_amount']     		= $taxDetails->gst_amount;
                    $response['hst_amount']     		= $taxDetails->hst_amount;
                    $response['pst_amount']     		= $taxDetails->pst_amount;
                    $response['service_charge_amount'] 	= $taxDetails->service_charge;
                    $response['insurance'] 				= $taxDetails->insurance;
                    $response['total_amount']   		= $taxDetails->total_amount;
                    $response['discount']       		= $taxDetails->discount;
                    $response['comment']       			= ucfirst( strtolower( $taxDetails->comment ) );

                    $response['subtotal']       		= $subtotal;
                }*/

                // Get all the values and calculate the total amount
                $movingItemDetailServiceRequests 	= MovingItemDetailServiceRequest::where(['moving_items_service_id' => $movingCompaniesArray->id])->select('amount')->get();
                $movingOtherItemServiceRequests 	= MovingOtherItemServiceRequest::where(['moving_items_service_id' => $movingCompaniesArray->id])->select('amount')->get();
                $movingTransportationTypeRequests 	= MovingTransportationTypeRequest::where(['moving_items_services_id' => $movingCompaniesArray->id])->select('amount')->get();

                $totalAmount= 0;
                $discount 	= 0;
                $gst = 0;
                $hst = 0;
                $pst = 0;
                $serviceCharge = 0;
                
                if( count( $movingItemDetailServiceRequests ) > 0 )
            	{
            		foreach( $movingItemDetailServiceRequests as $movingItemDetailServiceRequest )
            		{
            			$totalAmount += $movingItemDetailServiceRequest->amount;
            		}
            	}

            	if( count( $movingOtherItemServiceRequests ) > 0 )
            	{
            		foreach( $movingOtherItemServiceRequests as $movingOtherItemServiceRequest )
            		{
            			$totalAmount += $movingOtherItemServiceRequest->amount;
            		}
            	}

            	if( count( $movingTransportationTypeRequests ) > 0 )
            	{
            		foreach( $movingTransportationTypeRequests as $movingTransportationTypeRequest )
            		{
            			$totalAmount += $movingTransportationTypeRequest->amount;
            		}
            	}

            	// Add the amount value as well
        		$insuranceAmount = 0;
        		if( $movingCompaniesArray->insurance_amount != '' && !is_null( $movingCompaniesArray->insurance_amount ) )
        		{
        			$insuranceAmount = $movingCompaniesArray->insurance_amount;
        		}
        		$totalAmount += $insuranceAmount;

            	// Substract the discount
            	$discount = number_format($movingCompaniesArray->discount, 2, '.', '');
            	$totalAmount = $totalAmount - $discount;

        		//  Calculate the subtotal
        		$subtotal = number_format( ( $totalAmount ) , 2, '.', '');

            	// Calculate GST
            	$gst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->gst, 2, '.', '');

            	// Calculate HST
            	$hst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->hst, 2, '.', '');

            	// Calculate PST
            	$pst = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->pst, 2, '.', '');

            	// Calculate Service Charge
            	$serviceCharge = number_format( ( $totalAmount / 100 ) * $clientMovingToAddress->service_charge, 2, '.', '');

            	$totalAmount = number_format( $totalAmount + $gst + $hst + $pst + $serviceCharge, 2, '.', '');


        	    $response['subtotal']     			= $subtotal;
        	    $response['gst_amount']     		= $gst;
        	    $response['hst_amount']     		= $hst;
        	    $response['pst_amount']     		= $pst;
        	    $response['service_charge_amount'] 	= $serviceCharge;
        	    $response['total_amount']   		= $totalAmount;
        	    $response['discount']       		= $discount;
        	    $response['insurance'] 				= $insuranceAmount;
        	    $response['comment']       			= ucfirst( strtolower( $movingCompaniesArray->comment ) );


            }
        }
        return response()->json($response);
    }

    /**
	 * To get the list of cable & internet companies satisfying all the criteria to get the mover's quotations
	 *
	 * 		- Rules
	 * 		# Company must be active
	 * 		# Company category must match
	 * 		# Availability Mode must be true
	 * 		# Must have a payment plan
	 * 		# Services (Atleast 30% match)
	 * 		# Target Area must lies with in the working area of company or company working on multiple locations
	 *
	 * @param int
	 * @param int
	 * @param array
	 * @return array
	 */
	public function getFilteredHomeCleaningCompaniesList($clientId, $companyCategory)
	{
		// Get the moving from and moving to address of client
		$clientMovingToAddress = 	DB::table('agent_client_moving_to_addresses as t1')
									->leftJoin('provinces as t2', 't2.id', '=', 't1.province_id')
									->leftJoin('cities as t3', 't3.id', '=', 't1.city_id')
									->leftJoin('countries as t4', 't4.id', '=', 't1.country_id')
									->where(['t1.agent_client_id' => $clientId, 't1.status' => '1'])
									->select('t1.id', 't1.address1', 't1.address2', 't2.name as province', 't3.name as city', 't1.postal_code', 't4.name as country')
									->first();

		// Get the latitude, longitude of the mover from the Google Map API
		$clientMovingToAddressCoordinates = array();
		
		// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		// $mapApiResponse = json_decode(file_get_contents($url), true);

		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingToAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$mapApiResponse = json_decode(curl_exec($ch), true);
		
		if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
		{
			$clientMovingToAddressCoordinates = $mapApiResponse['results'][0]['geometry']['location'];
		}

		// Get the list of companies which are active, availability mode is on, must have a payment plan, company category also match
		$companies = DB::table('companies as t1')
					->leftJoin('company_categories as t2', 't1.company_category_id', '=', 't2.id')
					->leftJoin('payment_plan_subscriptions as t3', 't3.subscriber_id', '=', 't1.id')
					->where(['t1.status' => '1', 'availability_mode' => '1'])		// status must be active, availability_mode must be on
					->where(['t2.id' => $companyCategory])							// company category must match
					->where(['t3.plan_type_id' => '2', 't3.status' => '1'])			// for company payment plan
					->select('t1.id as company_id', 't1.company_name', 't1.address1', 't1.working_globally', 't1.target_area')
					->get();

		// Check if any company satisfy all the rules or not
		$filteredCompanies 	= array();
		$companyCoordinates = array();
		$minimumPercentage	= 30;
		if( count( $companies ) > 0 )
		{
			// Get the list of all the services provided by these companies, if atleast 30% match, then only send the quotation
			foreach ($companies as $company)
			{
				// For the companies who are not working globally, get the lat long of the address
				if( $company->working_globally != '1' )
				{
					// Get the latitude, longitude of the company address from the Google Map API
					
					// $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
					// $mapApiResponse = json_decode(file_get_contents($url), true);

					$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$mapApiResponse = json_decode(curl_exec($ch), true);

					if( count( $mapApiResponse ) > 0 && isset( $mapApiResponse['status'] ) && $mapApiResponse['status'] == 'OK' )
					{
						$companyCoordinates = $mapApiResponse['results'][0]['geometry']['location'];

						$distance = Helper::distance($companyCoordinates['lat'], $companyCoordinates['lng'], $clientMovingToAddressCoordinates['lat'], $clientMovingToAddressCoordinates['lng'], "K");

						if( $distance <= $company->target_area )
						{
							$filteredCompanies[] = $company;
						}
					}
				}
				else
				{
					$filteredCompanies[] = $company;
				}
			}
		}

		return $filteredCompanies;
	}

	/**
     * Function to get the quotation response details
     * @param void
     * @return array
     */
    public function getqQuotationResponseDetails()
    {
    	$requestId 		= Input::get('requestId');
    	$serviceType 	= Input::get('serviceType');
    	$paymentAmount 	= Input::get('paymentAmount');

    	$response 		= array();
    	$paymentAgainst = '';
    	if( $requestId != '' && $serviceType != '' )
    	{
    		if( $serviceType == 'tech_concierge_service' )
    		{
    			$paymentAgainst = 'Tech Concierge Service';

    			$details = 	DB::table('tech_concierge_service_requests as t1')
    						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
    						->leftJoin('companies as t3', 't1.company_id', '=', 't3.id')
    						->leftJoin('agent_client_moving_to_addresses as t4', 't2.id', '=', 't4.agent_client_id')
    						->leftJoin('cities as t5', 't4.city_id', '=', 't5.id')
    						->where(['t1.id' => $requestId, 't4.status' => '1'])
    						->select('t1.id as service_request_response_id', 't3.company_category_id', 't1.company_id as company_id', 't2.id as clientId', 't2.fname', 't2.lname', 't2.email', 't2.contact_number', 't4.address1', 't4.address2', 't4.postal_code', 't5.name as city')
    						->first();

    		}
    		else if( $serviceType == 'home_cleaning_service' )
    		{
    			$paymentAgainst = 'Home Cleaning Service';

    			$details = 	DB::table('home_cleaning_service_requests as t1')
    						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
    						->leftJoin('companies as t3', 't1.company_id', '=', 't3.id')
    						->leftJoin('agent_client_moving_to_addresses as t4', 't2.id', '=', 't4.agent_client_id')
    						->leftJoin('cities as t5', 't4.city_id', '=', 't5.id')
    						->where(['t1.id' => $requestId, 't4.status' => '1'])
    						->select('t1.id as service_request_response_id', 't3.company_category_id', 't1.company_id as company_id', 't2.id as clientId', 't2.fname', 't2.lname', 't2.email', 't2.contact_number', 't4.address1', 't4.address2', 't4.postal_code', 't5.name as city')
    						->first();
    		}
    		else if( $serviceType == 'moving_service' )
    		{
    			$paymentAgainst = 'Moving Service';

    			$details = 	DB::table('moving_item_service_requests as t1')
    						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
    						->leftJoin('companies as t3', 't1.mover_company_id', '=', 't3.id')
    						->leftJoin('agent_client_moving_to_addresses as t4', 't2.id', '=', 't4.agent_client_id')
    						->leftJoin('cities as t5', 't4.city_id', '=', 't5.id')
    						->where(['t1.id' => $requestId, 't4.status' => '1'])
    						->select('t1.id as service_request_response_id', 't3.company_category_id', 't1.mover_company_id as company_id', 't2.id as clientId', 't2.fname', 't2.lname', 't2.email', 't2.contact_number', 't4.address1', 't4.address2', 't4.postal_code', 't5.name as city')
    						->first();
    		}
    		else if( $serviceType == 'cable_internet_service' )
    		{
    			$paymentAgainst = 'Cable Internet Service';

    			$details = 	DB::table('digital_service_requests as t1')
    						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
    						->leftJoin('companies as t3', 't1.digital_service_company_id', '=', 't3.id')
    						->leftJoin('agent_client_moving_to_addresses as t4', 't2.id', '=', 't4.agent_client_id')
    						->leftJoin('cities as t5', 't4.city_id', '=', 't5.id')
    						->where(['t1.id' => $requestId, 't4.status' => '1'])
    						->select('t1.id as service_request_response_id', 't3.company_category_id', 't1.digital_service_company_id as company_id', 't2.id as clientId', 't2.fname', 't2.lname', 't2.email', 't2.contact_number', 't4.address1', 't4.address2', 't4.postal_code', 't5.name as city')
    						->first();
    		}

    		if( isset( $details ) && count( $details ) > 0 )
    		{
    			// Generate the Invoice No and make an entry into transaction table
    			$invoiceNo = strtoupper( str_random(20) );

    			$paymentTransactionDetail = new PaymentTransactionDetail;

    			$paymentTransactionDetail->service_request_response_id = $details->service_request_response_id;
    			$paymentTransactionDetail->company_id = $details->company_id;
    			$paymentTransactionDetail->company_category_id = $details->company_category_id;
    			$paymentTransactionDetail->invoice_no = $invoiceNo;
    			$paymentTransactionDetail->payment_against = $paymentAgainst;
    			$paymentTransactionDetail->created_at = date('Y-m-d H:i:s');

    			if( $paymentTransactionDetail->save() )
    			{
	    			$response['errCode'] 	= 0;
	    			$response['errMsg'] 	= 'Success';
	    			$response['details'] 	= array(
	    				'amount' 		=> $paymentAmount,
	    				'paymentAgainst'=> $paymentAgainst,
	    				'fname' 		=> $details->fname,
	    				'lname' 		=> $details->lname,
	    				'email' 		=> $details->email,
	    				'contactNumber' => $details->contact_number,
	    				'address1' 		=> $details->address1,
	    				'address2' 		=> $details->address2,
	    				'postal_code' 	=> $details->postal_code,
	    				'city' 			=> $details->city,
	    				'invoiceNo' 	=> $invoiceNo
	    			);
    			}
    			else
    			{
    				$response['errCode'] 	= 1;
    				$response['errMsg'] 	= 'Some Issue';
    			}
    		}
    		else
    		{
    			$response['errCode'] 	= 2;
    			$response['errMsg'] 	= 'Some Issue';
    		}
    	}

    	return response()->json($response);
    }

    /**
     * Function save the share announcement email and message
     * @param void
     * @return array
     */
    public function saveAnnouncementEmail()
    {
    	$emailIds 		= Input::get('emailIds');
    	$emailContent 	= Input::get('emailContent');

    	$response = array();
    	if( $emailIds != '' && $emailContent != '' )
    	{
	    	// Check if there is a comma present email string
	    	$emailArray = explode(',', $emailIds);

	    	// Save the detail to the respective table and CRON will send the email on the scheduled time
	    	if( count( $emailArray ) > 0 )
	    	{
	    		$shareAnnouncementEmail = array();
	    		foreach( $emailArray as $email )
	    		{
	    			$shareAnnouncementEmail[] = array(
	    				'email' => trim( $email ),
	    				'email_content' => $emailContent,
	    				'status' => '0',
	    				'created_at' => date('Y-m-d H:i:s')
	    			);
	    		}

	    		if( count( $shareAnnouncementEmail ) > 0 )
	    		{
	    			if( ShareAnnouncementEmail::insert($shareAnnouncementEmail) )
	    			{
	    				$response['errCode'] 	= 0;
    					$response['errMsg'] 	= 'Email details saved successfully';
	    			}
	    			else
	    			{
	    				$response['errCode'] 	= 1;
    					$response['errMsg'] 	= 'Some issue';
	    			}
	    		}
	    		else
	    		{
	    			$response['errCode'] 	= 2;
    				$response['errMsg'] 	= 'Some issue';
	    		}
	    	}
    	}
    	else
    	{
    		$response['errCode'] 	= 3;
    		$response['errMsg'] 	= 'Missing email id or email content';
    	}

    	return response()->json($response);
    }

    /**
	 * Return the first letter of each word in uppercase - if it's too long.
	 *
	 * @param string $str
	 * @param int $max
	 * @param string $acronym
	 * @return string
	 */
	public function strAcronym($str, $max = 12, $acronym = '')
	{
	    if (strlen($str) <= $max) return $str;

	    $words = explode(' ', $str);

	    foreach ($words as $word)
	    {
	        $acronym .= strtoupper(substr($word, 0, 1));
	    }

	    return $acronym;
	}
}
