<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentClientMovingToAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_client_id', 'address1', 'address2', 'province_id', 'city_id', 'postal_code', 'country_id', 'moving_to_house_type', 'moving_to_floor', 'moving_to_bedroom_count', 'moving_to_property_type', 'moving_date', 'status', 'created_by'
    ];

    public $timestamps = true;

    /**
     * Get the province associated with the city.
     */
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
