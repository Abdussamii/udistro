<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechConciergeAppliance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appliances'
    ];

    public $timestamps = false;
}
