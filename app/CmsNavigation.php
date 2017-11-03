<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsNavigation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'navigation_text', 'navigation_url', 'status'
    ];

    public $timestamps = true;

    /**
     * Get the categories for the navigation.
     */
    public function categories()
    {
        return $this->belongsToMany('App\CmsNavigationCategory');
    }
}
