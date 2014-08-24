<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TopicMarkdownConvertionCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'topic:marked';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Covert the old body to markdown, and store the old body to body_original.';

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

        $markdown = new Markdown;
        foreach ($topics as $topic) {
            if (empty($topic->body_original))
            {
                // store the original data
                $topic->body_original = $topic->body;
                // convert to markdown
                $topic->body = $markdown->convertMarkdownToHtml($topic->body);

                $topic->save();
            }
        }
        $this->info("It's Done, have a good day.");

	}
}
