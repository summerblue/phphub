<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CacheAvatarsCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cache:avatars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Cache users' avatars to local. Example: php artisan cache:avatars --start=1 --end=5";

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
        $users = User::query();
        if ($start = $this->option('start')) {
            $users->where('id', '>=', $start);
        }
        if ($end = $this->option('end')) {
            $users->where('id', '<=', $end);
        }

        foreach ($users->get() as $user) {
            $this->info("Caching user: {$user->name}, id: {$user->id}");
            try {
                $user->cacheAvatar();
                $this->info("Cache {$user->name}'s avatar success.\n");
            } catch (Exception $e) {
                $this->error("Cache {$user->name}'s avatar failed.");
                $this->error($e->getMessage());
                $this->info("\n");
            }
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('start', null, InputOption::VALUE_REQUIRED, 'The start user id', null),
            array('end', null, InputOption::VALUE_REQUIRED, 'The end user id', null),
        );
    }
}
