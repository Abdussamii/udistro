<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentClientRating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id', 'client_id', 'rating', 'comment', 'created_at'
    ];

    public $timestamps = false;
}
