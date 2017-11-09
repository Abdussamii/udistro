<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilityServiceProvider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utility_service_category_id', 'company_name', 'country_id', 'province_id', 'city', 'address', 'status'
    ];

    public $timestamps = true;

    /**
     * Get the service types for the service providers.
     */
    public function serviceTypes()
    {
        return $this->belongsToMany('App\UtilityServiceType');
    }
}
