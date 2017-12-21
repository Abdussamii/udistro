<?php
// Custom helper class that contains the common function to be used in entire application

namespace App\Helpers;

use Mail;

use App\LoginAttempt;
use App\ClientActivityList;
use App\ClientActivityLog;

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
     * To sget invite status
     * @param array
     * @return null
     */
    public static function getInviteStatus($status = 0)
    {
    	$statusText = 'Send';
		
		if( $status == '1' )
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
}