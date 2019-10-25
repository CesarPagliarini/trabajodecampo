<?php

use App\Entities\Role;
use App\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 4)->create();
        $idTom = DB::table('users')->insertGetId([
            'name' => 'tomas',
            'email' => 'tomas@genesis.com',
            'password' => bcrypt('tomas'),
        ]);
        $adminRole = Role::where('name', 'Administrador')->first()->id;
        DB::table('user_roles')->insert([
            'user_id' => $idTom,
            'role_id' => $adminRole,
        ]);
    }
}
