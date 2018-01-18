<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestResponse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_id', 'company_id', 'gst_amount', 'gst_amount', 'pst_amount', 'service_charge', 'insurance', 'insurance', 'total_amount', 'total_remittance', 'comment'
    ];

    public $timestamps = true;
}
