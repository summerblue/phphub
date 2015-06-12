<?php namespace Phphub\Creators;

use Phphub\Forms\TopicCreationForm;
use Phphub\Core\CreatorListener;
use Phphub\Core\Robot;
use Topic;
use Auth;
use Carbon;
use Markdown;

class TopicCreator
{
    protected $form;

    public function __construct(TopicCreationForm $form)
    {
        $this->form = $form;
    }

    public function create(CreatorListener $observer, $data)
    {
        $data['user_id'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        $markdown = new Markdown;
        $data['body_original'] = $data['body'];
        $data['body'] = $markdown->convertMarkdownToHtml($data['body']);
        $data['excerpt'] = Topic::makeExcerpt($data['body']);

        // Validation
        $this->form->validate($data);

        $topic = Topic::create($data);
        if (! $topic) {
            return $observer->creatorFailed($topic->getErrors());
        }

        Auth::user()->increment('topic_count', 1);

        Robot::notify($data['body_original'], 'Topic', $topic, Auth::user());

        return $observer->creatorSucceed($topic);
    }
}
