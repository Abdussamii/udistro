<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentPartnerDigitalAdditionalServiceTypeRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'digital_service_request_id', 'digital_additional_service_type_id', 'service_hours', 'amount', 'amount'
    ];

    public $timestamps = true;
}