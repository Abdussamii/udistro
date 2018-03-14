<?php
// Custom helper class that contains the common function to be used in entire application

namespace App\Helpers;

use Mail;

use Illuminate\Support\Facades\DB;

use App\LoginAttempt;
use App\ClientActivityList;
use App\ClientActivityLog;
use App\PaymentPlanSubscription;
use App\PaymentPlan;
use App\User;

use App\TechConciergeAppliancesServiceRequest;
use App\TechConciergePlaceServiceRequest;
use App\DigitalServiceTypeRequest;
use App\DigitalAdditionalServiceTypeRequest;
use App\HomeCleaningAdditionalServiceRequest;
use App\HomeCleaningSteamingServiceRequest;
use App\MovingItemDetailServiceRequest;
use App\HomeCleaningOtherPlaceServiceRequest;
use App\MovingOtherItemServiceRequest;
use App\MovingTransportationTypeRequest;

class Helper
{
	/**
     * Function to get the text for the status defined in the system
     * @param integer
     * @return string
     */
    public static function getStatusText($status = 0)
    {
		$statusText = 'Inactive';
		
		if( $status == '1' )
		{
			$statusText = 'Active';
		}
		else if( $status == '2' )
		{
			$statusText = 'Deleted';
		}

		return $statusText;
    }

    /**
     * Function to trim a given string after certain number of characters with smart wrapping
     * @param string
     * @param integer
     * @param string
     * @return string
     */
    public static function truncateString($string, $length=20, $append = " ...")
	{
		$string = trim($string);

		if(strlen($string) > $length) {
		$string = wordwrap($string, $length);
		$string = explode("\n", $string, 2);
		$string = $string[0] . $append;
		}

		return $string;
	}

	/**
     * Function to check the login attempt
     * @param integer
     * @param string
     * @return array
     */
    public static function loginAttempt($userId, $datetime)
    {
    	// If the attempt count cross the given limit, hold the user from attempting the login for given time
		$loginAttemptCount 		= config('constants.LOGIN_ATTEMPT_COUNT');
		$loginAttemptDuration 	= config('constants.LOGIN_ATTEMPT_DURATION');

		$lastLogin = LoginAttempt::where(['user_id' => $userId])->first();

		$respose = array();
		if( count( $lastLogin ) > 0 )
		{
			if( $lastLogin->count == 0 )	// Login attempt value is zero, allow the user to login
			{
				$respose['errCode'] = 0;
				$respose['errMsg'] 	= 'Login attempt value is zero, allow the user to login';
			}
			else
			{
				if( $lastLogin->count >= $loginAttemptCount )	// Login attempt count reach to the allowed count, stop the user from login
				{
					// Check the login attempt time for re-login
					$currDateTime = date('Y-m-d H:i:s');
					$reloginDateTime = date('Y-m-d H:i:s', strtotime('+'.$loginAttemptDuration.' minutes', strtotime($lastLogin->last_login)));

					if( $currDateTime <= $reloginDateTime )
					{
						$respose['errCode'] = 1;
						$respose['errMsg'] 	= 'You have reached the maximum incorrect attempt. Please try again after some time';
					}
					else
					{
						// Update the login attempt count to zero
	            		$loginAttempt = LoginAttempt::where(['user_id' => $userId])->first();
	            		$loginAttempt->user_id 		= $userId;
	            		$loginAttempt->last_login	= date('Y-m-d H:i:s');
		            	$loginAttempt->count 		= 0;
		            	$loginAttempt->save();

		                $response['errCode']    = 0;
		                $response['errMsg']     = 'Successful login';

						$respose['errCode'] = 0;
						$respose['errMsg'] 	= 'The time limit exceeds, you can login again';
					}
				}
				else
				{
					$respose['errCode'] = 0;
					$respose['errMsg'] 	= 'Login attempt value is less then the allowed attempt, allow the user to login';
				}
			}
		}
		else 							// No login attempt entry, allow the user to login
		{
			$respose['errCode'] = 0;
			$respose['errMsg'] 	= 'No login attempt entry, allow the user to login';
		}

		return $respose;
    }

    /**
     * To send invitation email to client
     * @param array
     * @return null
     */
    public static function sendClientInvitation($emailData)
    {
        Mail::send('emails.sendClientInvitation', ['emailData' => $emailData], function ($m) use ($emailData) {
            $m->from('info@udistro.ca', 'Udistro');
            
            $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
        });
    }

