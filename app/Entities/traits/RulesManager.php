<?php


namespace App\Entities\traits;



use App\Entities\RolePermissionsForms;

trait RulesManager
{

    public function hasRole($role): bool
    {
        $founded = $this->roles->find($role) ? true : false;
        return is_null($founded) ? false : $founded;
    }

    public function hasAnyRole(array $params, string $key = 'name'): bool
    {
        $roles = $this->roles;

        if(is_array($params) && $roles->count() )
        {
            $retval = false;
            foreach($params as $role)
            {
                if($roles->where($key, '===', $role)->count())
                {
                    $retval = true;
                }
            }
            return $retval;
        }
    }

    public function can($permission)
    {

        $forms = $this->forms;
        $searched = explode('.',$permission);
        if(!is_null($forms)) {
            $collection = $this->forms->where('key', $searched[0])
                ->first();
            if(is_null($collection)){
                return false;
            }else{
               $collection =  $collection->permissions->pluck('action');
            }
            if ($collection->contains('all'))
                return true;
            return $collection->contains($searched[1]);
        }else{
            return false;
        }
    }

    public function roleCan($triada)
    {

        $exploded = explode('-', $triada);

        $r = RolePermissionsForms::where('role_id', intval($exploded[0]))
            ->where('form_id', intval($exploded[1]))
            ->where('permission_id', intval($exploded[2]))->first();
        return !is_null($r);

    }


}
