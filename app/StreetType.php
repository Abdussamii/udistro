<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreetType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'status'
    ];

    public $timestamps = true;

    /**
     * Get the province associated with the city.
     */
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
