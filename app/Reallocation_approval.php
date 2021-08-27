<?php

namespace App;

use App\IncomeExpenseHead;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Reallocation_approval extends Model
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'reallocation';
    protected $dates = ['deleted_at'];
}
