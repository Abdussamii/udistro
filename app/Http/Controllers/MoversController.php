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
    	$movingItemDetails = MovingItemDetail::where('status', '1')->select('id', 'moving_item_category_id', 'item_name')->orderBy('id', 'asc')->get();

    	// echo '<pre>';
    	// print_r( $movingItemDetails->toArray() );
    	// exit;

    	return view('movers/myMove', ['agentDetails' => $agentDetails, 'clientDetails' => $clientDetails, 'companyDetails' => $companyDetails, 'clientInitials' => $clientInitials, 'clientName' => $clientName, 'agentName' => $agentName, 'agentInitials' => $agentInitials, 'activities' => $activities, 'agentRating' => $agentRating, 'agentHelpfulCount' => $agentHelpfulCount, 'clientMovingFromProvince' => $clientMovingFromProvince, 'clientMovingToProvince' => $clientMovingToProvince, 'clientMovingFromAddress' => $clientMovingFromAddress, 'clientMovingToAddress' => $clientMovingToAddress, 'companyProvince' => $companyProvince, 'companyCity' => $companyCity, 'serviceProviders' => $serviceProviders, 'completedActivitiesPercentage' => $completedActivitiesPercentage, 'invitationId' => $invitationId, 'completedActivities' => $completedActivities, 'agentClientHelpfulCount' => $agentClientHelpfulCount, 'agentClientRating' => $agentClientRating, 'movingItemCategories' => $movingItemCategories, 'movingItemDetails' => $movingItemDetails]);
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

    	$details = array();
    	parse_str($frmData, $details);

    	print_r( $details );

    	exit;
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
