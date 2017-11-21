<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the company that owns the user. Company Representative, Agents are associated to the company
     */
    public function company()
    {
        return $this->belongsToMany('App\Company');
    }

    /**
     * Get the agent email template.
     */
    public function emailTemplate()
    {
        return $this->belongsToMany('App\EmailTemplate');
    }
}
