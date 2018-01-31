<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTransactionDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'service_request_response_id', 'invoice_no','address_city', 'address_country', 'address_country_code', 'address_name', 'address_state', 'address_status', 'address_street', 'address_zip', 'first_name', 'last_name', 'ipn_track_id', 'item_name', 'item_number', 'mc_currency', 'mc_gross', 'notify_version', 'payer_email', 'payer_id', 'payer_status', 'payment_date', 'payment_gross', 'payment_status', 'payment_type', 'pending_reason', 'protection_eligibility', 'quantity', 'receiver_email', 'residence_country', 'txn_id', 'transaction_subject', 'txn_type', 'verify_sign'
    ];

    public $timestamps = true;
}
