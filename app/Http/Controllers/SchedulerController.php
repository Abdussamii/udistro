<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use Log;
use Helper;
use Mail;

use App\EmailTemplate;
use App\AgentClient;
use App\AgentClientInvite;
use App\HomeCleaningServiceRequest;
use App\DigitalServiceRequest;
use App\TechConciergeServiceRequest;
use App\MovingItemServiceRequest;
use App\ResponseTimeSlot;
use App\Company;
use App\CompanyRequestEmail;
use App\ShareAnnouncementEmail;

// Email related classes
use App\Mail\CompanyQuotationResponse;

class SchedulerController extends Controller
{
	public function sendInvitationEmail()
	{
		// For testing purpose
		Log::useDailyFiles(storage_path().'/logs/cron.log');
		// Log::info('Hello');

    	// Working hours in Canada: 07:00 to 17:00
    	// $workingHourStartTime 	= '07:00:00';
    	// $workingHourEndTime 	= '17:00:00';
    	$workingHourStartTime 	= '00:00:00';
    	$workingHourEndTime 	= '24:00:00';

    	// Check the current time of the server
    	$currentDate = date('Y-m-d');
    	$currentTime = date('H:i:s');

    	// If the current time is between the working hours then get the scheduled email listing
    	if( $currentTime >= $workingHourStartTime && $currentTime <= $workingHourEndTime )
    	{
    		// Check for the email scheduled for today's date
    		$agentClientInvite = AgentClientInvite::where(['status' => '0', 'schedule_status' => '1', 'schedule_date' => $currentDate])
    							->select('id', 'client_id', 'schedule_status', 'email_template_id', 'message_content')
    							->first();

    		if( count( $agentClientInvite ) == 1 )	// There is an email scheduled for today's date, send it first
    		{
    			// Get the client details
    			$clientDetails = AgentClient::find($agentClientInvite->client_id);

    			if( count( $clientDetails ) > 0 )
    			{
	    			$emailData = array(
	    				'name' 		=> $clientDetails->fname . ' ' . $clientDetails->lname,
	    				'subject' 	=> 'Invitation',
	    				'email' 	=> $clientDetails->email,
	    				'content'	=> $agentClientInvite->message_content,
	    			);

	    			Helper::sendClientInvitation($emailData);

	    			if( AgentClientInvite::find($agentClientInvite->id)->update(['status' => '1']) )
	    			{
	    				// echo 'Scheduled email with id '. $agentClientInvite->id .' send successfully' . PHP_EOL;
		    			Log::info('Scheduled email with id '. $agentClientInvite->id .' send successfully');
	    			}
    			}
    		}
    		else  									// There is no email scheduled for today's date. Send the email with schedule_status as "Send Immediately"
    		{
    			$agentClientInvite = AgentClientInvite::where(['status' => '0', 'schedule_status' => '0'])
    							->select('id', 'client_id', 'schedule_status', 'email_template_id', 'message_content')
    							->first();

	    		if( count( $agentClientInvite ) == 1 )	// There is an email scheduled for today's date, send it first
	    		{
	    			// Get the client details
	    			$clientDetails = AgentClient::find($agentClientInvite->client_id);

	    			if( count( $clientDetails ) > 0 )
	    			{
		    			$emailData = array(
		    				'name' 		=> $clientDetails->fname . ' ' . $clientDetails->lname,
		    				'subject' 	=> 'Invitation',
		    				'email' 	=> $clientDetails->email,
		    				'content'	=> $agentClientInvite->message_content,
		    			);

		    			Helper::sendClientInvitation($emailData);

		    			if( AgentClientInvite::find($agentClientInvite->id)->update(['status' => '1']) )
		    			{
		    				// echo 'Scheduled email with id '. $agentClientInvite->id .' send successfully' . PHP_EOL;
			    			Log::info('Scheduled email with id '. $agentClientInvite->id .' send successfully');
		    			}
	    			}
	    		}
    		}
    	}
    }

