<?php
namespace App\Core\Traits;

use App\Entities\Form;
use App\Entities\Module;
use App\Entities\Permission;
use App\Entities\Role;
use App\Entities\SaleOrder;
use App\Entities\SaleOrderDetail;
use App\Entities\SaleOrderState;
use App\Entities\User;
use Illuminate\Support\Facades\DB;
use App\Entities\RolePermissionsForms;
use PHPUnit\Exception;

trait implementModulesTrait
{





    public function implementsProfessionalsModule($order = '0')
    {
        $clientModule = Module::where('name','Profesionales')->first();
        if(!$clientModule){
            try {
                DB::beginTransaction();
                $moduleData = ['name' => 'Profesionales',
                    'description' => 'Modulo de gestion de profesionales',
                    'internal_handler' => 'professional_handler',
                    'icon' => 'fa fa-vcard-o',
                    'state' => '1',
                    'order' => $order];
                $idModule = DB::table('modules')->insertGetId($moduleData);

                //implements client forms

                $activeForm = ['module_id' => $idModule,
                    'name' => 'Activos',
                    'key' => 'activeProfessionals',
                    'target' => 'panel/professionals',
                    'icon' => 'fa fa-user',
                    'state' => '1',
                    'order' => '0'];
                $unactiveForm = ['module_id' => $idModule,
                    'name' => 'Inactivos',
                    'key' => 'unactiveProfessionals',
                    'target' => 'panel/unactive-professionals',
                    'icon' => 'fa fa-trash',
                    'state' => '1',
                    'order' => '1'];

                $serviceForm = ['module_id' => $idModule,
                    'name' => 'Servicios',
                    'key' => 'serviceForm',
                    'target' => 'panel/services',
                    'icon' => 'fa fa-building-o',
                    'state' => '1',
                    'order' => '2'];

                $specialtyForm = ['module_id' => $idModule,
                    'name' => 'Especialidades',
                    'key' => 'specialtiesForm',
                    'target' => 'panel/specialties',
                    'icon' => 'fa fa-trash',
                    'state' => '1',
                    'order' => '3'];

                $activeFormId = DB::table('forms')->insertGetId($activeForm);
                $unactiveFormId =  DB::table('forms')->insertGetId($unactiveForm);
                $serviceForm =  DB::table('forms')->insertGetId($serviceForm);
                $specialtyForm =  DB::table('forms')->insertGetId($specialtyForm);

                $adminRole = Role::where('name', 'Administrador')->first()->id;
                $formsToAttach = [$activeFormId, $unactiveFormId, $serviceForm,$specialtyForm];
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




}
