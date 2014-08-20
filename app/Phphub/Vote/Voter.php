<?php namespace Phphub\Vote;

use Reply, Auth, Topic, Vote, Carbon, User;

class Voter
{
    public $notifiedUsers = [];

    public function topicUpVote(Topic $topic)
    {
        if ($topic->votes()->ByWhom(Auth::user()->id)->WithType('upvote')->count()) 
        {
            // click twice for remove upvote
            $topic->votes()->ByWhom(Auth::user()->id)->WithType('upvote')->delete();
            $topic->decrement('vote_count', 1);
        }
        elseif ($topic->votes()->ByWhom(Auth::user()->id)->WithType('downvote')->count()) 
        {
            // user already clicked downvote once
            $topic->votes()->ByWhom(Auth::user()->id)->WithType('downvote')->delete();
            $topic->votes()->create(['user_id' => Auth::user()->id, 'is' => 'upvote']);
            $topic->increment('vote_count', 2);
        }
        else 
        {
            // first time click
            $topic->votes()->create(['user_id' => Auth::user()->id, 'is' => 'upvote']);
            $topic->increment('vote_count', 1);
        }
    }

    public function topicDownVote(Topic $topic)
    {
        if ($topic->votes()->ByWhom(Auth::user()->id)->WithType('downvote')->count()) 
        {
            // click second time for remove downvote
            $topic->votes()->ByWhom(Auth::user()->id)->WithType('downvote')->delete();
            $topic->increment('vote_count', 1);
        }
        elseif ($topic->votes()->ByWhom(Auth::user()->id)->WithType('upvote')->count()) 
        {
            // user already clicked upvote once
            $topic->votes()->ByWhom(Auth::user()->id)->WithType('upvote')->delete();
            $topic->votes()->create(['user_id' => Auth::user()->id, 'is' => 'downvote']);
            $topic->decrement('vote_count', 2);
        }
        else 
        {
            // click first time
            $topic->votes()->create(['user_id' => Auth::user()->id, 'is' => 'downvote']);
            $topic->decrement('vote_count', 1);
        }
    }

}