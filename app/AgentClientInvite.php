<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentClientInvite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id', 'client_id', 'email_template_id', 'message_content', 'email_url', 'schedule_status', 'schedule_datetime', 'status'
    ];

    public $timestamps = false;
}
