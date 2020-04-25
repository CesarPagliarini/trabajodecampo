<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'servicio uno',
            'description' => 'servicio uno',
            'state' =>'1'
        ]);
        DB::table('services')->insert([
            'name' => 'servicio dos',
            'description' => 'servicio dos',
            'state' =>'1'
        ]);
        DB::table('services')->insert([
            'name' => 'servicio tres',
            'description' => 'servicio tres',
            'state' =>'1'
        ]);
        DB::table('services')->insert([
            'name' => 'servicio cuatro',
            'description' => 'servicio cuatro',
            'state' =>'1'
        ]);
        DB::table('services')->insert([
            'name' => 'servicio cinco',
            'description' => 'servicio cinco',
            'state' =>'1'
        ]);
    }
}
