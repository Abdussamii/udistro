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
        'agent_client_id', 'address', 'unit', 'province_id', 'city_id', 'street_type_id', 'postalcode', 'country_id', 'status'
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
