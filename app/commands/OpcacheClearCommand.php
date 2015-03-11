<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class OpcacheClearCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'opcache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear PHP Opcode Cache.';

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
        if (function_exists('opcache_reset')) {
            opcache_reset();
            $this->info("Done Clear PHP Opcode Cache, have a good day.");
        } else {
            $this->info("You haven't install PHP Opcode Cache yet, no need to run this command!");
        }
    }
}
