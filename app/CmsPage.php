<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'navigation_id', 'page_name', 'page_content', 'status'
    ];

    public $timestamps = true;

    /**
     * Get the navigation category associated with page.
     */
    public function category()
    {
        return $this->hasOne('App\CmsNavigationCategory');
    }
}
