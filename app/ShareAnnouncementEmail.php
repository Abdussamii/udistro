<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareAnnouncementEmail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'email_content', 'status'
    ];

    public $timestamps = false;
}
