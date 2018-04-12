<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UtilityCompanyService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utility_company_service_id', 'utility_company_service_name', 'utility_company_id', 'status', 'status'
    ];

    public $timestamps = true;
}
