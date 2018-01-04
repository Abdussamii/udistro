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
        'agent_client_id', 'address1', 'address2', 'province_id', 'city_id', 'postal_code', 'country_id', 'moving_date', 'status', 'created_by'
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
