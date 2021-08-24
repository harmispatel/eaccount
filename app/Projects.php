<?php

namespace App;

use App\IncomeExpenseHead;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Projects extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'projectName',
        'region',
        'donor',
        'coordinator',
        'status',
        
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    public function hasManyActivity()
    {
        return $this->hasMany('App\Activity','project_id','id');
    }
    public function hasOneSupportDonor()
    {
       return $this->hasOne('App\SupportDonor','id','donor');
    }
    public function hasOneUser()
    {
       return $this->hasOne('App\User','id','coordinator');
    }
 



}
