<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Usuarios',
            'key' => 'users',
            'target' => 'panel/users',
            'icon' => 'fa fa-user-o',
            'order' => '0'
        ]);

        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Roles',
            'key' => 'roles',
            'target' => 'panel/roles',
            'icon' => 'fa fa-tachometer',
            'order' => '1'
        ]);

        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Permisos',
            'key' => 'permissions',
            'target' => 'panel/permissions',
            'icon' => 'fa fa-handshake-o',
            'order' => '2'
        ]);
        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Modulos',
            'key' => 'modules',
            'target' => 'panel/modules',
            'icon' => 'fa fa-folder-open',
            'order' => '3'
        ]);
        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Formularios',
            'key' => 'forms',
            'target' => 'panel/forms',
            'icon' => 'fa fa-address-book-o',
            'order' => '4'
        ]);

    }
}
