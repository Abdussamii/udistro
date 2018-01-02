<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechConciergeOtherDetailServiceRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_request_id', 'other_detail_id', 'service_hours', 'amount'
    ];

    public $timestamps = true;
}
