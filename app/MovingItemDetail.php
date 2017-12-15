<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovingItemDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'moving_items_category_id', 'moving_item_name', 'status'
    ];

    public $timestamps = true;
}
