<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

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
    	$workingHourStartTime 	= '07:00:00';
    	// $workingHourEndTime 	= '17:00:00';
    	$workingHourEndTime 	= '24:00:00';

    	// Check the current time of the server
    	$currentDate = date('Y-m-d');
    	$currentTime = date('H:i:s');

    	// If the current time is between the working hours then get the scheduled email listing
    	if( $currentTime >= $workingHourStartTime && $currentTime <= $workingHourEndTime )
    	{
    		// Check for the email scheduled for today's date
    		$agentClientInvite = AgentClientInvite::where(['status' => '0', 'schedule_status' => '1', 'schedule_date' => $currentDate])
    							->select('id', 'client_id', 'schedule_status', 'email_template_id')
    							->first();

    		if( count( $agentClientInvite ) == 1 )	// There is an email scheduled for today's date, send it first
    		{
    			// Get the client details
    			$clientDetails = AgentClient::find($agentClientInvite->client_id);

    			if( count( $clientDetails ) > 0 )
    			{
	    			// Get the email content and send the email
	    			$emailTemplate = EmailTemplate::find($agentClientInvite->email_template_id);

	    			if( count( $emailTemplate ) > 0 )
	    			{
		    			$emailData = array(
		    				'name' 		=> $clientDetails->fname . ' ' . $clientDetails->lname,
		    				'subject' 	=> 'Invitation',
		    				'email' 	=> $clientDetails->email,
		    				'content'	=> $emailTemplate->template_content_to_send,
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
    		else  									// There is no email scheduled for today's date. Send the email with schedule_status as "Send Immediately"
    		{
    			$agentClientInvite = AgentClientInvite::where(['status' => '0', 'schedule_status' => '0'])
    							->select('id', 'client_id', 'schedule_status', 'email_template_id')
    							->first();

    			if( count( $agentClientInvite ) == 1 )
    			{
    				// Get the client details
	    			$clientDetails = AgentClient::find($agentClientInvite->client_id);

	    			if( count( $clientDetails ) > 0 )
	    			{
		    			// Get the email content and send the email
		    			$emailTemplate = EmailTemplate::find($agentClientInvite->email_template_id);

		    			if( count( $emailTemplate ) > 0 )
		    			{
			    			$emailData = array(
			    				'name' 		=> $clientDetails->fname . ' ' . $clientDetails->lname,
			    				'subject' 	=> 'Invitation',
			    				'email' 	=> $clientDetails->email,
			    				'content'	=> $emailTemplate->template_content_to_send,
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
    }
	
	public function sendCompanyQuotationResponseEmail()
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
    		$digitalServiceRequests = DigitalServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])	//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'digital_service_company_id As companyId', 'updated_at As responseDate')
										->first();

    		if( count( $digitalServiceRequests ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// Get the response time slot
    			$responseTimeSlots = ResponseTimeSlot::where(['status' => '1'])
									->select('id', 'slot_title', 'slot_time')
									->get();

    			if( count( $responseTimeSlots ) > 0 )
    			{
					
					//loop through the responseTimeSlots
					foreach( $responseTimeSlots as $responseTimeSlot )
					{
						$nextTime = date('H:i:s', strtotime( $digitalServiceRequests->responseDate ));
						$updatedTime = date( "H:i:s",strtotime( '+30 '. $responseTimeSlot->slot_time .' minutes', strtotime( $nextTime ) ) );
						
						if($currentTime >= $nextTime && $currentTime <= $updatedTime)
						{
							//get agent client detail
							$agentClient = AgentClient::findOrFail($digitalServiceRequests->agent_client_id);
							$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
							
							//get company category id from company
							$companyCategoryId = Company::where(['id' => $digitalServiceRequests->companyId])->select('company_category_id')->first();
							
							Mail::to($agentClient->email)->send(new CompanyQuotationResponse($agentClientName, $digitalServiceRequests->serviceRequestId, $digitalServiceRequests->companyId, $companyCategoryId, $digitalServiceRequests->agent_client_id, $digitalServiceRequests->invitation_id));
						}
					}
    			}
    		}
			
			// Check for the `home_cleaning_service_requests` email not sent scheduled for today's date
    		$homeCleaningServiceRequests = HomeCleaningServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])			//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();

    		if( count( $homeCleaningServiceRequests ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// Get the response time slot
    			$responseTimeSlots = ResponseTimeSlot::where(['status' => '1'])
									->select('id', 'slot_title', 'slot_time')
									->get();

				if( count( $responseTimeSlots ) > 0 )
    			{
					
					//loop through the responseTimeSlots
					foreach( $responseTimeSlots as $responseTimeSlot )
					{
						$nextTime = date('H:i:s', strtotime( $homeCleaningServiceRequests->responseDate ));
						$updatedTime = date( "H:i:s",strtotime( '+30 '. $responseTimeSlot->slot_time .' minutes', strtotime( $nextTime ) ) );
						
						if($currentTime >= $nextTime && $currentTime <= $updatedTime)
						{
							//get agent client detail
							$agentClient = AgentClient::findOrFail($homeCleaningServiceRequests->agent_client_id);
							$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
							
							Mail::to($agentClient->email)->send(new CompanyQuotationResponse($agentClientName, $homeCleaningServiceRequests->serviceRequestId, $homeCleaningServiceRequests->companyId));
						}
					}
	    			
    			}
    		}
			
			// Check for the `moving_item_service_requests` email not sent scheduled for today's date
    		$movingItemServiceRequest = MovingItemServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])			//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'mover_company_id As companyId', 'updated_at As responseDate')
										->first();

    		if( count( $movingItemServiceRequest ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// Get the response time slot
    			$responseTimeSlots = ResponseTimeSlot::where(['status' => '1'])
									->select('id', 'slot_title', 'slot_time')
									->get();

    			if( count( $responseTimeSlots ) > 0 )
    			{
					
					//loop through the responseTimeSlots
					foreach( $responseTimeSlots as $responseTimeSlot )
					{
						$nextTime = date('H:i:s', strtotime( $movingItemServiceRequest->responseDate ));
						$updatedTime = date( "H:i:s",strtotime( '+30 '. $responseTimeSlot->slot_time .' minutes', strtotime( $nextTime ) ) );
						
						if($currentTime >= $nextTime && $currentTime <= $updatedTime)
						{
							//get agent client detail
							$agentClient = AgentClient::findOrFail($movingItemServiceRequest->agent_client_id);
							$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
							
							//get company category id from company
							$companyCategoryId = Company::where(['id' => $movingItemServiceRequest->companyId])->select('company_category_id')->first();
							
							// Mail::to($agentClient->email)->send(new CompanyQuotationResponse($agentClientName, $movingItemServiceRequest->serviceRequestId, $movingItemServiceRequest->companyId, $companyCategoryId, $movingItemServiceRequest->agent_client_id, $movingItemServiceRequest->invitation_id));
						}
					}
	    			
    			}
    		}
			
			// Check for the `tech_concierge_service_requests` email not sent scheduled for today's date
    		$techConciergeServiceRequests = TechConciergeServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])	//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();

    		if( count( $techConciergeServiceRequests ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// Get the response time slot
    			$responseTimeSlots = ResponseTimeSlot::where(['status' => '1'])
													->select('id', 'slot_title', 'slot_time');

    			if( count( $responseTimeSlots ) > 0 )
    			{
					
					//loop through the responseTimeSlots
					foreach( $responseTimeSlots as $responseTimeSlot )
					{
						//loop through the serviceRequestResponses
						foreach( $techConciergeServiceRequests as $techConciergeServiceRequest )
						{
							//
							$nextTime = date('H:i:s', strtotime($techConciergeServiceRequest->responseDate));
							$updatedTime = date('H:i:s', strtotime('+'. $responseTimeSlot->slot_time .' minutes', $nextTime));
							
							//echo $nextTime . '  ' . $updateTime;
							//exit();
							
							if($currentTime >= $nextTime && $currentTime <= $updatedTime)
							{
								//get agent client detail
								$agentClient = AgentClient::findOrFail($techConciergeServiceRequest->agent_client_id);
								$agentClientName = $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname;
								
								 Mail::to($agentClient->email)->send(new CompanyQuotationResponse($agentClientName, $techConciergeServiceRequest->serviceRequestId, $techConciergeServiceRequest->companyId));
							}
						}
					}
	    			
    			}
    		}
		}
		
    }
}
