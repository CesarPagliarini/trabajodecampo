<?php


namespace App\Core\SystemBuilder;



use App\Entities\Permission;
use App\Entities\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

abstract class AbstractBuilder
{

    protected $id;

    protected $childs;

    protected $fields;

    protected $table;

    protected $keys;


    abstract function __construct();

    abstract function say($message);

    abstract function build(int $order);


    function exist()
    {
        return DB::table($this->table)->where($this->keys)->first() ? true : false;
    }


    protected function callChilds()
    {
        if(!empty($this->childs))
        {
            $this->childs->each(function($child, $key)
            {
                (new $child())->build($key, $this->id);
            });
        }
        return;
    }



    protected function transact()
    {
        if($this->exist()){

            $this->say('bad');
        }
        else
        {
            try
            {
                DB::beginTransaction();
                $this->id = DB::table($this->table)->insertGetId($this->fields);
                DB::commit();
            }catch (\Exception $e)
            {
                DB::rollBack();
                $this->say($e->getMessage());
                Log::channel('module-implementation')->critical($e->getMessage());
            }
        }

    }


    protected function addField($field, $value)
    {
        $this->fields[$field] = $value;
    }

    protected function addToAdmin()
    {

        try{
            $adminRole = Role::where('name', 'Administrador')->first()->id;
            $permissions = Permission::all()->pluck('id')->toArray();
            for($i = 0 ; $i < count($permissions) ;$i++) {
                DB::table('role_permissions_forms')->insert([
                    'role_id' => intval($adminRole),
                    'permission_id' => intval($permissions[$i]),
                    'form_id' => intval($this->id),
                ]);

            }
        }catch (\Exception $e){}


    }
}
