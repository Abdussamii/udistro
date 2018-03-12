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
use Validator;

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

    /**
     * Function to upload the file and send the email with attachement
     * @param void
     * @return array
     */
    public function sendAgentEmailNotification()
    {
    	$agentId     	= Input::get('agentId');
    	$emailContent 	= Input::get('emailContent');
    	$attachement	= Input::file('fileData');

        $response =array();

		$validation = Validator::make(
		    array(
		        'agentId'		=> $agentId,
		        'emailContent'	=> $emailContent
		    ),
		    array(
		        'agentId' 		=> array('required'),
		        'emailContent' 	=> array('required')
		    ),
		    array(
		        'agentId.required'		=> 'Missing required information',
		        'emailContent.required' => 'Please select status'
		    )
		);

		if ( $validation->fails() )
		{
			$error = $validation->errors()->first();

		    if( isset( $error ) && !empty( $error ) )
		    {
		        $response['errCode']    = 1;
		        $response['errMsg']     = $error;
		    }
		}
		else
		{
			// Get the agent details
        	$agentDetails = User::find($agentId);

        	if( count( $agentDetails ) > 0 )
        	{
        		// Check if attachement is available. If available upload it and send it with email as an attachement
        		if(!is_null($attachement) && ($attachement->getSize() > 0))
        		{
        			// Image destination folder
        			$destinationPath = storage_path() . '/uploads/email_attachement';

        			if( $attachement->isValid() )  // If the file is valid or not
        			{
        			    $fileExt  = $attachement->getClientOriginalExtension();
        			    $fileType = $attachement->getMimeType();
        			    $fileSize = $attachement->getSize();

        			    if( $fileSize <= 1000000 ) 	// 1 MB = 1000000 Bytes
        			    {
        				    if( $fileType == 'application/pdf' )
        				    {
        				        // Rename the file
        				        $fileNewName = str_random(40) . '.' . $fileExt;

        				        if( $attachement->move( $destinationPath, $fileNewName ) )
        				        {
        				        	$pathToFile = $destinationPath . '/' . $fileNewName;

        				        	// Send the email with attachement
    				        		$emailData = array(
    				        			// 'email' 	=> $agentDetails->email,
    				        			'email' 	=> 'mayankpandey@virtualemployee.com',
    				        			'name' 		=> ucwords( strtolower( $agentDetails->lname . ' ' . $agentDetails->fname ) ),
    				        			'subject' 	=> 'Udistro Notification',
    				        			'content'	=> $emailContent
    				        		);

    				        		Mail::send('emails.agentNotificationEmail', ['emailData' => $emailData], function ($m) use ($emailData, $pathToFile) {
    				        	        $m->from('info@udistro.ca', 'Udistro');
    				        	        
    				        	        $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);

    				        	        $m->attach($pathToFile);
    				        	    });

        				        	$response['errCode']    = 0;
        				        	$response['errMsg']     = 'Email sent successfully';
        				        }
        			        	else
        			        	{
        			        		$response['errCode']    = 3;
        			                $response['errMsg']     = 'Some error in image upload';
        			        	}
        				    }
        			    	else
        			    	{
        			    		$response['errCode']    = 4;
        			            $response['errMsg']     = 'Invalid file type. Please select a pdf file';
        			    	}
        			    }
        			    else
        			    {
        			    	$response['errCode']    = 5;
        		        	$response['errMsg']     = 'File size exceed. Please upload a file less then 3 MB';
        			    }
        			}
        			else
        			{
        				$response['errCode']    = 6;
        		        $response['errMsg']     = 'Invalid file';
        			}
        		}
        		else 	// No attachement available
        		{
        			// Send the email
	        		$emailData = array(
	        			// 'email' 	=> $agentDetails->email,
	        			'email' 	=> 'mayankpandey@virtualemployee.com',
	        			'name' 		=> ucwords( strtolower( $agentDetails->lname . ' ' . $agentDetails->fname ) ),
	        			'subject' 	=> 'Udistro Notification',
	        			'content'	=> $emailContent
	        		);

	        		Mail::send('emails.agentNotificationEmail', ['emailData' => $emailData], function ($m) use ($emailData) {
	        	        $m->from('info@udistro.ca', 'Udistro');
	        	        
	        	        $m->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
	        	    });

		        	$response['errCode']    = 0;
		        	$response['errMsg']     = 'Email sent successfully';
        		}	
        	}
        	else
        	{
        		$response['errCode']    = 7;
        		$response['errMsg']     = 'Agent details missing';
        	}
		}

		return response()->json($response);
    }
}
