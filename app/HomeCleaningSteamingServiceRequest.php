<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCleaningSteamingServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'service_request_id', 'steaming_service_id', 'amount', 'status'
    ];

    public $timestamps = true;
}
