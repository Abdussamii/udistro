<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechConciergePlaceServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_request_id', 'place_id', 'service_hours', 'amount'
    ];

    public $timestamps = true;
}
