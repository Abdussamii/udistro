<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseTimeSlot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slot_title', 'slot_time', 'status'
    ];

    public $timestamps = true;
}
