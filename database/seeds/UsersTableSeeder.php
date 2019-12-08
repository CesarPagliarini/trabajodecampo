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

        $idMaxi = DB::table('users')->insertGetId([
            'name' => 'maxi',
            'email' => 'maxi@genesis.com',
            'password' => bcrypt('maxi'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => $idMaxi,
            'role_id' => $adminRole,
        ]);

        $date = DateTime::createFromFormat('Y-m-d', '1991-07-20');
        $idCalvo = DB::table('users')->insertGetId([
            'name' => 'pelado',
            'email' => 'pelado@genesis.com',
            'password' => bcrypt('pelado'),
            'last_name' => 'arfeli',
            'address' => 'la casa 123',
            'cel_phone' => '345419874',
            'city' => 'rosario',
            'region'=> 'santa fe',
            'zip_code' => '2000',
            'country'=> 'argentina',
            'date_of_birthday' => $date,
        ]);
        $clientRole = Role::where('name', 'Cliente')->first()->id;
        DB::table('user_roles')->insert([
            'user_id' => $idCalvo,
            'role_id' => $clientRole,
        ]);




    }
}
