<?php

use Faker\Factory as Faker;

class FavoritesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        $topics = Node::lists('id');

        foreach (range(1, 100) as $index) {
            Favorite::create([
                'user_id'      => 1,
                'topic_id'     => $faker->randomElement($topics)
            ]);
        }
    }
}
