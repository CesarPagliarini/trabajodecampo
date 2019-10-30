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

        $ruta = explode('/',$request->route()->uri);

        if(count($ruta) > 1){
            $searched = $ruta[0].'/'.$ruta[1];
        }else{
            $searched = $ruta[0];
        }

        $formId = Form::where('target', $searched)->pluck('id')->first();
        $permissionId = Permission::where('action', 'view')->pluck('id')->first();
        foreach(Auth::user()->roles as $role)
        {
            $exist = RolePermissionsForms::where('permission_id', $permissionId)
                ->where('role_id', $role->id)
                ->where('form_id', $formId)->first();
        }

        if(is_null($exist)){
           // return redirect()->route('forbidden');
        };


        return $next($request);
    }
}
