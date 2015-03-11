<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TopicMakeExcerptCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'topic:excerpt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the old topic to have a excerpt.';

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
        $topics = Topic::all();
        $transfer_count = 0;

        foreach ($topics as $topic) {
            if (empty($topic->excerpt)) {
                $topic->excerpt = Topic::makeExcerpt($topic->body);
                $topic->save();
                $transfer_count++;
            }
        }
        $this->info("Transfer old data count: " . $transfer_count);
        $this->info("It's Done, have a good day.");
    }
}
