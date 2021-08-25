<?php

namespace App;

use App\IncomeExpenseHead;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Activity extends Model
{ 
    use Notifiable;
    use SoftDeletes;
    protected $table = 'projects_activity';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'description',
        'parent_id',
        'status',
        'project_id',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    public function hasManyActivitytoquarter()
    {
        return $this->hasMany('App\Activitytoquarter','activity_id','id');
    }
    public function hasManyCost_item()
    {
        return $this->hasMany('App\Cost_item','main_activity_id','id');
    }
    public function hasOneProject()
    {
        return $this->hasOne('App\Projects','id','project_id');
    }
    public function hasOneParentActivity()
    {
        return $this->hasOne('App\Activity','id','parent_id')->where('parent_id', '!=' ,0);
    }
        
    
}
