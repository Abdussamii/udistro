<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCleaningOtherPlace extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'other_places', 'status'
    ];

    public $timestamps = true;
}
