<?php

use App\Entities\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            'action' => 'view',
            'description' => 'Permite visualizar registros',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('permissions')->insert([
            'action' => 'create',
            'description' => 'Permite crear registros',
            'icon' => 'fa fa-th-large',
        ]);
        DB::table('permissions')->insert([
            'action' => 'delete',
            'description' => 'Permite eliminar registros',
            'icon' => 'fa fa-th-large',
        ]);
        DB::table('permissions')->insert([
            'action' => 'update',
            'description' => 'Permite actualizar registros',
            'icon' => 'fa fa-th-large',
        ]);


    }
}
