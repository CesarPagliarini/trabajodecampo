<?php


namespace App\Entities\traits;



trait RulesManager
{

    public function hasRole($role): bool
    {
        $founded = $this->roles->find($role) ? true : false;
        return is_null($founded) ? false : $founded;
    }

    public function hasAnyRole(array $params, string $key = 'name'): bool
    {
        if(is_array($params))
        {
            $retval = false;
            foreach($params as $role)
            {
                if($this->roles->where($key, '===', $role)->count())
                {
                    $retval = true;
                }
            }
            return $retval;
        }
    }

    public function can($permission)
    {
        $searched = explode('.',$permission);
        try{
            $collection = $this->forms->where('key', $searched[0])
                ->first()->permissions->pluck('action');

            if($collection->contains('all'))
                return true;
            return $collection->contains($searched[1] );
        }catch(\Exception $e){
            return false;
        }

    }

}
