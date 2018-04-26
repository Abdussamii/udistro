<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoverUtilityActionLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utility_id', 'client_id', 'invitation_id', 'action_status'
    ];

    public $timestamps = false;
}
