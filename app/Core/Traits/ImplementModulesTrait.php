<?php
namespace App\Core\Traits;

use App\Entities\Permission;
use App\Entities\Role;
use Illuminate\Support\Facades\DB;


use App\Entities\RolePermissionsForms;
use PHPUnit\Exception;

trait implementModulesTrait
{
    public function implementClientModule()
    {

        try {
            DB::beginTransaction();
            $moduleData = ['name' => 'Clientes',
                'description' => 'Modulo de gestion de clientes',
                'internal_handler' => 'client_handler',
                'icon' => 'fa fa-user',
                'state' => '1',
                'order' => '1'];
            $idModule = DB::table('modules')->insertGetId($moduleData);

            //implements client forms

            $activeForm = ['module_id' => $idModule,
                'name' => 'Clientes activos',
                'key' => 'activeClients',
                'target' => 'panel/clients',
                'icon' => 'fa fa-user',
                'state' => '1',
                'order' => '0'];
            $unactiveForm = ['module_id' => $idModule,
                'name' => 'Clientes inactivos',
                'key' => 'unactiveClients',
                'target' => 'panel/unactive-clients',
                'icon' => 'fa fa-trash',
                'state' => '1',
                'order' => '1'];

           $activeFormId = DB::table('forms')->insertGetId($activeForm);
           $unactiveFormId =  DB::table('forms')->insertGetId($unactiveForm);

           $adminRole = Role::where('name', 'Administrador')->first()->id;
           $formsToAttach = [$activeFormId, $unactiveFormId];
           $permissions = Permission::all()->pluck('id')->toArray();
           foreach($formsToAttach as $idForm)
           {
               for($i = 0 ; $i < count($permissions) ;$i++) {
                   DB::table('role_permissions_forms')->insert([
                       'role_id' => intval($adminRole),
                       'permission_id' => intval($permissions[$i]),
                       'form_id' => intval($idForm),
                   ]);
               }
           }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();

        }

    }


}
