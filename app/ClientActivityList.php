<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientActivityList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity', 'image_name', 'description', 'status', 'listing_event', 'activity_class'
    ];

    public $timestamps = true;
}
