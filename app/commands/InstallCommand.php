<?php

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Config\EnvironmentVariables;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'phphub:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatic install phphub: npm, gulp, migration etc.';

     /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $welcome = <<<EOT
	______                            _              _                                     _
	| ___ \                          | |            | |                                   | |
	| |_/ /___ __      __ ___  _ __  | |__   _   _  | |      __ _  _ __  __ _ __   __ ___ | |
	|  __// _ \\ \ /\ / // _ \| '__| | '_ \ | | | | | |     / _` || '__|/ _` |\ \ / // _ \| |
	| |  | (_) |\ V  V /|  __/| |    | |_) || |_| | | |____| (_| || |  | (_| | \ V /|  __/| |
	\_|   \___/  \_/\_/  \___||_|    |_.__/  \__, | \_____/ \__,_||_|   \__,_|  \_/  \___||_|
	                                          __/ |
	                                         |___/
	  ========================================================
	                                           phphub.org
EOT;

        $this->info($welcome);
            
        //force to local env.
        $this->laravel['env'] = 'local';

        //check env templates
        $this->info('1. Check Env Templates..');
        $this->checkEnvTemplates();
        $this->line('----------------------');

        // run install
        if (function_exists('system')) {
            $this->info('2. Running `npm install` ... Running on OS [' . PHP_OS . "] HostName [" . gethostname() . ']');

            $option = '';
            //check if is running on homestead
            if ('homestead' == gethostname()) {
                $option = ' --no-bin-links';
            }

            //npm install
            if (system('npm install' . $option)) {
                $this->info('npm packages installed.');
                $this->line('----------------------');
                $this->line('----------------------');
            } else {
                $this->error('npm install error');
            }

            //gulp task
            $this->info('3. Running `gulp build`...');
            if (system('gulp build')) {
                $this->info('Gulp Build Success ');
                $this->line('----------------------');
                $this->line('----------------------');
            } else {
                $this->error('gulp build error');
            }
            

            // mv .env.example.php to .env.local.php
            $this->info('4. Moving `.env.example.php` to `.env.local.php`');
            
            $envVariables = $this->getEnvFile();

            if ($this->files->move('.env.example.php', '.env.local.php')) {
                $this->info('Move Success!');
            } else {
                throw new Exception('Error while moving .env.example.php file');
            }

            //set datebase config to laravel config
            $this->laravel['config']['database.connections.mysql.database'] = $envVariables['DB_NAME'];
            $this->laravel['config']['database.connections.mysql.username'] = $envVariables['DB_USERNAME'];
            $this->laravel['config']['database.connections.mysql.password'] = $envVariables['DB_PASSWORD'];

            // migration && seed
            if ($this->confirm('Do you wish to migration? [yes|no]')) {
                // Migrate DB
                if (! Schema::hasTable('migrations')) {
                    $this->call('migrate');
                } else {
                    $this->error('A migrations table was found in database, No migrations will be run.');
                }

                // Seed
                if ($this->confirm('Do you wish to seed some fake data? [yes|no]')) {
                    $this->call('db:seed');
                }
            }
        } else {
            $this->line('Please run `npm install` and `gulp build` manually');
        }

        // Done
        $this->line('----------------------');
        $this->line('All Done. Enjoy Phphub!');
    }

    public function checkEnvTemplates()
    {
        if (!$this->files->exists('.env.example.php')) {
            throw new Exception("No `.env.example.php` found.");
        }
    }

    public function getEnvFile()
    {
        return $this->files->getRequire('.env.example.php');
    }
}
