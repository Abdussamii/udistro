<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentClient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id', 'fname', 'lname', 'oname', 'email', 'contact_number', 'status'
    ];

    public $timestamps = true;
}
