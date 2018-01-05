<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_client_id',
        'invitation_id',
        'digital_service_company_id',
        'moving_from_house_type',
        'moving_from_floor',
        'moving_from_bedroom_count',
        'moving_from_property_type',
        'moving_to_house_type',
        'moving_to_floor',
        'moving_to_bedroom_count',
        'moving_to_property_type',
        'have_cable_internet_already',
        'employment_status',
        'want_to_receive_electronic_bill',
        'want_to_contract_plan',
        'want_to_setup_preauthorise_payment',
        'callback_option',
        'callback_time',
        'primary_no',
        'secondary_no',
        'additional_information',
        'status'
    ];

    public $timestamps = true;
}
