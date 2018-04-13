<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Response;

use DOMDocument;
use Twilio;
use Session;

use App\AgentClient;

class TwilioController extends BaseController
{
    public function twilioDemo()
    {
    	/*$config = array(
		    'TWILIO_ACCOUNT_SID' => getenv('AC564d77fe493bdeee948c89c8f1d3447f'),
		    'TWILIO_AUTH_TOKEN' => getenv('56d577fb5de5878d9965d38897cf751e'),
		    'TWILIO_NUMBER' => getenv('7206500037')
		);*/

    	// return view('twilioTest');
    }

    public function call(Request $request)
    {
    	var_dump( env('TWILIO_ACCOUNT_SID') );
    	exit;

    	// Get form input
    	// $userPhone = '+12048076739';
    	$userPhone = Input::get('userPhone');
    	
    	// $encodedSalesPhone = urlencode(str_replace(' ','',Input::get('salesPhone')));

    	// Get the client and invitation id from session and fetch its phone number
    	$clientId = Session::get('clientId');
    	$clientDetails = AgentClient::find($clientId);

    	if( count( $clientDetails ) > 0 )
    	{
    		$encodedSalesPhone = urlencode( '+1' . $clientDetails->contact_number );
	    	
	    	// Set URL for outbound call - this should be your public server URL
	    	$host = parse_url($request->url(), PHP_URL_HOST);

	    	// Create authenticated REST client using account credentials in
	    	// <project root dir>/.env.php
	    	$client = new Twilio\Rest\Client('ACcf0657ed14627852f1578d3e8daaf8ee', 'b17d536dfc70a9c7bf33c46325771732');

	    	try {
	    	    $client->calls->create(
	    	        $userPhone, // The visitor's phone number
	    	        '+18192010995', // A Twilio number in your account
	    	        array(
	    	            "url" => "http://$host/outbound/$encodedSalesPhone"
	    	        )
	    	    );
	    	} catch (Exception $e) {
	    	    // Failed calls will throw
	    	    return $e;
	    	}

	    	// return a JSON response
	    	return array('message' => 'Call incoming!');
    	}
    }

    public function outbound($salesPhone)
    {
    	// A message for Twilio's TTS engine to repeat
	    $sayMessage = 'This is a utility connection call initiated from Udistro.';

	    $twiml = new Twilio\Twiml();
	    $twiml->say($sayMessage, array('voice' => 'alice'));
	    $twiml->dial($salesPhone);

	    $response = Response::make($twiml, 200);
	    $response->header('Content-Type', 'text/xml');
	    return $response;
    }

    public function twilioResponse(Request $request)
    {
    	$req = new Twilio\Twiml();
    	header('Content-type: text/xml');
    	echo $req;
    	exit;
    }
}