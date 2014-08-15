<?php namespace Phphub\Stat;

use Topic, Reply, User, Cache;

class Stat
{
    const CACHE_KEY     = 'site_stat';
    const CACHE_MINUTES = 60;

    public function getSiteStat()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_MINUTES, function()
        {
            $entity = new StatEntity();
            $entity->topic_count = Topic::count();
            $entity->reply_count = Reply::count();
            $entity->user_count  = User::count();
            return $entity;
        });
    }
}