<?php

namespace Database\Seeders;

use App\Models\Representative;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepresentativesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('representatives')->count() == 0){

            DB::table('representatives')->insert([
                [
                    'name'=> 'osama',
                    'code' => '7',
                    'created_at' =>now(),
                    'updated_at' =>now(),

                ],
                [
                    'name'=> 'khalid',
                    'code' => '8',
                    'created_at' =>now(),
                    'updated_at' =>now(),

                ],
                [
                    'name'=> 'hamdey',
                    'code' => '105',
                    'created_at' =>now(),
                    'updated_at' =>now(),

                ],
                [
                    'name'=> 'abdo',
                    'code' => '106',
                    'created_at' =>now(),
                    'updated_at' =>now(),

                ],
                [
                    'name'=> 'michael',
                    'code' => '110',
                    'created_at' =>now(),
                    'updated_at' =>now(),

                ],
                [
                    'name' => 'protection',
                    'proto',
                    'created_at' =>now(),
                    'updated_at' =>now(),

                ],
           ] );

        }

    }
}