    public function sendCompanyQuotationResponseEmail()
	{
		/*// Working hours in Canada: 07:00 to 17:00
		$workingHourStartTime 	= '00:00:00';
		$workingHourEndTime 	= '24:00:00';

		// Get the current time of the server
		$currentDate = date('Y-m-d');
		$currentTime = date('H:i:s');

		// If the current time is between the working hours then get the scheduled email listing
		if( $currentTime >= $workingHourStartTime && $currentTime <= $workingHourEndTime )
		{
    		$homeCleaningServiceRequest = HomeCleaningServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1']) 
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();
			
			// Check for the `moving_item_service_requests` email not sent scheduled for today's date
    		$movingItemServiceRequest = MovingItemServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'mover_company_id As companyId', 'updated_at As responseDate')
										->first();
			
			// Check for the `tech_concierge_service_requests` email not sent scheduled for today's date
    		$techConciergeServiceRequest = TechConciergeServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();

			if( count( $homeCleaningServiceRequest ) > 0 )
			{
				// Send a common email
				$agentClient = AgentClient::findOrFail($homeCleaningServiceRequest->agent_client_id);

				$clientId 		= $agentClient->id;
				$clientEmail	= $agentClient->email;
				$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
				$invitationId 	= $homeCleaningServiceRequest->invitation_id;

				$emailData = array(
					'name' 		=> $clientName,
					'subject' 	=> 'Quotation Response',
					'email' 	=> $clientEmail,
					'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
				);

				if( app()->env != 'local' )
				{
					Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
					    $m->from('info@udistro.ca', 'Udistro');
					    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
					});

					// Update the email_sent_status to '1'
					HomeCleaningServiceRequest::where(['id' => $homeCleaningServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
				}
			}

			if( count( $movingItemServiceRequest ) > 0 )
			{
				// Send a common email
				$agentClient = AgentClient::findOrFail($movingItemServiceRequest->agent_client_id);

				$clientId 		= $agentClient->id;
				$clientEmail	= $agentClient->email;
				$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
				$invitationId 	= $movingItemServiceRequest->invitation_id;

				$emailData = array(
					'name' 		=> $clientName,
					'subject' 	=> 'Quotation Response',
					'email' 	=> $clientEmail,
					'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
				);

				if( app()->env != 'local' )
				{
					Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
					    $m->from('info@udistro.ca', 'Udistro');
					    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
					});

					// Update the email_sent_status to '1'
					MovingItemServiceRequest::where(['id' => $movingItemServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
				}
			}

			if( count( $techConciergeServiceRequest ) > 0 )
			{
				// Send a common email
				$agentClient = AgentClient::findOrFail($techConciergeServiceRequest->agent_client_id);

				$clientId 		= $agentClient->id;
				$clientEmail	= $agentClient->email;
				$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
				$invitationId 	= $techConciergeServiceRequest->invitation_id;

				$emailData = array(
					'name' 		=> $clientName,
					'subject' 	=> 'Quotation Response',
					'email' 	=> $clientEmail,
					'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
				);

				if( app()->env != 'local' )
				{
					Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
					    $m->from('info@udistro.ca', 'Udistro');
					    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
					});

					// Update the email_sent_status to '1'
					TechConciergeServiceRequest::where(['id' => $techConciergeServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
				}
			}
		}*/
	}
	
