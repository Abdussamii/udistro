<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_name', 'company_category_id', 'address', 'province_id', 'city_id', 'postal_code', 'status'
    ];

    public $timestamps = true;

    /**
     * Get the province associated with the company.
     */
    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    /**
     * Get the city associated with the company.
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * The services provided by the company.
     */
    public function services()
    {
        return $this->belongsToMany('App\CategoryService');
    }
}
