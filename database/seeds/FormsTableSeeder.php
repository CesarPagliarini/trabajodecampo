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
            'target' => 'admin/users',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Roles',
            'key' => 'roles',
            'target' => 'admin/roles',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Formularios',
            'key' => 'forms',
            'target' => 'admin/forms',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('forms')->insert([
            'module_id' => 1,
            'name' => 'Permisos',
            'key' => 'permissions',
            'target' => 'admin/permissions',
            'icon' => 'fa fa-th-large',
        ]);
    }
}
