<?php

namespace App;

use App\IncomeExpenseHead;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Department extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'departmentName',
        'parent_id',
        'status',
        'department_code',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    
    public function hasOneHead()
    {
        return $this->hasOne('App\User','department_id','id');
    }
    public function hasManyActivity()
    {
        return $this->hasMany('App\Activity','department_id','id');
    }
    public function hasManyDepartmentStatus()
    { 
        return $this->hasMany('App\DepartmentStatus','department_id','id');
    }
    

}
