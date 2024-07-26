<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('notification_title', 'notification_content', 'donation_requste_id');

    public function donationRequste()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

}
