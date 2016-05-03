<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            User::create([
                'github_id'        => $index,
                'github_url'       => $faker->url(),
                'city'             => $faker->city(),
                'name'             => $faker->userName(),
                'github_name'      => $faker->userName(),
                'twitter_account'  => $faker->userName(),
                'company'          => $faker->userName(),
                'personal_website' => $faker->url(),
                'avatar'           => $faker->url(),
                'signature'        => $faker->sentence(),
                'introduction'      => $faker->sentence(),
                'email'            => $faker->email(),
            ]);
        }
    }
}
