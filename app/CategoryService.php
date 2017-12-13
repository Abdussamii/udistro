<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryService extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_category_id', 'service', 'description', 'status'
    ];

    public $timestamps = true;
}
