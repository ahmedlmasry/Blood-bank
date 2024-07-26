<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->morphToMany(Client::class, 'clientable');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

}
