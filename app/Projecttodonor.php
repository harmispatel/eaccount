<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projecttodonor extends Model
{
    protected $table = 'projects_to_donor';
    public $timestamps = false;
    //

    public function hasOneSupportDonor()
    {
       return $this->hasOne('App\SupportDonor','id','donor_id');
    }
}
