<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechConciergeServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_client_id', 'invitation_id', 'company_id', 'moving_from_house_type', 'moving_from_floor', 'moving_from_bedroom_count', 'moving_from_property_type', 'primary_no', 'secondary_no', 'additional_information', 'status'
    ];

    public $timestamps = true;
}
