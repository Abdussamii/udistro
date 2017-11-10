<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_name', 'plan_charges', 'validity_days', 'number_of_emails', 'status'
    ];

    public $timestamps = true;
}
