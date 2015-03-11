<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RepliesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        $users = User::lists('id');
        $topics = Topic::lists('id');

        foreach (range(1, 500) as $index) {
            Reply::create([
                'user_id' => $faker->randomElement($users),
                'topic_id' => $faker->randomElement($topics),
                'body'   => $faker->sentence(),
            ]);
        }

        foreach (range(1, 60) as $index) {
            Reply::create([
                'user_id' => 1,
                'topic_id' => $faker->randomElement($topics),
                'body'   => $faker->sentence(),
            ]);
        }
    }
}
