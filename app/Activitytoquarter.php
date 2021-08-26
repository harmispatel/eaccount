<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitytoquarter extends Model
{
    protected $table = 'actitivty_to_quarter';
    public $timestamps = false;
    //
    public function hasOneQuarter()
    {
        return $this->hasOne('App\ActivityQuarter','id','quarter_id');
    }
}