    /**
     * To get invite status
     * @param array
     * @return null
     */
    public static function getInviteStatus($status = 0)
    {
    	$statusText = '';
		
		if( $status == '0' )
		{
			$statusText = 'Initial';
		}
		else if( $status == '1' )
		{
			$statusText = 'Send';
		}
		else if( $status == '2' )
		{
			$statusText = 'Read';
		}
		else if( $status == '2' )
		{
			$statusText = 'Expire';
		}

		return $statusText;
    }

    /**
     * To sget invite action
     * @param array
     * @return null
     */
    public static function getInviteAction($action = '')
    {
		
		if( !is_null($action) && $action == 1)
		{
			$text = '<i class="fa fa-check"></i>';
		}
		else if( !is_null($action) && $action == 0)
		{
			$text = '<i class="fa fa-times-circle"></i>';
		} 
		else 
		{
			$text = 'Not Try';
		}

		return $text;
    }

    /**
     * To sget invite status
     * @param array
     * @return null
     */
    public static function getInviteScheduleStatus($status = 0)
    {
    	$statusText = 'Send Immediately';
		
		if( $status == '1' )
		{
			$statusText = 'Schedule it for later';
		}

		return $statusText;
    }

    /**
     * To get invite content text
     * @param array
     * @return null
     */
    public static function getTrimText($string)
    {
    	$string = strip_tags($string);
		if (strlen($string) > 100) 
		{
		    $stringCut = substr($string, 0, 100);
		    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
		}
		return $string;
    }

    /**
     * To calculate the completed activities percentage on My Move page
     * @param array
     * @return null
     */
    public static function calculateCompletedActivitiesPercentage($clientId, $invitationId)
    {
    	// Get the total activities count
    	$totalActivitiesCount = ClientActivityList::where(['status' => '1'])->count();

    	// Get the activities completed count
    	$totalCompletedActivitiesCount 	= ClientActivityLog::where(['invitation_id' => $invitationId, 'client_id' => $clientId, 'action' => '1'])->count();

    	// Calculate the percentage of completed activities
    	$completedActivitiesPercentage 	= ( $totalCompletedActivitiesCount / $totalActivitiesCount ) * 100;

    	return $completedActivitiesPercentage;
    }

    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    /*::                                                                         :*/
    /*::  This routine calculates the distance between two points (given the     :*/
    /*::  latitude/longitude of those points). It is being used to calculate     :*/
    /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
    /*::                                                                         :*/
    /*::  Definitions:                                                           :*/
    /*::    South latitudes are negative, east longitudes are positive           :*/
    /*::                                                                         :*/
    /*::  Passed to function:                                                    :*/
    /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
    /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
    /*::    unit = the unit you desire for results                               :*/
    /*::           where: 'M' is statute miles (default)                         :*/
    /*::                  'K' is kilometers                                      :*/
    /*::                  'N' is nautical miles                                  :*/
    /*::  Worldwide cities and other features databases with latitude longitude  :*/
    /*::  are available at https://www.geodatasource.com                          :*/
    /*::                                                                         :*/
    /*::  For enquiries, please contact sales@geodatasource.com                  :*/
    /*::                                                                         :*/
    /*::  Official Web site: https://www.geodatasource.com                        :*/
    /*::                                                                         :*/
    /*::         GeoDataSource.com (C) All Rights Reserved 2017		   		     :*/
    /*::                                                                         :*/
    /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    public static function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
      	$theta = $lon1 - $lon2;
      	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      	$dist = acos($dist);
      	$dist = rad2deg($dist);
      	$miles = $dist * 60 * 1.1515;
      	$unit = strtoupper($unit);

