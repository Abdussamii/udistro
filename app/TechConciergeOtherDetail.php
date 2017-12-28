<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechConciergeOtherDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'details'
    ];

    public $timestamps = false;
}
