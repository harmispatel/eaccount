<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksStatus extends Model
{
    protected $table = 'tasks_status';
    public $timestamps = false;
    
    public function hasOneStatus()
    { 
        return $this->hasOne('App\Status','id','status_id');
    }
}
