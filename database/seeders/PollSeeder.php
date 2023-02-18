<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Poll;
use App\Models\Option;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++){
            $poll = new Poll([
                'poll_description' => $faker->sentence,
                'views' => rand(0, 100),
            ]);

            $poll->save();

            for($j = 0; $j < rand(2, 6); $j++){
                $option = new Option([
                    'option_description' => $faker->sentence,
                    'qty' => rand(0, 100),
                ]);

                $poll->options()->save($option);
            }

        }
    }
}
