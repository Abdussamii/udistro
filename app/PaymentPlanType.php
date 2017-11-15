<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPlanType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_type', 'plan_type_desc', 'status'
    ];

    public $timestamps = true;
}
