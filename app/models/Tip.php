<?php

class Tip extends \Eloquent
{
    const CACHE_KEY = 'site_tips';
    const CACHE_MINUTES = 1440;

    protected $fillable = ['body'];

    public static function getRandTip()
    {
        $tips =  Cache::remember(self::CACHE_KEY, self::CACHE_MINUTES, function () {
            return Tip::all();
        });

        return $tips->random();
    }
}
