<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovingTransportation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transportation_type'
    ];

    public $timestamps = true;
}
