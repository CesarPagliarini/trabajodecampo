<?php

namespace App\Http\Middleware;

use App\Entities\Form;
use App\Entities\Permission;
use App\Entities\RolePermissionsForms;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
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

        if( ! Auth::user()->hasAccessToPanel()){
            return redirect('/');
        }

        return $next($request);
    }
}
