<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentClientMovingFromAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_client_id', 'address1', 'address2', 'province_id', 'city_id', 'postal_code', 'country_id', 'moving_from_house_type', 'moving_from_floor', 'moving_from_bedroom_count', 'moving_from_property_type', 'status', 'created_by'
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
