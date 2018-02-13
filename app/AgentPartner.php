<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentPartner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id', 'fname', 'lname', 'partner_email', 'status'
    ];

    public $timestamps = true;

}
