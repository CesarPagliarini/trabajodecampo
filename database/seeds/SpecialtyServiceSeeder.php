<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtyServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i = 1; $i <=5; $i++){
            DB::Table('specialty_services')->insert(['specialty_id' =>$i,'service_id' => 1]);
            DB::Table('specialty_services')->insert(['specialty_id' =>$i,'service_id' => 2]);
            DB::Table('specialty_services')->insert(['specialty_id' =>$i,'service_id' => 3]);
            DB::Table('specialty_services')->insert(['specialty_id' =>$i,'service_id' => 4]);
            DB::Table('specialty_services')->insert(['specialty_id' =>$i,'service_id' => 5]);
        }
    }
}
