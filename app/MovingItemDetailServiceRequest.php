<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovingItemDetailServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id', 'message', 'status'
    ];

    public $timestamps = true;
}
