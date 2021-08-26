<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Region extends Model
{ 
    use Notifiable;
    public $table="region"; 
    public $timestamps = false;
}
