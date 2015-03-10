<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UserMigrateGithubUsernameCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:github_name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Migrate the old user's github_name ";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $users = User::where('github_name', '')->get();

        foreach ($users as $user) {
            $user->github_name = $user->name;
            $user->save();
        }
        $this->info("It's Done, have a good day.");
    }
}
