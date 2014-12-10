<?php

use Faker\Factory as Faker;

class PersonsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('persons')->delete();

        for ($i = 0; $i < 10; $i++) {
            Person::create(['name' => $faker->name, 'age' => $faker->randomNumber(2)]);
        }
    }
}
