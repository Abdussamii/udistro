<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechConciergePlace extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'places'
    ];

    public $timestamps = false;
}
