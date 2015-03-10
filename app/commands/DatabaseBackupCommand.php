<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DatabaseBackupCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:cloudbackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database to the cloud.';

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
        $now = Carbon::now();
        $folder = $now->format('Y-m') . '/';
        $database = Config::get('database.connections.mysql.database');
        $subfix = '_' . $now->toDateTimeString() . '.sql';

        $filename = $folder . $database . $subfix;

        // database, destination, destinationPath, compression
        $this->call('db:backup', [
            '--database' => 'mysql',
            '--destination' => 'dropbox',
            '--destinationPath' => $filename,
            '--compression' => 'gzip',
        ]);
    }
}
