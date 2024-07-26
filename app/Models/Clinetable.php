<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinetable extends Model 
{

    protected $table = 'clientables';
    public $timestamps = true;
    protected $fillable = array('client_id', 'clientable_id', 'clientable_type');

}