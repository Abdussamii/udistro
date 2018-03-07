<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRequestEmail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comapny_id', 'client_id', 'invitation_id', 'email_send_status'
    ];

    public $timestamps = false;

    /**
     * Get the province associated with the city.
     */
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
