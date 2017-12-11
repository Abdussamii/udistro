<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientActivityFeedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'activity_id', 'feedback'
    ];

    public $timestamps = false;
}
