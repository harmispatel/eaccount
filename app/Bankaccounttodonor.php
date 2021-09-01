<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankaccounttodonor extends Model
{
    protected $table = 'bankaccount_to_donor';
    public $timestamps = false;
    //
    public function hasOneSupportDonor()
    {
        return $this->hasOne('App\supportDonor','id','donor_id');
    }
}
