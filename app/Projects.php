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
        'over_budget',
        'total_budget',
        'coordinator',
        'user_id',
        'status',
        'start_date',
        'end_date',
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
    public function hasManyProjecttodonor()
    {
       return $this->hasMany('App\Projecttodonor','project_id','id');
    }
    public function hasOneRegion()
    {
       return $this->hasOne('App\Region','id','region');
    }
    public function hasOneUserApplied()
    {
       return $this->hasOne('App\User','id','user_id');
    }
    



}
