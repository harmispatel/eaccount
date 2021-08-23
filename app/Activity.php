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
        
        'created_by',
        'updated_by',
        'deleted_at'
    ];
}
