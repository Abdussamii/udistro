<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilityCompany extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utility_id', 'utility_company_name', 'province_id', 'phone_number', 'status'
    ];

    public $timestamps = true;
}
