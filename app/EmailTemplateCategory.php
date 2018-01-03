<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    public $timestamps = true;
}
