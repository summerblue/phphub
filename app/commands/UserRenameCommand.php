<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UserRenameCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'user:rename';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the user name. php artisan user:rename --id= --name=';

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
        $id = $this->option('id');
        $new_name = $this->option('name');

        App::make('Phphub\Forms\UserRenameForm')->validate(['name' => $new_name]);

        $user = User::find($id);
        $user->name = $new_name;
        $user->save();
        $this->info("It's Done, have a good day.");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('id', null, InputOption::VALUE_REQUIRED, 'The user id', null),
            array('name', null, InputOption::VALUE_REQUIRED, 'New name', null),
        );
    }
}
