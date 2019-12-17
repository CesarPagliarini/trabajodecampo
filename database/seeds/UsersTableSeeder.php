<?php

use App\Entities\Role;
use App\Entities\User;
use Carbon\Carbon;
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

        $adminRole = Role::where('name', 'Administrador')->first()->id;
        $idAdmin = DB::table('users')->insertGetId([
            'name' => 'administrador',
            'last_name' => 'apellido administrador',
            'email' => 'administrador@genesis.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => $idAdmin,
            'role_id' => $adminRole,
        ]);

        $adminVentasRole = Role::where('name', 'Gestor de ventas')->first()->id;
        $idVentas = DB::table('users')->insertGetId([
            'name' => 'gestor de ventas',
            'last_name' => 'apellido gestor ventas',
            'email' => 'ventas@genesis.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => $idVentas,
            'role_id' => $adminVentasRole,
        ]);


        $adminUserRoles = Role::where('name', 'Gestor de usuarios')->first()->id;
        $idadminUsers = DB::table('users')->insertGetId([
            'name' => 'gestor de usuarios',
            'last_name' => 'apellido gestor usuarios',
            'email' => 'usuarios@genesis.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('user_roles')->insert([
            'user_id' => $idadminUsers,
            'role_id' => $adminUserRoles,
        ]);


        $clientRole = Role::where('name', 'Cliente')->first()->id;


        for($i = 0; $i <= 10; $i++){
            $idCliente = DB::table('users')->insertGetId([
                'name' => 'Cliente de test '.$i,
                'last_name' => 'Apellido de test '.$i,
                'email' => 'cliente'.$i.'@genesis.com',
                'password' => bcrypt('123'),
                'cuit_cuil' => '203600635'.$i,
                'document' => '3600635'.$i,
                'address' => 'calle 123',
                'cel_phone' => '34541999555',
                'city' => 'Rosario',
                'region' => 'Santa fe',
                'zip_code' => '2000',
                'country' => 'Argentina',
                'date_of_birthday' => Carbon::yesterday()
            ]);
        }
        DB::table('user_roles')->insert([
            'user_id' => $idCliente,
            'role_id' => $clientRole,
        ]);




    }
}
