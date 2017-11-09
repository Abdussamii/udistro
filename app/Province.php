<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
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

    /**
     * Get the cities for the province.
     */
    public function cities()
    {
        return $this->hasMany('App\City')->where(['status' => '1'])->orderBy('name', 'asc');
    }
}
