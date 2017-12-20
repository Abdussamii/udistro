<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentPlanSubscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_type_id', 'plan_type_id', 'subscriber_id', 'start_date', 'end_date', 'status'
    ];

    public $timestamps = false;
}
