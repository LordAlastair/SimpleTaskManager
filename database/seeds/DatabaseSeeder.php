<?php

use Illuminate\Database\Seeder;
use App\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Task::truncate();
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 20; $i++){
            Task::create([
                'name' =>  'Awesome job task ' . $i,
                'price' =>  $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 8),
                'deadline' => $faker->dateTimeBetween($startDate = '-1 days', $endDate = '+10 days', $timezone = 'UTC -3'),
                'done' => $faker->boolean($chanceOfGettingTrue = 75),
                'presentation_order' => $i
            ]);
        }
    }
}
