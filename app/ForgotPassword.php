<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{

    protected $fillable = [
        'email', 'hash', 'status'
    ];

    public $timestamps = true;

}
