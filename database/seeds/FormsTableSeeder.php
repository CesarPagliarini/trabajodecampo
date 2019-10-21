<?php

use App\Entities\Form;
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
            'parent_id' => 0,
            'name' => 'Usuarios',
            'key' => 'users',
            'target' => 'admin/users',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('forms')->insert([
            'parent_id' => 0,
            'name' => 'Roles',
            'key' => 'roles',
            'target' => 'admin/roles',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('forms')->insert([
            'parent_id' => 0,
            'name' => 'Formularios',
            'key' => 'forms',
            'target' => 'admin/forms',
            'icon' => 'fa fa-th-large',
        ]);

        DB::table('forms')->insert([
            'parent_id' => 0,
            'name' => 'Permisos',
            'key' => 'permissions',
            'target' => 'admin/permissions',
            'icon' => 'fa fa-th-large',
        ]);
    }
}
