<?php

namespace App\Http\Middleware\Roles\Project_approval;

use Closure;

use Illuminate\Support\Facades\Session;

class ModuleShow
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
        // echo config('role_manage.Activity.All'); die; 
        if (config('role_manage.Project_approval.All')){  // Module Show
            return $next($request);
        }else{ 
            Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect()->route('dashboard');
        }

    }
}
