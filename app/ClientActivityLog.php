<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientActivityLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invitation_id', 'client_id', 'activity_id', 'action'
    ];

    public $timestamps = false;
}
