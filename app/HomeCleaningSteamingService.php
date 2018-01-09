<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCleaningSteamingService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'steaming_service_for', 'status'
    ];

    public $timestamps = true;
}
