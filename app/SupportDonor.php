<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class SupportDonor extends Model
{
    use Notifiable;
    public $table="supportdonor"; 
    public $timestamps = false;
}
