<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utility_name', 'status'
    ];

    public $timestamps = true;
}
