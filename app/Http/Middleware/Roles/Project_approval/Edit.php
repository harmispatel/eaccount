<?php

namespace App\Http\Middleware\Roles\Project_approval;

use Closure;

use App\Http\Controllers\RoleManageController;
use Illuminate\Support\Facades\Session;

class Edit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $UserEdit=config('role_manage.Project_approval.Edit');
        if ($UserEdit){ // Edit
            return $next($request);
        }else{
            Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect()->back();
        }
    }
}
