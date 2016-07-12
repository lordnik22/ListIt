<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker\Factory::create();
        for($i = 0; $i < 20; $i++) {
            DB::table('region')->insert(['Name' => $faker->state, 'CountryID' => $this->randomCountry()->ID ]);
        }
    }
    
    private function randomCountry() {
        $countries = DB::table('country')->get();
        return $countries[mt_rand() % count($countries)];
    }
}