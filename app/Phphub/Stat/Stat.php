<?php namespace Phphub\Stat;

use Topic, Reply, User, Cache;

class Stat
{
    const SITE_CACHE_KEY     = 'site_stat';
    const SITE_CACHE_MINUTES = 60;

    public function getSiteStat()
    {
        return Cache::remember(self::SITE_CACHE_KEY, self::SITE_CACHE_MINUTES, function()
        {
            $entity = new StatEntity();
            $entity->topic_count = Topic::count();
            $entity->reply_count = Reply::count();
            $entity->user_count  = User::count();
            return $entity;
        });
    }
}