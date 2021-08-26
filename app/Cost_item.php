<?php

namespace App;

use App\IncomeExpenseHead;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Cost_item extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'projects_cost_item';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'main_activity_id',
        'sub_activity_id',
        'title',
        'description',
        'single_unit',
        'single_cost',
        'unit',
        'cost',
        'frequency',
        'quater',
        'status',
        
        'created_by',
        'updated_by',
        'deleted_at'
    ];
    
    public function hasOneParentActivity()
    {
        return $this->hasOne('App\Activity','id','main_activity_id');
    }
    public function hasOneSubActivity()
    {
        return $this->hasOne('App\Activity','id','sub_activity_id');
    }
    
}
