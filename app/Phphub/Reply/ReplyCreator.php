<?php namespace Phphub\Reply;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Phphub\Notification\Mention;
use Phphub\Notification\Notifier;
use Reply, Auth, Topic, Notification, Carbon, App;

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
        $data['user_id'] = Auth::user()->id;
        $data['body'] = $this->mentionParser->parse($data['body']);

        // Validation
        $this->form->validate($data);

        $reply = Reply::create($data);
        if ( ! $reply)
        {
            return $observer->creatorFailed($reply->getErrors());
        }

        // 话题最后回复的用户还有更新时间戳
        $topic = Topic::find($data['topic_id']);
        $topic->last_reply_user_id = Auth::user()->id;
        $topic->reply_count++;
        $topic->updated_at = Carbon::now()->toDateTimeString();
        $topic->save();

        Auth::user()->increment('reply_count', 1);

        App::make('Phphub\Notification\Notifier')->notify(Auth::user(), $this->mentionParser, $topic, $reply);

        return $observer->creatorSucceed($reply);
    }
}