	/*public function sendCompanyQuotationResponseEmail()
	{
		// For testing purpose
		Log::useDailyFiles(storage_path().'/logs/cron.log');
		// Log::info('Hello');

    	// Working hours in Canada: 07:00 to 17:00
    	$workingHourStartTime 	= '07:00:00';
    	// $workingHourEndTime 	= '17:00:00';
    	$workingHourEndTime 	= '24:00:00';	// for testing

    	// Check the current time of the server
    	$currentDate = date('Y-m-d');
    	$currentTime = date('H:i:s');

    	// If the current time is between the working hours then get the scheduled email listing
    	if( $currentTime >= $workingHourStartTime && $currentTime <= $workingHourEndTime )
    	{
    		// Check for the `digital_service_requests` email not sent scheduled for today's date
    		$digitalServiceRequest = DigitalServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])	// company_response = 1 means company response available 
									->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'digital_service_company_id As companyId', 'updated_at As responseDate')
									->first();
			
			// Check for the `home_cleaning_service_requests` email not sent scheduled for today's date
    		$homeCleaningServiceRequest = HomeCleaningServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1']) 
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();
			
			// Check for the `moving_item_service_requests` email not sent scheduled for today's date
    		$movingItemServiceRequest = MovingItemServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])			//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'mover_company_id As companyId', 'updated_at As responseDate')
										->first();
			
			// Check for the `tech_concierge_service_requests` email not sent scheduled for today's date
    		$techConciergeServiceRequest = TechConciergeServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])	//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();

			// If any of the above resposne is having any entry after the time slot expire, send the email and update the email_sent_status to 1 of respective table
			$timeSlot = ResponseTimeSlot::where(['status' => '1'])->select('id', 'slot_time')->first();

			// Current time
    		$currentTime= date('H:i:s');

    		$digitalServiceResponseStatus = false;
    		// Check if any response exist in the system for Cable & Internet
    		if( count( $digitalServiceRequest ) > 0 )
    		{
    			// Check for the slot expiration time
    			$digitalServiceRequestTime = $digitalServiceRequest->createdAt;

				$digitalServiceSlotExpireTime = date( 'H:i:s', strtotime( '+ '. $timeSlot->slot_time .' minutes', strtotime( $digitalServiceRequestTime ) ) );

				// Compare the current time with the slot expire time
				if( $currentTime >= $digitalServiceSlotExpireTime )
				{
					// Update the status variable
					$digitalServiceResponseStatus = true;
				}
    		}

    		$homeCleaningServiceResponseStatus = false;
    		// Check if any response exist in the system for Cable & Internet
    		if( count( $homeCleaningServiceRequest ) > 0 )
    		{
    			// Check for the slot expiration time
    			$homeCleaningServiceRequestTime = $homeCleaningServiceRequest->createdAt;

				$homeCleaningServiceSlotExpireTime = date( 'H:i:s', strtotime( '+ '. $timeSlot->slot_time .' minutes', strtotime( $homeCleaningServiceRequestTime ) ) );

				// Compare the current time with the slot expire time
				if( $currentTime >= $homeCleaningServiceSlotExpireTime )
				{
					// Update the status variable
					$homeCleaningServiceResponseStatus = true;
				}
    		}

    		$movingItemServiceResponseStatus = false;
    		// Check if any response exist in the system for Cable & Internet
    		if( count( $movingItemServiceRequest ) > 0 )
    		{
    			// Check for the slot expiration time
    			$movingItemServiceRequestTime = $movingItemServiceRequest->createdAt;

				$movingItemServiceSlotExpireTime = date( 'H:i:s', strtotime( '+ '. $timeSlot->slot_time .' minutes', strtotime( $movingItemServiceRequestTime ) ) );

				// Compare the current time with the slot expire time
				if( $currentTime >= $movingItemServiceSlotExpireTime )
				{
					// Update the status variable
					$movingItemServiceResponseStatus = true;
				}
    		}

    		$techConciergeServiceResponseStatus = false;
    		// Check if any response exist in the system for Cable & Internet
    		if( count( $techConciergeServiceRequest ) > 0 )
    		{
    			// Check for the slot expiration time
    			$techConciergeServiceRequestTime = $techConciergeServiceRequest->createdAt;

				$techConciergeServiceSlotExpireTime = date( 'H:i:s', strtotime( '+ '. $timeSlot->slot_time .' minutes', strtotime( $techConciergeServiceRequestTime ) ) );

				// Compare the current time with the slot expire time
				if( $currentTime >= $techConciergeServiceSlotExpireTime )
				{
					// Update the status variable
					$techConciergeServiceResponseStatus = true;
				}
    		}

    		// If any of the above response exist, send the email
    		if( $digitalServiceResponseStatus == true || $homeCleaningServiceResponseStatus == true || $movingItemServiceResponseStatus == true || $techConciergeServiceResponseStatus == true )
    		{
    			// Check if all the response are for same the same request, then send a single email. Otherwise individual email for every response
    			if( $digitalServiceRequest['invitation_id'] == $homeCleaningServiceRequest['invitation_id'] && $homeCleaningServiceRequest['invitation_id'] == $movingItemServiceRequest['invitation_id'] && $techConciergeServiceRequest['invitation_id'] == $digitalServiceRequest['invitation_id'] )
    			{
    				// Send a common email
    				$agentClient = AgentClient::findOrFail($digitalServiceRequest->agent_client_id);

    				$clientId 		= $agentClient->id;
    				$clientEmail	= $agentClient->email;
    				$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
    				$invitationId 	= $digitalServiceRequest->invitation_id;

    				$emailData = array(
    					'name' 		=> $clientName,
    					'subject' 	=> 'Quotation Response',
    					'email' 	=> $clientEmail,
    					'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
    				);

    				Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
    				    $m->from('info@udistro.ca', 'Udistro');
    				    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
    				});

    				// Update the email_sent_status to 1 for all the requests
    				DigitalServiceRequest::where(['id' => $digitalServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    				HomeCleaningServiceRequest::where(['id' => $homeCleaningServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    				MovingItemServiceRequest::where(['id' => $movingItemServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    				TechConciergeServiceRequest::where(['id' => $techConciergeServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    			}
    			else 	// Send individual email & update the status
    			{
    				if( $digitalServiceResponseStatus == true )
    				{
						$agentClient = AgentClient::findOrFail($digitalServiceRequest->agent_client_id);

						$clientId 		= $agentClient->id;
						$clientEmail	= $agentClient->email;
						$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
						$invitationId 	= $digitalServiceRequest->invitation_id;

						$emailData = array(
							'name' 		=> $clientName,
							'subject' 	=> 'Quotation Response',
							'email' 	=> $clientEmail,
							'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
						);

						Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
						    $m->from('info@udistro.ca', 'Udistro');
						    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
						});

						DigitalServiceRequest::where(['id' => $digitalServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    				}

    				if( $homeCleaningServiceResponseStatus == true )
    				{
    					$agentClient = AgentClient::findOrFail($homeCleaningServiceRequest->agent_client_id);

    					$clientId 		= $agentClient->id;
    					$clientEmail	= $agentClient->email;
    					$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
    					$invitationId 	= $homeCleaningServiceRequest->invitation_id;

    					$emailData = array(
    						'name' 		=> $clientName,
    						'subject' 	=> 'Quotation Response',
    						'email' 	=> $clientEmail,
    						'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
    					);

    					Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
    					    $m->from('info@udistro.ca', 'Udistro');
    					    
    					    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
    					});

    					HomeCleaningServiceRequest::where(['id' => $homeCleaningServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    				}

    				if( $movingItemServiceResponseStatus == true )
    				{
    					$agentClient = AgentClient::findOrFail($movingItemServiceRequest->agent_client_id);

    					$clientId 		= $agentClient->id;
    					$clientEmail	= $agentClient->email;
    					$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
    					$invitationId 	= $movingItemServiceRequest->invitation_id;

    					$emailData = array(
    						'name' 		=> $clientName,
    						'subject' 	=> 'Quotation Response',
    						'email' 	=> $clientEmail,
    						'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
    					);

    					Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
    					    $m->from('info@udistro.ca', 'Udistro');
    					    
    					    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
    					});

    					MovingItemServiceRequest::where(['id' => $movingItemServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    				}

    				if( $techConciergeServiceResponseStatus == true )
    				{
    					$agentClient = AgentClient::findOrFail($techConciergeServiceRequest->agent_client_id);

    					$clientId 		= $agentClient->id;
    					$clientEmail	= $agentClient->email;
    					$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
    					$invitationId 	= $techConciergeServiceRequest->invitation_id;

    					$emailData = array(
    						'name' 		=> $clientName,
    						'subject' 	=> 'Quotation Response',
    						'email' 	=> $clientEmail,
    						'url'		=> 'https://www.udistro.ca/movers/quotationresponse?client_id='. base64_encode( $clientId ) .'&invitation_id=' . base64_encode( $invitationId ),
    					);

    					Mail::send('emails.moverQuotationResponseNotification', ['emailData' => $emailData], function ($m) use ($emailData) {
    					    $m->from('info@udistro.ca', 'Udistro');
    					    
    					    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
    					});

    					TechConciergeServiceRequest::where(['id' => $techConciergeServiceRequest['serviceRequestId']])->update(['email_sent_status' => '1']);
    				}
    			}
    		}
		}
    }*/

