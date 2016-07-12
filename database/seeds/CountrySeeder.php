<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker\Factory::create();
        for($i = 0; $i < 10; $i++) {
            DB::table('country')->insert(['Name' => $faker->country]);
        }
        // $this->call('UsersTableSeeder');
    }
}
