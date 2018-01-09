<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCleaningServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'agent_client_id',
		'invitation_id',
		'company_id',
		'moving_from_house_type',
		'moving_from_floor',
		'moving_from_bedroom_count',
		'moving_from_property_type',
		'moving_to_house_type',
		'moving_to_floor',
		'moving_to_bedroom_count',
		'moving_to_property_type',
		'home_condition',
		'home_cleaning_level',
		'home_cleaning_area',
		'home_cleaning_people_count',
		'home_cleaning_pet_count',
		'home_cleaning_bathroom_count',
		'cleaning_behind_refrigerator_and_stove',
		'baseboard_to_be_washed',
		'primary_no',
		'secondary_no',
		'additional_information',
		'status',
    ];

    public $timestamps = true;
}
