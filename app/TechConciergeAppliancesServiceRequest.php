<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechConciergeAppliancesServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_request_id', 'appliance_id', 'service_hours', 'amount'
    ];

    public $timestamps = true;
}
