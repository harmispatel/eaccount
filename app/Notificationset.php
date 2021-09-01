<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificationset extends Model
{
    use SoftDeletes;
    
    protected $table = 'notificationset';
    protected $dates = ['deleted_at'];
}
