<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 12; $i++) {
            Event::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'times_taken_daily' => 3,
                'has_taken_medication' => $faker->boolean,
                'note' => $faker->paragraph(1),
                'date' => $faker->date(),
                'time' => $faker->time('h:i:s')
            ]);
        }
    }
}
