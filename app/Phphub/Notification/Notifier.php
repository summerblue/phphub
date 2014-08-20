<?php namespace Phphub\Notification;

use Phphub\Forms\ReplyCreationForm;
use Phphub\Core\CreatorListener;
use Phphub\Notification\Mention;
use Reply, Auth, Topic, Notification, Carbon, User;

class Notifier
{
    public $notifiedUsers = [];

    public function notify(User $fromUser, Mention $mentionParser, Topic $topic, Reply $reply)
    {
        // 通知帖子作者
        Notification::batchNotify(
                    'new_reply', 
                    $fromUser, 
                    $this->removeDuplication([$topic->user]),
                    $topic, 
                    $reply);

        // 关注此贴的用户也提醒下
        Notification::batchNotify(
                    'attention', 
                    $fromUser, 
                    $this->removeDuplication($topic->attentedBy),
                    $topic, 
                    $reply);
        
        // 如果有 "@" 某个用户的话, 一并通知
        Notification::batchNotify(
                    'at', 
                    $fromUser, 
                    $this->removeDuplication($mentionParser->users), 
                    $topic, 
                    $reply);
    }

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