<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('email','d_o_b','last_donation_date','password','blood_type_id','city_id','phone','pin_code','api_token','name');

    public function bloodTypes()
    {
        return $this->morphedByMany('App\Models\BloodType', 'clientable');

    }
    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donationRequstes()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }

    public function governorates()
    {
        return $this->morphedByMany('App\Models\Governorate', 'clientable');
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
    protected $hidden = [
        'password',
        'api_token',
    ];

}
