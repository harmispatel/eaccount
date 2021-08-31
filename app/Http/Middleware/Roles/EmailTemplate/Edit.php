<?php

namespace App\Http\Middleware\Roles\EmailTemplate;

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

        $EmailTemplateEdit=config('role_manage.EmailTemplate.Edit');
        if ($EmailTemplateEdit){ // Edit
            return $next($request);
        }else{
            Session::flash('error', 'You Can Not Perform This Action.Please Contact Your It Officer');
            return redirect()->back();
        }
    }
}