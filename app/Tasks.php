<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';
    public $timestamps = false;
    //
    public function hasManyTasksStatus()
    {
        return $this->hasMany('App\TasksStatus','task_id','id');
    }
}
