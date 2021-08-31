<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projecttoregion extends Model
{
    protected $table = 'projects_to_region';
    public $timestamps = false;
    //

    public function hasOneRegion()
    {
       return $this->hasOne('App\Region','id','region_id');
    }
}
