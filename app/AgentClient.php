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

    /**
     * Get the moving from address.
     */
    public function movingFromAddress()
    {
        return $this->hasOne('App\AgentClientMovingFromAddress');
    }

    /**
     * Get the moving to address.
     */
    public function movingToAddress()
    {
        return $this->hasOne('App\AgentClientMovingToAddress');
    }
}