      	if ($unit == "K")
      	{
        	return ($miles * 1.609344);
      	}
      	else if ($unit == "N") {
          	return ($miles * 0.8684);
        }
        else
        {
            return $miles;
        }
    }

    /**
     * To check the current active payment plan and the remaining quota count
     * @param int
     * @param int
     * @return bool
     */
    public static function checkPaymentPlanSubscriptionQuota($subscriberId, $planTypeId)
    {
    	if( !is_null( $subscriberId ) && ( $subscriberId != '' ) && !is_null( $planTypeId ) && ( $planTypeId != '' ) )
    	{
    		// Get the current date
    		$date = date('Y-m-d');

    		// For agent payment plan there is a count limit
    		if( $planTypeId == 1 )
    		{
    			// Check if the payment plan type is trial plan then there is no remaining qouta limit. Otherwise the remaining quota limit is there
    			$paymentPlanSubscriptionQouta = PaymentPlanSubscription::where('subscriber_id', '=', $subscriberId)	// subscriber is either company / agent
    											->where('plan_type_id', '=', $planTypeId)							// plan type is either for company / agent
    											->where('start_date', '<=', $date)									// plan start date must lie between the today's date
    											->where('end_date', '>=', $date) 									// plan end date must lie between the today's date
    											->where('status', '=', '1')
    											->first();

   				// Check for the payment plan type
    			if( count( $paymentPlanSubscriptionQouta ) > 0 )
    			{
    				$paymentPlanDetails = PaymentPlan::find($paymentPlanSubscriptionQouta->plan_id);

    				if( count( $paymentPlanDetails ) > 0 )
    				{
    					// Check if the plan is a trial plan then there is no limit of email
    					if( $paymentPlanDetails->trial_plan == '1' )
    					{
    						return true;
    					}
    					else
    					{
    						// If the plan is not a trial plan then there is limit of email
    						if( $paymentPlanSubscriptionQouta->remaining_qouta > 0 )
    						{
    							return true;
    						}
    						else
    						{
    							return false;
    						}
    					}
    				}
    				else
    				{
    					return false;
    				}
    			}
    			else
    			{
    				return false;
    			}
    		}
    		else 	// There is no count limit for company
    		{
    			// Check if their is an active payment plan exist on the present date
    			$paymentPlanSubscriptionQouta = PaymentPlanSubscription::where('subscriber_id', '=', $subscriberId)	// subscriber is either company / agent
    											->where('plan_type_id', '=', $planTypeId)							// plan type is either for company / agent
    											->where('start_date', '<=', $date)									// plan start date must lie between the today's date
    											->where('end_date', '>=', $date) 									// plan end date must lie between the today's date
    											->where('status', '=', '1')
    											->first();

    			if( count( $paymentPlanSubscriptionQouta ) > 0 )
    			{
    				return true;
    			}
    			else
    			{
    				return false;
    			}
    		}
    	}
    	else
    	{
    		return false;
    	}
    }

    /**
     * To check the email count available in selected payment plan, and decerement it by one on every email sent
     * @param int
     * @param int
     * @return bool
     */
    public static function manageEmailQuota($subscriberId, $planTypeId)
    {
    	$response = array();
    	if( !is_null( $subscriberId ) && ( $subscriberId != '' ) && !is_null( $planTypeId ) && ( $planTypeId != '' ) )
    	{
	    	// First check whether they have remaining email quota
			if( Helper::checkPaymentPlanSubscriptionQuota($subscriberId, $planTypeId) )
			{
				// Decrement the remaining_qouta by 1
				$paymentPlanSubscription = PaymentPlanSubscription::where(['subscriber_id' => $subscriberId, 'plan_type_id' => $planTypeId, 'status' => '1'])->first();

				$paymentPlanSubscription->remaining_qouta = $paymentPlanSubscription->remaining_qouta - 1;

				if( $paymentPlanSubscription->save() )
				{
					$response = true;
				}
				else
				{
					$response = false;
				}
			}
    	}
    	else
    	{
    		$response = false;	
    	}

    	return $response;
    }

    /**
     * To get the Udistro system agent id. 
     * This is the agent who is handling the movers who don't have the agent invite and they get the invite by filling "Get Invitation" form
     * @param array
     * @return null
     */
    public static function getSystemAgent()
    {
    	// Udistro agent - invitation@udistro.ca

    	$agent = User::where(['email' => 'invitation@udistro.ca', 'status' => '1'])->first();

    	if( count( $agent ) > 0 )
    	{
    		return $agent->id;
    	}
    	else
    	{
    		return 0;
    	}
    }


    /**
     * Function to calculate the receivable amount to the company for the job done by them
     * @param void
     * @return array
     */
    public static function calculateReceivableAmount($serviceRequestResponseId, $companyCategoryId)
    {
    	$totalAmount = number_format( ( 0 ), 2, '.', '');

    	if( $companyCategoryId == '2' )			// Home Cleaning Service Company
    	{
    		$otherDetails = DB::table('home_cleaning_service_requests as t1')
    						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
    						->leftJoin('companies as t3', 't1.company_id', '=', 't3.id')
    						->leftJoin('company_categories as t4', 't3.company_category_id', '=', 't4.id')
    						->leftJoin('agent_client_moving_to_addresses as t5', 't5.agent_client_id', '=', 't2.id')
    						->leftJoin('provinces as t6', 't5.province_id', '=', 't6.id')
    						->where(['t1.id' => $serviceRequestResponseId])
    						->select('t1.id', 't2.fname', 't2.oname', 't2.contact_number', 't3.company_name', 't4.category as order_detail', 't6.pst', 't6.gst', 't6.hst', 't6.service_charge', 't1.discount')
    						->first();

    		// Get all the values and calculate the total amount
    		$homeCleaningAdditionalServiceRequests 	= HomeCleaningAdditionalServiceRequest::where(['service_request_id' => $otherDetails->id])->select('amount')->get();
    		$homeCleaningOtherPlaceServiceRequests 	= HomeCleaningOtherPlaceServiceRequest::where(['service_request_id' => $otherDetails->id])->select('amount')->get();
    		$homeCleaningSteamingServiceRequests 	= HomeCleaningSteamingServiceRequest::where(['service_request_id' => $otherDetails->id])->select('amount')->get();

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
    		$discount = $otherDetails->discount;
    		$totalAmount = $totalAmount - $discount;

    		// Calculate GST
    		$gst = ( $totalAmount / 100 ) * $otherDetails->gst;

    		// Calculate HST
    		$hst = ( $totalAmount / 100 ) * $otherDetails->hst;

    		// Calculate PST
    		$pst = ( $totalAmount / 100 ) * $otherDetails->pst;

    		// Calculate Service Charge
    		// $serviceCharge = ( $totalAmount / 100 ) * $otherDetails->service_charge;

    		// $totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst + $serviceCharge ), 2, '.', '');
    		$totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst ), 2, '.', '');
    	}
    	else if( $companyCategoryId == '3' )	// Moving Company
    	{
    		$otherDetails = DB::table('moving_item_service_requests as t1')
    						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
    						->leftJoin('companies as t3', 't1.mover_company_id', '=', 't3.id')
    						->leftJoin('company_categories as t4', 't3.company_category_id', '=', 't4.id')
    						->leftJoin('agent_client_moving_to_addresses as t5', 't5.agent_client_id', '=', 't2.id')
    						->leftJoin('provinces as t6', 't5.province_id', '=', 't6.id')
    						->where(['t1.id' => $serviceRequestResponseId])
    						->select('t1.id', 't2.fname', 't2.oname', 't2.contact_number', 't3.company_name', 't4.category as order_detail', 't6.pst', 't6.gst', 't6.hst', 't6.service_charge', 't1.discount', 't1.insurance_amount')
    						->first();

    		// Get all the values and calculate the total amount
    		$movingItemDetailServiceRequests 	= MovingItemDetailServiceRequest::where(['moving_items_service_id' => $otherDetails->id])->select('amount')->get();
    		$movingOtherItemServiceRequests 	= MovingOtherItemServiceRequest::where(['moving_items_service_id' => $otherDetails->id])->select('amount')->get();
    		$movingTransportationTypeRequests 	= MovingTransportationTypeRequest::where(['moving_items_services_id' => $otherDetails->id])->select('amount')->get();

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
    		if( $otherDetails->insurance_amount != '' && !is_null( $otherDetails->insurance_amount ) )
    		{
    			$insuranceAmount = $otherDetails->insurance_amount;
    		}
    		$totalAmount += $insuranceAmount;

    		// Substract the discount
    		$discount = $otherDetails->discount;
    		$totalAmount = $totalAmount - $discount;

    		// Calculate GST
    		$gst = ( $totalAmount / 100 ) * $otherDetails->gst;

    		// Calculate HST
    		$hst = ( $totalAmount / 100 ) * $otherDetails->hst;

    		// Calculate PST
    		$pst = ( $totalAmount / 100 ) * $otherDetails->pst;

    		// Calculate Service Charge
    		// $serviceCharge = ( $totalAmount / 100 ) * $otherDetails->service_charge;

    		// $totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst + $serviceCharge ), 2, '.', '');
    		$totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst ), 2, '.', '');
    	}
    	else if( $companyCategoryId == '4' )	// Internet & Cable Service provider
    	{
    		// Get the gst, hst, pst, service charge for the agent moving to address
    		$otherDetails = DB::table('digital_service_requests as t1')
            						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
            						->leftJoin('companies as t3', 't1.digital_service_company_id', '=', 't3.id')
            						->leftJoin('company_categories as t4', 't3.company_category_id', '=', 't4.id')
            						->leftJoin('agent_client_moving_to_addresses as t5', 't5.agent_client_id', '=', 't2.id')
            						->leftJoin('provinces as t6', 't5.province_id', '=', 't6.id')
            						->where(['t1.id' => $serviceRequestResponseId])
            						->select('t1.id', 't2.fname', 't2.oname', 't2.contact_number', 't3.company_name', 't4.category as order_detail', 't6.pst', 't6.gst', 't6.hst', 't6.service_charge', 't1.discount')
            						->first();

    		$digitalServiceTypeRequests = DigitalServiceTypeRequest::where(['digital_service_request_id' => $serviceRequestResponseId])->select('amount')->get();
    		$digitalAdditionalServiceTypeRequests = DigitalAdditionalServiceTypeRequest::where(['digital_service_request_id' => $serviceRequestResponseId])->select('amount')->get();

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
    		$discount = $otherDetails->discount;
    		$totalAmount = $totalAmount - $discount;

    		// Calculate GST
    		$gst = ( $totalAmount / 100 ) * $otherDetails->gst;

    		// Calculate HST
    		$hst = ( $totalAmount / 100 ) * $otherDetails->hst;

    		// Calculate PST
    		$pst = ( $totalAmount / 100 ) * $otherDetails->pst;

    		// Calculate Service Charge
    		// $serviceCharge = ( $totalAmount / 100 ) * $otherDetails->service_charge;

    		// $totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst + $serviceCharge ), 2, '.', '');
    		$totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst ), 2, '.', '');
    	}
    	else if( $companyCategoryId == '5' )	// Tech Concierge
    	{
    		$otherDetails = DB::table('tech_concierge_service_requests as t1')
    						->leftJoin('agent_clients as t2', 't1.agent_client_id', '=', 't2.id')
    						->leftJoin('companies as t3', 't1.company_id', '=', 't3.id')
    						->leftJoin('company_categories as t4', 't3.company_category_id', '=', 't4.id')
    						->leftJoin('agent_client_moving_to_addresses as t5', 't5.agent_client_id', '=', 't2.id')
    						->leftJoin('provinces as t6', 't5.province_id', '=', 't6.id')
    						->where(['t1.id' => $serviceRequestResponseId])
    						->select('t1.id', 't2.fname', 't2.oname', 't2.contact_number', 't3.company_name', 't4.category as order_detail', 't6.pst', 't6.gst', 't6.hst', 't6.service_charge', 't1.discount')
    						->first();

    		// Get all the values and calculate the total amount
    		$techConciergeAppliancesServiceRequests = TechConciergeAppliancesServiceRequest::where(['service_request_id' => $otherDetails->id])->select('amount')->get();
    		$techConciergePlaceServiceRequests = TechConciergePlaceServiceRequest::where(['service_request_id' => $otherDetails->id])->select('amount')->get();

    		$totalAmount= 0;
    		$discount 	= 0;
    		$gst = 0;
    		$hst = 0;
    		$pst = 0;
    		$serviceCharge = 0;
    		
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
    		$discount = $otherDetails->discount;
    		$totalAmount = $totalAmount - $discount;

    		// Calculate GST
    		$gst = ( $totalAmount / 100 ) * $otherDetails->gst;

    		// Calculate HST
    		$hst = ( $totalAmount / 100 ) * $otherDetails->hst;

    		// Calculate PST
    		$pst = ( $totalAmount / 100 ) * $otherDetails->pst;

    		// Calculate Service Charge
    		// $serviceCharge = ( $totalAmount / 100 ) * $otherDetails->service_charge;

    		// $totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst + $serviceCharge ), 2, '.', '');
    		$totalAmount = number_format( ( $totalAmount + $gst + $hst + $pst ), 2, '.', '');
    	}

    	return $totalAmount;
    }
}