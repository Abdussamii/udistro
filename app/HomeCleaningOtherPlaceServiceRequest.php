<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCleaningOtherPlaceServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'service_request_id', 'other_place_id', 'quantity', 'amount', 'status'
    ];

    public $timestamps = true;
}
