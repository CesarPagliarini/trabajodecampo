<?php

use App\Entities\Form;
use App\Entities\Permission;
use App\Entities\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionFormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idSuperAdmin = Role::where('name','Super administrador')->first()->id;
        $idAdmin = Role::where('name', 'Administrador')->first()->id;

        $permissions = Permission::all()->pluck('id')->toArray();
        $forms = Form::all()->pluck('id')->toArray();

        foreach($forms as $form){
            for($i = 0 ; $i < count($permissions) ;$i++){
                DB::table('role_permissions_forms')->insert([
                    'role_id' => intval($idSuperAdmin),
                    'permission_id' => intval($permissions[$i]),
                    'form_id' => intval($form),
                ]);
            }
            for($i = 0 ; $i < count($permissions) ;$i++){
                DB::table('role_permissions_forms')->insert([
                    'role_id' => intval($idAdmin),
                    'permission_id' => intval($permissions[$i]),
                    'form_id' => intval($form),
                ]);
            }

        }
    }
}
