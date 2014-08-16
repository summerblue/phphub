<?php

use Faker\Factory as Faker;

class TopicsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
        $users = User::lists('id');
        $nodes = Node::lists('id');

		foreach(range(1, 50) as $index)
		{
			Topic::create([
				'user_id' => $faker->randomElement($users),
				'node_id' => $faker->randomElement($nodes),
				'title'   => $faker->sentence(),
				'body'    => $faker->text()
			]);
		}

		foreach(range(1, 50) as $index)
		{
			Topic::create([
				'user_id'      => $faker->randomElement($users),
				'node_id'      => $faker->randomElement($nodes),
				'title'        => $faker->sentence(),
				'body'         => $faker->text(),
				'is_excellent' => true
			]);
		}

		foreach(range(1, 30) as $index)
		{
			Topic::create([
				'user_id'      => $faker->randomElement($users),
				'node_id'      => $faker->randomElement($nodes),
				'title'        => $faker->sentence(),
				'body'         => $faker->text(),
				'is_wiki' => true
			]);
		}

		foreach(range(1, 100) as $index)
		{
			Topic::create([
				'user_id'      => 1,
				'node_id'      => $faker->randomElement($nodes),
				'title'        => $faker->sentence(),
				'body'         => $faker->text(),
				'is_wiki' => true
			]);
		}
	}

}