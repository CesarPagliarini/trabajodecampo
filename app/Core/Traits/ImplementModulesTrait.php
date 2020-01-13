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
    public function implementClientModule()
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


    public function implementHomeForm(){
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
                    'order' => '0'
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

    public function implementsProductModule(){
        $storeModule = Module::where('name','Tienda')->first();
        if(!$storeModule){
            try {
                DB::beginTransaction();
                $moduleData = ['name' => 'Tienda',
                    'description' => 'Modulo de gestion de Tienda',
                    'internal_handler' => 'store_handler',
                    'icon' => 'fa fa-suitcase',
                    'state' => '1',
                    'order' => '1'];
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

    public function implementFakeOrders(){

        $orderSaleModule = Module::where('name','Pedidos')->first();

        if($orderSaleModule){
            $clients = User::allClients('active')->first()->id;
            try {
                $order = SaleOrder::create([
                    'identifier' => 1,
                    'state_id' => 1,
                    'shipping_way' => 1,
                    'sub_total' => 250,
                    'client_id' => $clients,
                ]);
                $saleDetail = SaleOrderDetail::create([
                    'order_identifier' => $order->identifier,
                    'product_id' => 2,
                    'quantity' => 15,
                    'unit_price' => 10,
                    'total_item' => 150
                ]);

                $saleDetail = SaleOrderDetail::create([
                    'order_identifier' => $order->identifier,
                    'product_id' => 2,
                    'quantity' => 10,
                    'unit_price' => 10,
                    'total_item' => 100
                ]);
                $order = SaleOrder::create([
                    'identifier' => 2,
                    'state_id' => 1,
                    'shipping_way' => 1,
                    'sub_total' => 150,
                    'client_id' => $clients
                ]);
                $saleDetail = SaleOrderDetail::create([
                    'order_identifier' => $order->identifier,
                    'product_id' => 2,
                    'quantity' => 15,
                    'unit_price' => 10,
                    'total_item' => 150
                ]);
                DB::commit();
            }catch(Exception $e){
                DB::rollBack();
            }
        }
    }


    //

}
