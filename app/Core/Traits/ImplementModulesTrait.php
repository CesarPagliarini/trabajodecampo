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
    public function implementClientModule($order = '0')
    {
        $clientModule = Module::where('name','Clientes')->first();
        if(!$clientModule){
            try {
                DB::beginTransaction();
                $moduleData = ['name' => 'Clientes',
                    'description' => 'Modulo de gestion de clientes',
                    'internal_handler' => 'client_handler',
                    'icon' => 'fa fa-user',
                    'state' => '1',
                    'order' => $order];
                $idModule = DB::table('modules')->insertGetId($moduleData);

                //implements client forms

                $activeForm = ['module_id' => $idModule,
                    'name' => 'Activos',
                    'key' => 'activeClients',
                    'target' => 'panel/clients',
                    'icon' => 'fa fa-user',
                    'state' => '1',
                    'order' => '0'];
                $unactiveForm = ['module_id' => $idModule,
                    'name' => 'Inactivos',
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

    public function implementHomeForm($order = '0'){
        $homeForm = Form::where('name','Home')->first();
        if(!$homeForm){
            try{
                DB::beginTransaction();
                $homeForm = [
                    'module_id' => null,
                    'name' => 'Home',
                    'key' => 'homeForm',
                    'target' => 'panel/home',
                    'icon' => 'fa fa-home',
                    'state' => '1',
                    'order' => $order
                ];
                $homeFormId = DB::table('forms')->insertGetId($homeForm);
                $adminRole = Role::where('name', 'Administrador')->first()->id;
                $permissions = Permission::all()->pluck('id')->toArray();
                foreach($permissions as $permission)
                {
                    DB::table('role_permissions_forms')->insert([
                        'role_id' => intval($adminRole),
                        'permission_id' => intval($permission),
                        'form_id' => intval($homeFormId),
                    ]);
                }
                DB::commit();
            }catch (\Exception $e){
                dd($e);
                DB::rollBack();
            }
        }
    }

    public function implementsProductModule($order = '0'){
        $storeModule = Module::where('name','Tienda')->first();
        if(!$storeModule){
            try {
                DB::beginTransaction();
                $moduleData = ['name' => 'Tienda',
                    'description' => 'Modulo de gestion de Tienda',
                    'internal_handler' => 'store_handler',
                    'icon' => 'fa fa-suitcase',
                    'state' => '1',
                    'order' => $order];
                $idModule = DB::table('modules')->insertGetId($moduleData);

                //implements client forms

                $productForm = ['module_id' => $idModule,
                    'name' => 'Productos',
                    'key' => 'productForm',
                    'target' => 'panel/products',
                    'icon' => 'fa fa-superpowers',
                    'state' => '1',
                    'order' => '0'];
                $categoryForm = ['module_id' => $idModule,
                    'name' => 'Categorias',
                    'key' => 'categoriesForm',
                    'target' => 'panel/categories',
                    'icon' => 'fa fa-barcode',
                    'state' => '1',
                    'order' => '1'];
                $subcategoryForm = ['module_id' => $idModule,
                    'name' => 'Subcategorias',
                    'key' => 'subcategoriesForm',
                    'target' => 'panel/subcategories',
                    'icon' => 'fa fa-clone',
                    'state' => '0',
                    'order' => '2'];
                $brandsForm = ['module_id' => $idModule,
                    'name' => 'Marcas',
                    'key' => 'brandsForm',
                    'target' => 'panel/brands',
                    'icon' => 'fa fa-bookmark-o',
                    'state' => '0',
                    'order' => '3'];

                $productFormId = DB::table('forms')->insertGetId($productForm);
                $categoryFormId =  DB::table('forms')->insertGetId($categoryForm);
                $subcategoryFormId = DB::table('forms')->insertGetId($subcategoryForm);
                $brandsFormId =  DB::table('forms')->insertGetId($brandsForm);

                $adminRole = Role::where('name', 'Administrador')->first()->id;
                $formsToAttach = [$productFormId, $categoryFormId,$subcategoryFormId, $brandsFormId];
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

    public function implementsShiftsModule($order = '0'){
        $storeModule = Module::where('name','Turnos')->first();
        if(!$storeModule){
            try {
                DB::beginTransaction();
                $moduleData = ['name' => 'Turnos',
                    'description' => 'Modulo de gestion de Turnos',
                    'internal_handler' => 'shift_handler',
                    'icon' => 'fa fa-calendar',
                    'state' => '1',
                    'order' => $order];
                $idModule = DB::table('modules')->insertGetId($moduleData);

                $schedulesForm = ['module_id' => $idModule,
                    'name' => 'Horarios',
                    'key' => 'scheduleForm',
                    'target' => 'panel/schedules',
                    'icon' => 'fa fa-clock',
                    'state' => '1',
                    'order' => '1'];

                $shiftsForm = ['module_id' => $idModule,
                    'name' => 'Turnos',
                    'key' => 'shiftForm',
                    'target' => 'panel/shifts',
                    'icon' => 'fa fa-calendar',
                    'state' => '1',
                    'order' => '2'];

                $schedulesForm = DB::table('forms')->insertGetId($schedulesForm);
                $shiftsForm = DB::table('forms')->insertGetId($shiftsForm);

                $adminRole = Role::where('name', 'Administrador')->first()->id;
                $formsToAttach = [$schedulesForm , $shiftsForm];
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

    public function implementsOrdersModule($order = '0')
    {
        $orderSaleModule = Module::where('name','Pedidos')->first();
        if(!$orderSaleModule){
            try {
                DB::beginTransaction();
                $moduleData = [
                    'name' => 'Pedidos',
                    'description' => 'Modulo de gestion de pedidos',
                    'internal_handler' => 'orders_handler',
                    'icon' => 'fa fa-shopping-cart',
                    'state' => '1',
                    'order' => $order];
                $idModule = DB::table('modules')->insertGetId($moduleData);

                $pendingForm = ['module_id' => $idModule,
                    'name' => 'Pendientes',
                    'key' => 'pendingOrders',
                    'target' => 'panel/pending-orders',
                    'icon' => 'fa fa-spinner',
                    'state' => '1',
                    'order' => '1'];
                $rejecterForm = ['module_id' => $idModule,
                    'name' => 'Rechazados',
                    'key' => 'rejectedOrders',
                    'target' => 'panel/rejected-orders',
                    'icon' => 'fa fa-clone',
                    'state' => '1',
                    'order' => '5'];
                $aceptedForm = ['module_id' => $idModule,
                    'name' => 'Aprobados',
                    'key' => 'acceptedOrders',
                    'target' => 'panel/accepted-orders',
                    'icon' => 'fa fa-clone',
                    'state' => '1',
                    'order' => '2'];
                $deliveredForm = ['module_id' => $idModule,
                    'name' => 'Entregados',
                    'key' => 'deliveredOrders',
                    'target' => 'panel/delivered-orders',
                    'icon' => 'fa fa-thumbs-o-up',
                    'state' => '1',
                    'order' => '4'];
                $inprepareForm = ['module_id' => $idModule,
                    'name' => 'En preparacion',
                    'key' => 'inPrepareOrders',
                    'target' => 'panel/in-prepare-orders',
                    'icon' => 'fa fa-thumbs-o-up',
                    'state' => '1',
                    'order' => '3'];

                $pendingFormId =  DB::table('forms')->insertGetId($pendingForm);
                $aceptedFormId =  DB::table('forms')->insertGetId($aceptedForm);
                $inprepareFormId =  DB::table('forms')->insertGetId($inprepareForm);
                $deliveredFormId = DB::table('forms')->insertGetId($deliveredForm);
                $rejecterFormId = DB::table('forms')->insertGetId($rejecterForm);

                $adminRole = Role::where('name', 'Administrador')->first()->id;
                $formsToAttach = [$deliveredFormId, $aceptedFormId,$rejecterFormId, $pendingFormId, $inprepareFormId];
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
