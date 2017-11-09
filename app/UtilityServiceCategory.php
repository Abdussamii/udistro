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

    /**
     * Get the service types for the service category.
     */
    public function serviceTypes()
    {
        return $this->hasMany('App\UtilityServiceType')->where(['status' => '1'])->orderBy('service_type', 'asc');
    }
}
