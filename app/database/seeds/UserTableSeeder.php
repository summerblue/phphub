<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 50) as $index)
		{
			User::create([
                'github_id' => $index,
                'github_url' => $faker->url(),
                'name' => $faker->userName(),
                'email' => $faker->email(),
			]);
		}
	}

}