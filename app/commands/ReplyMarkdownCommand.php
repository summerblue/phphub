<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ReplyMarkdownCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'reply:marked';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert the old body to markdown, and store the old body to body_original.';

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
        $replies = Reply::all();

        $markdown = new Markdown;

        $transfer_count = 0;
        $convert_count = 0;

        foreach ($replies as $reply) {
            if (empty($reply->body_original)) {
                // store the original data
                $reply->body_original = $reply->body;
                // convert to markdown
                $reply->body = $markdown->convertMarkdownToHtml($reply->body);
                $reply->save();
                $transfer_count++;
            } else {
                // convert to markdown
                $reply->body = $markdown->convertMarkdownToHtml($reply->body_original);
                $reply->save();
                $convert_count++;
            }
        }
        $this->info("Transfer old data count: " . $transfer_count);
        $this->info("Convert original to body count: " . $convert_count);
        $this->info("It's Done, have a good day.");
    }
}
