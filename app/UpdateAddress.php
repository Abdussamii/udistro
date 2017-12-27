<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province_id', 'title', 'status'
    ];

    public $timestamps = true;
}
