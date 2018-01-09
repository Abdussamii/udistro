<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCleaningAdditionalServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'service_request_id', 'additional_request_id', 'quantity', 'amount', 'status'
    ];

    public $timestamps = true;
}
