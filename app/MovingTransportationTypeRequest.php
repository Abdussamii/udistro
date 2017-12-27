<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovingTransportationTypeRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'transportation_id', 'moving_items_services_id', 'amount'
    ];

    public $timestamps = true;
}
