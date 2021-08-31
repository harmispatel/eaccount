<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Notification extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'notification';
    protected $dates = ['deleted_at'];

    public function hasOneType()
    {
       return $this->hasOne('App\NotificationType','id','type_id');
    }
}
