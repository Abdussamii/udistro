<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\AgentClientInvite;
use App\EmailTemplate;
use App\User;
use App\AgentClient;

use Helper;
use Mail;

class EmailController extends Controller
{
    /**
     * Function to save the agent invitation details
     * @param void
     * @return array
     */
    public function renderEmailTemplate()
    {
    	$inviteId = 1;

    	// Get the email template id & message detail
    	$inviteDetails = AgentClientInvite::find($inviteId);

    	// Get the email template content
    	$emailTemplateDetails = EmailTemplate::find($inviteDetails->email_template_id);

    	// Get the agent related details
    	$agentDetails = User::find($inviteDetails->agent_id);

    	// Get the client relalted details
    	$clientDetails = AgentClient::find($inviteDetails->client_id);

    	// Get the company related details
    	$companyDetails = $agentDetails->company->first();

    	// Get the email content
    	$templateContent = $emailTemplateDetails->template_content;

    	// Replace the message content
    	$finalTemplateContent = str_replace('[content]', $inviteDetails->message_content, $templateContent);

    	// Client name
    	$clientName = ucwords( strtolower( trim($clientDetails->fname . ' ' . $clientDetails->oname . ' ' . $clientDetails->lname) ) );

    	// Company name
    	$companyName 	= ucwords( strtolower( trim($companyDetails->company_name ) ) );

        // Company Address
        $companyAddress    = ucwords( strtolower( trim($companyDetails->address ) ) );

    	// Invitation url
    	$invitationURL 	= $inviteDetails->email_url;

    	$emailData = array(
    		/* Email data */
    		'email' 		=> 'mayankpandey@virtualemployee.com',
    		'name' 			=> 'Mayank Pandey',
    		'subject' 		=> 'Invitation',
    		/* Template data */
    		'finalTemplateContent' 	=> $finalTemplateContent, 
    		'agentDetails' 			=> $agentDetails, 
    		'companyName' 			=> $companyName,
            'companyAddress'        => $companyAddress, 
    		'clientName' 			=> $clientName, 
    		'invitationURL' 		=> $invitationURL
    		
    	);

    	Helper::sendClientInvitation($emailData);

    	// return view('emails/sendClientInvitation', $emailData);
    }


    /**
     * Function to test email template
     * @param void
     * @return array
     */
    public function sendEmail()
    {
    	$recipientEmail = Input::get('recipientEmail');
    	$content = Input::get('content');

    	// Get the logged-in user id
		$userId = Auth::id();

		// Check check whether they have remaining email quota, if yes decrement the count by 1
		if( Helper::manageEmailQuota($userId, 1) )
		{
	    	$emailData = array(
	    		/* Email data */
	    		'email' 	=> $recipientEmail,
	    		'name' 		=> 'Test User',
	    		'subject' 	=> 'Test Email',
	    		/* Template data */
	    		'content'	=> $content
	    		
	    	);

	    	Mail::send('emails.testEmail', ['emailData' => $emailData], function ($m) use ($emailData) {
	            $m->from('info@udistro.ca', 'Udistro');
	            
	            $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
	        });

	        $response['errCode']    = 0;
			$response['errMsg']     = 'Email Sent';
		}
		else
		{
			$response['errCode']    = 1;
			$response['errMsg']     = 'Your payment plan subscription is expired';
		}

		return response()->json($response);
    }
}
