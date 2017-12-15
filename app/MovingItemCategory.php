<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovingItemCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_name', 'status'
    ];

    public $timestamps = true;
}
