<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'hospital_name', 'age', 'bags', 'address', 'details', 'latitude', 'longitude', 'city_id', 'client_id', 'blood_type_id');

    public function notifications()
    {
        return $this->hasMany(notification::class);
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}
