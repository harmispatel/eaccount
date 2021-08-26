<?php

namespace App;

use App\IncomeExpenseHead;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Approval extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'reallocation';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'cost_item_id',
        'created_user_id',
        'comment',
        'status',
        
    ];

    
    // public function hasOneHead()
    // {
    //     return $this->hasOne('App\User','department_id','id');
    // }


}
