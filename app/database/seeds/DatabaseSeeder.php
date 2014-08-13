<?php

class DatabaseSeeder extends Seeder {

	
    /**
     * @var array
     */
    protected $tables = [
        'users',
        'topics',
        'replies',
    ];

    /**
     * @var array
     */
    protected $seeders = [
        'UsersTableSeeder',
        'TopicsTableSeeder',
        'RepliesTableSeeder',
    ];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->cleanDatabase();

		foreach($this->seeders as $seedClass)
        {
            $this->call($seedClass);
        }
	}

    /**
     * Clean out the database
     */
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach($this->tables as $table)
        {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
