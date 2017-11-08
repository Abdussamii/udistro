<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilityServiceCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_type', 'description', 'status'
    ];

    public $timestamps = true;
}
