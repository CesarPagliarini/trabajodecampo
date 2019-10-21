<?php

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
        DB::table('users')->insert([
            'name' => 'tomas',
            'email' => 'tomas@genesis.com',
            'password' => bcrypt('tomas'),
        ]);
    }
}
