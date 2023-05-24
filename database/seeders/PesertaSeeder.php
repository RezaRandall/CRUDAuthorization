<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()//: void
    {
    	// insert data ke table peserta
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 20; $i++) {
            DB::table('peserta')->insert([
                'nama' => $faker->name,
                'email' => $faker->email,
                'xVal' => $faker->numberBetween(1,33),
                'yVal' => $faker->numberBetween(1,23),
                'zVal' => $faker->numberBetween(1,18),
                'wVal' => $faker->numberBetween(1,13),
                'aspek_intelegensi' => $faker->numberBetween(1,5),
                'aspek_numerical_ability' => $faker->numberBetween(1,5)
            ]);
        }
    }
}
