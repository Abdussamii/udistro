<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DigitalAdditionalService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'additional_service', 'status'
    ];

    public $timestamps = true;
}
