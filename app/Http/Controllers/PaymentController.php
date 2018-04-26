<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\PaymentTransactionDetail;

use Helper;
use Validator;
use Log;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the payment success page.
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return view('payment/successful-payment');
    }

    /**
     * Show the payment cancel page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        return view('payment/payment-cancel');
    }

    /**
     * To check the paypal payment status by using IPN.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentStatus()
    {
    	Log::useDailyFiles(storage_path().'/logs/Paypal_IPN.log');

    	// STEP 1: read POST data
    	// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
    	// Instead, read raw POST data from the input stream.
    	$raw_post_data = file_get_contents('php://input');
    	$raw_post_array = explode('&', $raw_post_data);
    	$myPost = array();
    	foreach ($raw_post_array as $keyval) {
    	  $keyval = explode ('=', $keyval);
    	  if (count($keyval) == 2)
    	    $myPost[$keyval[0]] = urldecode($keyval[1]);
    	}
    	// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
    	$req = 'cmd=_notify-validate';
    	if (function_exists('get_magic_quotes_gpc')) {
    	  $get_magic_quotes_exists = true;
    	}

    	foreach ($myPost as $key => $value)
    	{
			if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1)
			{
				$value = urlencode(stripslashes($value));
			}
			else
			{
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
    	}

    	// Step 2: POST IPN data back to PayPal to validate
    	$ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');					// Production URL
    	// $ch = curl_init('https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');		// Sandbox URL
    	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

    	// In wamp-like environments that do not come bundled with root authority certificates,
    	// please download 'cacert.pem' from "https://curl.haxx.se/docs/caextract.html" and set
    	// the directory path of the certificate as shown below:
    	// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');

    	if ( !($res = curl_exec($ch)) )
    	{
			// error_log("Got " . curl_error($ch) . " when processing IPN data");
			curl_close($ch);
			exit;
    	}
    	curl_close($ch);

    	// inspect IPN validation result and act accordingly
    	if (strcmp ($res, "VERIFIED") == 0)
    	{
    	  	// The IPN is verified, process it
    	  	$responseData = array();
    	  	parse_str($raw_post_data, $responseData);

    	  	$paymentTransactionDetail = PaymentTransactionDetail::where(['invoice_no' => $responseData['invoice']])->first();

    	  	$paymentTransactionDetail->address_city	= $responseData['address_city'];
    	  	$paymentTransactionDetail->address_country = $responseData['address_country'];
    	  	$paymentTransactionDetail->address_country_code	= $responseData['address_country_code'];	
    	  	$paymentTransactionDetail->address_name	= $responseData['address_name'];
    	  	$paymentTransactionDetail->address_state = $responseData['address_state'];
    	  	$paymentTransactionDetail->address_status = $responseData['address_status'];
    	  	$paymentTransactionDetail->address_street = $responseData['address_street'];
    	  	$paymentTransactionDetail->address_zip = $responseData['address_zip'];
    	  	$paymentTransactionDetail->first_name = $responseData['first_name'];
    	  	$paymentTransactionDetail->last_name = $responseData['last_name'];
    	  	$paymentTransactionDetail->ipn_track_id	= isset( $responseData['ipn_track_id'] ) ? $responseData['ipn_track_id'] : '';
    	  	$paymentTransactionDetail->item_name = $responseData['item_name'];
    	  	$paymentTransactionDetail->item_number = $responseData['item_number'];
    	  	$paymentTransactionDetail->mc_currency = $responseData['mc_currency'];
    	  	$paymentTransactionDetail->mc_gross	= $responseData['mc_gross'];
    	  	$paymentTransactionDetail->notify_version = $responseData['notify_version'];
    	  	$paymentTransactionDetail->payer_email = $responseData['payer_email'];
    	  	$paymentTransactionDetail->payer_id	= $responseData['payer_id'];
    	  	$paymentTransactionDetail->payer_status	= $responseData['payer_status'];
    	  	$paymentTransactionDetail->payment_date	= $responseData['payment_date'];
    	  	$paymentTransactionDetail->payment_gross = isset( $responseData['payment_gross'] ) ? $responseData['payment_gross'] : '';
    	  	$paymentTransactionDetail->payment_status = $responseData['payment_status'];
    	  	$paymentTransactionDetail->payment_type	= $responseData['payment_type'];
    	  	$paymentTransactionDetail->pending_reason = isset( $responseData['pending_reason'] ) ? $responseData['pending_reason'] : '';
    	  	$paymentTransactionDetail->protection_eligibility = isset( $responseData['protection_eligibility'] ) ? $responseData['protection_eligibility'] : '';	
    	  	$paymentTransactionDetail->quantity	= $responseData['quantity'];
    	  	$paymentTransactionDetail->receiver_email = $responseData['receiver_email'];
    	  	$paymentTransactionDetail->residence_country = $responseData['residence_country'];	
    	  	$paymentTransactionDetail->txn_id = $responseData['txn_id'];
    	  	$paymentTransactionDetail->transaction_subject = isset( $responseData['transaction_subject'] ) ? $responseData['transaction_subject'] : '';
    	  	$paymentTransactionDetail->txn_type	= $responseData['txn_type'];
    	  	$paymentTransactionDetail->verify_sign = $responseData['verify_sign'];

    	  	$paymentTransactionDetail->save();

    	  	// Send the email to company to start the work
    	  	Helper::companyStartWorkNotification( $responseData['invoice'] );
    	}
    	else if (strcmp ($res, "INVALID") == 0)
    	{
    		// IPN invalid, log for manual investigation
    		
    	}
    	
    	// Log::info( $log );
    	Log::info( $responseData );
    }
}
