<?php namespace Phphub\Core;

use Slack;

class Robot
{
    public static function notify($content, $type, $topic, $user)
    {
        if (!getenv('slack_endpoint'))
        {
            return;
        }

        $topic_link = '<' . route('topics.show', $topic->id) .'|'. $topic->title .'>';
        $user_link = '<' . route('users.show', $user->id) .'|'. $user->name .'>';

        switch ($type) {
            case 'Reply':
                    $message = 'New Reply Created, for Topic: '. $topic_link .',  by User: '. $user_link;
                break;

            case 'Topic':
                    $message = 'New Topic Created, Title: '. $topic_link .',  by User: '. $user_link;
                break;
        }

        Slack::attach([
            'fallback'  => $message,
            'text'      => $content,
            'color'     => '#F0C49C',
            'mrkdwn_in' => ['text']
        ])->send($message);
    }
}
