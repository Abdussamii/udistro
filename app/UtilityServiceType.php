<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilityServiceType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utility_service_category_id', 'service_type', 'status'
    ];

    public $timestamps = true;
}
