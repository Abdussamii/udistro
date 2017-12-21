<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovingOtherItemService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'other_moving_items_services_details'
    ];

    public $timestamps = true;
}
