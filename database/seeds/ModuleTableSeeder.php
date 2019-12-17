<?php

use App\Entities\Module;
use App\Entities\Permission;
use App\Entities\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
                    'order' => '1'];
                $idModule = DB::table('modules')->insertGetId($moduleData);

                //implements client forms

                $order = ['module_id' => $idModule,
                    'name' => 'Pedidos',
                    'key' => 'orders',
                    'target' => 'panel/orders',
                    'icon' => 'fa fa-sort',
                    'state' => '1',
                    'order' => '0'];
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



                $deliveredFormId = DB::table('forms')->insertGetId($deliveredForm);
                $aceptedFormId =  DB::table('forms')->insertGetId($aceptedForm);
                $rejecterFormId = DB::table('forms')->insertGetId($rejecterForm);
                $pendingFormId =  DB::table('forms')->insertGetId($pendingForm);
                $inprepareFormId =  DB::table('forms')->insertGetId($inprepareForm);

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

}