    public function sendCompanyNotificationEmail()
	{
		Log::useDailyFiles(storage_path().'/logs/cron.log');

		// Check if there is any entry available to send email
		$notificationEmail = CompanyRequestEmail::where(['email_send_status' => '0'])->first();

		// Get the email id of the agent associated with company
		$agentDetails = DB::table('companies as t1')
						->leftJoin('company_user as t2', 't1.id', '=', 't2.company_id')
						->leftJoin('users as t3', 't2.user_id', '=', 't3.id')
						->select('t3.email', 't3.fname', 't3.lname')
						->first();

		if( count( $agentDetails ) > 0 && count( $notificationEmail ) > 0 )
		{
			$agentName = ucwords( strtolower( $agentDetails->lname . ' ' . $agentDetails->fname ) );
			$agentEmail= $agentDetails->email;

			// Send the email
			$emailData = array(
				'name' 		=> $agentName,
				'subject' 	=> 'Quotation Request',
				'email' 	=> $agentEmail,
				'url'		=> 'https://www.udistro.ca/company'
			);

			Mail::send('emails.companyNotificationEmail', ['emailData' => $emailData], function ($m) use ($emailData) {
			    $m->from('info@udistro.ca', 'Udistro');
			    
			    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
			});

			Log::info('Scheduled email with id '. $notificationEmail->id .' send successfully');

			// Update the email_send_status to 1, so that it can take next record
			CompanyRequestEmail::where(['id' => $notificationEmail->id])->update(['email_send_status' => '1']);
		}
		else
		{
			// Update the email_send_status to 1, so that it can take next record
			CompanyRequestEmail::where(['id' => $notificationEmail->id])->update(['email_send_status' => '1']);
		}
	}

	/**
     * Function to send the share announcement email
     * @param void
     */
	public function sendAnnouncementEmail()
	{
		// Get the first entry from the table
		$emailDetails = ShareAnnouncementEmail::where(['status' => '0'])->first();

		if( count( $emailDetails ) > 0 )
		{
			// Send the email
			$emailData = array(
				'name' 		=> 'Udistro',
				'subject' 	=> 'Udistro Announcement',
				'email' 	=> $emailDetails->email,
				'content'	=> $emailDetails->email_content
			);

			Mail::send('emails.shareAnnouncementEmail', ['emailData' => $emailData], function ($m) use ($emailData) {
			    $m->from('info@udistro.ca', 'Udistro');
			    
			    $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
			});

			// Update the status
			ShareAnnouncementEmail::where(['id' => $emailDetails->id])->update(['status' => '1']);
		}
	}
}
