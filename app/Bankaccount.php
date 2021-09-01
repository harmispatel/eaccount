<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankaccount extends Model
{
    protected $table = "bankaccount";
    //
    public function hasManyBanktoDonor()
    {
        return $this->hasMany('App\Bankaccounttodonor','bankaccount_id','id');
    }
}
