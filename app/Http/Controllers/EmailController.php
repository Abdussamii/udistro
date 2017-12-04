<?php

namespace App\Http\Controllers;

use App\AgentClientInvite;
use App\EmailTemplate;
use App\User;
use App\AgentClient;

use Helper;

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
}
