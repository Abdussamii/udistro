<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalServiceType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service', 'status'
    ];

    public $timestamps = true;
}
