<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('buses')->insert([
                'name' => $faker->name,
                'ic_no' => $faker->randomNumber(8, true), // 8-digit integer for IC number
                'student_id' => 'STU' . $faker->unique()->randomNumber(5, true), // Unique student ID
                'departure_date' => $faker->dateTimeBetween('+1 week', '+1 month')->format('Y-m-d'),
                'pickup_point' => $faker->city,
                'destination' => $faker->city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
