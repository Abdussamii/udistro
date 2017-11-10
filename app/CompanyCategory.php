<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'status'
    ];

    public $timestamps = true;
}
