<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsNavigationCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'navigation_type_id', 'category', 'status'
    ];

    public $timestamps = true;
}
