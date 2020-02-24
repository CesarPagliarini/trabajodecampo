<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->insert([
            'name' => 'ESPECIALIDAD uno',
            'description' => 'ESPECIALIDAD uno',
            'state' =>'1'
        ]);
        DB::table('specialties')->insert([
            'name' => 'ESPECIALIDAD dos',
            'description' => 'ESPECIALIDAD dos',
            'state' =>'1'
        ]);
        DB::table('specialties')->insert([
            'name' => 'ESPECIALIDAD tres',
            'description' => 'ESPECIALIDAD tres',
            'state' =>'1'
        ]);
        DB::table('specialties')->insert([
            'name' => 'ESPECIALIDAD cuatro',
            'description' => 'ESPECIALIDAD cuatro',
            'state' =>'1'
        ]);
        DB::table('specialties')->insert([
            'name' => 'ESPECIALIDAD cinco',
            'description' => 'ESPECIALIDAD cinco',
            'state' =>'1'
        ]);
    }
}
