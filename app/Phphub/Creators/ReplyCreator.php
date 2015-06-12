<?php namespace Phphub\Creators;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Phphub\Core\Robot;
use Phphub\Notification\Mention;
use Phphub\Notification\Notifier;
use Reply;
use Auth;
use Topic;
use Notification;
use Carbon;
use App;
use Markdown;
use Slack;

class ReplyCreator
{
    protected $form;
    protected $mentionParser;

    public function __construct(ReplyCreationForm $form, Mention $mentionParser)
    {
        $this->form = $form;
        $this->mentionParser = $mentionParser;
    }

    public function create(CreatorListener $observer, $data)
    {
        $data['user_id'] = Auth::id();
        $data['body'] = $this->mentionParser->parse($data['body']);

        $markdown = new Markdown;
        $data['body_original'] = $data['body'];
        $data['body'] = $markdown->convertMarkdownToHtml($data['body']);

        // Validation
        $this->form->validate($data);

        $reply = Reply::create($data);
        if (! $reply) {
            return $observer->creatorFailed($reply->getErrors());
        }

        // Add the reply user
        $topic = Topic::find($data['topic_id']);
        $topic->last_reply_user_id = Auth::id();
        $topic->reply_count++;
        $topic->updated_at = Carbon::now()->toDateTimeString();
        $topic->save();

        Auth::user()->increment('reply_count', 1);

        App::make('Phphub\Notification\Notifier')->newReplyNotify(Auth::user(), $this->mentionParser, $topic, $reply);

        Robot::notify($data['body_original'], 'Reply', $topic, Auth::user());

        return $observer->creatorSucceed($reply);
    }
}
