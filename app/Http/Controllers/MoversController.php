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

use Helper;
use Session;

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
     * Function to return my move view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function myMove()
    {
    	$agentId 		= base64_decode(Input::get('agent_id'));
    	$clientId 		= base64_decode(Input::get('client_id'));
    	$invitationId 	= base64_decode(Input::get('invitation_id'));

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

    	// echo '<pre>';
    	// print_r( $MovingTransportationList->toArray() );
    	// exit;

    	return view('movers/myMove', ['agentDetails' => $agentDetails, 'clientDetails' => $clientDetails, 'companyDetails' => $companyDetails, 'clientInitials' => $clientInitials, 'clientName' => $clientName, 'agentName' => $agentName, 'agentInitials' => $agentInitials, 'activities' => $activities, 'agentRating' => $agentRating, 'agentHelpfulCount' => $agentHelpfulCount, 'clientMovingFromProvince' => $clientMovingFromProvince, 'clientMovingToProvince' => $clientMovingToProvince, 'clientMovingFromAddress' => $clientMovingFromAddress, 'clientMovingToAddress' => $clientMovingToAddress, 'companyProvince' => $companyProvince, 'companyCity' => $companyCity, 'serviceProviders' => $serviceProviders, 'completedActivitiesPercentage' => $completedActivitiesPercentage, 'invitationId' => $invitationId, 'completedActivities' => $completedActivities, 'agentClientHelpfulCount' => $agentClientHelpfulCount, 'agentClientRating' => $agentClientRating, 'movingItemCategories' => $movingItemCategories, 'movingItemDetails' => $movingItemDetails, 'movingOtherItemList' => $movingOtherItemList, 'MovingTransportationList' => $MovingTransportationList]);
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

    	$itemsQuantities = array();
    	$specialInstructions = array();
    	$response = array();
    	if( count( $movingRequest ) == 0 )
    	{
    		// Check how many services request are raised
    		if( isset( $details['moving_house_additional_service_1'] ) && $details['moving_house_additional_service_1'] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_1');
    		}
    		if( isset( $details['moving_house_additional_service_2'] ) && $details['moving_house_additional_service_2'] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_2');
    		}
    		if( isset( $details['moving_house_additional_service_3'] ) && $details['moving_house_additional_service_3'] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_3');
    		}
    		if( isset( $details['moving_house_additional_service_4'] ) && $details['moving_house_additional_service_4'] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_4');
    		}
    		if( isset( $details['moving_house_additional_service_5'] ) && $details['moving_house_additional_service_5'] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_additional_service_5');
    		}
    		if( isset( $details['moving_house_vehicle_type'] ) && $details['moving_house_vehicle_type'] == 1 )
    		{
    			array_push($requiredServices, 'moving_house_vehicle_type');
    		}

    		$filteredCompanies = $this->getFilteredMoverCompaniesList($clientId, $companyCategory, $requiredServices);

    		$successCount = 0;
    		if( count( $filteredCompanies ) > 0 )
    		{
    			foreach ($filteredCompanies as $filterCompany)
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

			    	$movingServiceRequest->callback_option = $details['moving_house_callback_option'];
			    	$movingServiceRequest->callback_time = $details['moving_house_callback_time'];

			    	$movingServiceRequest->transportation_vehicle_type = $details['moving_house_vehicle_type'];

			    	$movingServiceRequest->primary_no 	= $details['moving_house_callback_primary_no'];
			    	$movingServiceRequest->secondary_no = $details['moving_house_callback_secondary_no'];
			    	
			    	$movingServiceRequest->moving_date = date('Y-m-d H:i:s', strtotime( $details['moving_house_date'] ) );
			    	$movingServiceRequest->additional_information = $details['moving_house_additional_information'];
			    	$movingServiceRequest->status = '1';
			    	$movingServiceRequest->created_by = $clientId;

			    	if( $movingServiceRequest->save() )
			    	{
			    		$successCount++;

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

	    		$response['errCode'] 	= 0;
	    		$response['errMsg'] 	= 'Request added successfully';
	    	}
	    	else
	    	{
	    		$response['errCode'] 	= 1;
	    		$response['errMsg'] 	= 'No matching company found!';
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
		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $clientMovingFromAddress->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';
		$mapApiResponse = json_decode(file_get_contents($url), true);
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
					->where(['t3.plan_type_id' => '2'])								// for company payment plan
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
						$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='. urlencode( $company->address1 ) .'&key=AIzaSyCSaTspumQXz5ow3MBIbwq0e3qsCoT2LDE';

						$mapApiResponse = json_decode(file_get_contents($url), true);

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
