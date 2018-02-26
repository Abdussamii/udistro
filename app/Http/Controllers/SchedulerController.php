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
    		$digitalServiceRequests = DigitalServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1'])	// company_response = 1 means compeny response availeble 
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'digital_service_company_id As companyId', 'updated_at As updatedAt', 'created_at As createdAt')
										->first();

    		if( count( $digitalServiceRequests ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// get agent client detail
    			$agentClient = AgentClient::findOrFail($digitalServiceRequests->agent_client_id);

    			$clientId 		= $agentClient->id;
    			$clientEmail	= $agentClient->email;
    			$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
    			$invitationId 	= $digitalServiceRequests->invitation_id;

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

    			// Update the email_sent_status to 1
    			DigitalServiceRequest::where(['id' => $digitalServiceRequests->serviceRequestId])->update(['email_sent_status' => '1']);
    		}
			
			// Check for the `home_cleaning_service_requests` email not sent scheduled for today's date
    		$homeCleaningServiceRequests = HomeCleaningServiceRequest::where(['email_sent_status' => '0', 'company_response' => '1']) 
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();

    		if( count( $homeCleaningServiceRequests ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// get agent client detail
    			$agentClient = AgentClient::findOrFail($homeCleaningServiceRequests->agent_client_id);

    			$clientId 		= $agentClient->id;
    			$clientEmail	= $agentClient->email;
    			$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
    			$invitationId 	= $homeCleaningServiceRequests->invitation_id;

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

    			// Update the email_sent_status to 1
    			HomeCleaningServiceRequest::where(['id' => $homeCleaningServiceRequests->serviceRequestId])->update(['email_sent_status' => '1']);
    		}
			
			// Check for the `moving_item_service_requests` email not sent scheduled for today's date
    		$movingItemServiceRequest = MovingItemServiceRequest::where(['email_sent_status' => '0', 'company_response' => '0'])			//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'mover_company_id As companyId', 'updated_at As responseDate')
										->first();

    		if( count( $movingItemServiceRequest ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// get agent client detail
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

    			// Update the email_sent_status to 1
    			MovingItemServiceRequest::where(['id' => $movingItemServiceRequest->serviceRequestId])->update(['email_sent_status' => '1']);
    		}
			
			// Check for the `tech_concierge_service_requests` email not sent scheduled for today's date
    		$techConciergeServiceRequests = TechConciergeServiceRequest::where(['email_sent_status' => '0', 'company_response' => '0'])	//status = 0 means email has not been sent
										->select('id As serviceRequestId', 'agent_client_id', 'invitation_id', 'company_id As companyId', 'updated_at As responseDate')
										->first();

    		if( count( $techConciergeServiceRequests ) > 0 )	// There is service request response that needs to send email to the mover
    		{
    			// get agent client detail
    			$agentClient = AgentClient::findOrFail($techConciergeServiceRequests->agent_client_id);

    			$clientId 		= $agentClient->id;
    			$clientEmail	= $agentClient->email;
    			$clientName 	= ucwords( $agentClient->lname . ' ' . $agentClient->fname . ' ' .$agentClient->oname );
    			$invitationId 	= $techConciergeServiceRequests->invitation_id;

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

    			// Update the email_sent_status to 1
    			TechConciergeServiceRequest::where(['id' => $techConciergeServiceRequests->serviceRequestId])->update(['email_sent_status' => '1']);
    		}
		}
		
    }
}
