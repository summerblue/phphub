<?php namespace Phphub\Notification;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Phphub\Notification\Mention;
use Reply, Auth, Topic, Notification, Carbon, User;

class Notifier
{
    public $notifiedUsers = [];

    public function newReplyNotify(User $fromUser, Mention $mentionParser, Topic $topic, Reply $reply)
    {
        // Notify the author
        Notification::batchNotify(
                    'new_reply',
                    $fromUser,
                    $this->removeDuplication([$topic->user]),
                    $topic,
                    $reply);

        // Notify attented users
        Notification::batchNotify(
                    'attention',
                    $fromUser,
                    $this->removeDuplication($topic->attentedBy),
                    $topic,
                    $reply);

        // Notify mentioned users
        Notification::batchNotify(
                    'at',
                    $fromUser,
                    $this->removeDuplication($mentionParser->users),
                    $topic,
                    $reply);
    }

    // in case of a user get a lot of the same notification
    public function removeDuplication($users)
    {
        $notYetNotifyUsers = [];
        foreach ($users as $user)
        {
            if (!in_array($user->id, $this->notifiedUsers))
            {
                $notYetNotifyUsers[] = $user;
                $this->notifiedUsers[] = $user->id;
            }
        }
        return $notYetNotifyUsers;
    }
}
