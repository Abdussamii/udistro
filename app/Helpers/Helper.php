<?php
// Custom helper class that contains the common function to be used in entire application

namespace App\Helpers;

use Mail;

use App\LoginAttempt;

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
     * To sget invite content text
     * @param array
     * @return null
     */
    public static function getTrimText($string)
    {
    	$string = strip_tags($string);
		if (strlen($string) > 80) 
		{
		    $stringCut = substr($string, 0, 80);
		    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
		}
		return $string;
    }
}