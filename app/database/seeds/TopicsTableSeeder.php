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
				'user_id'    => $faker->randomElement($users),
				'node_id'    => $faker->randomElement($nodes),
				'title'      => $faker->sentence(),
				'body'       => $faker->text(),
				'created_at' => Carbon::now()->toDateTimeString(),
				'updated_at' => Carbon::now()->toDateTimeString(),
			]);
		}

		foreach(range(1, 50) as $index)
		{
			Topic::create([
				'user_id'      => $faker->randomElement($users),
				'node_id'      => $faker->randomElement($nodes),
				'title'        => $faker->sentence(),
				'body'         => $faker->text(),
				'is_excellent' => true,
				'created_at'   => Carbon::now()->toDateTimeString(),
				'updated_at'   => Carbon::now()->toDateTimeString(),
			]);
		}

		foreach(range(1, 30) as $index)
		{
			Topic::create([
				'user_id'    => $faker->randomElement($users),
				'node_id'    => $faker->randomElement($nodes),
				'title'      => $faker->sentence(),
				'body'       => $faker->text(),
				'is_wiki'    => true,
				'created_at' => Carbon::now()->toDateTimeString(),
				'updated_at' => Carbon::now()->toDateTimeString(),
			]);
		}

		foreach(range(1, 100) as $index)
		{
			Topic::create([
				'user_id'    => 1,
				'node_id'    => $faker->randomElement($nodes),
				'title'      => $faker->sentence(),
				'body'       => $faker->text(),
				'created_at' => Carbon::now()->toDateTimeString(),
				'updated_at' => Carbon::now()->toDateTimeString(),
			]);
		}
	}

}