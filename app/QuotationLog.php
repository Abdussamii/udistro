<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'client_id', 'payment_plan_id', 'status'
    ];

    public $timestamps = false;
}
