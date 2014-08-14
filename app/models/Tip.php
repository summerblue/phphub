<?php

class Tip extends \Eloquent 
{
	const SITE_CACHE_KEY = 'site_tips';
	const SITE_CACHE_MINUTES = 1440;

	protected $fillable = ['body'];

	public static function getRandTip()
	{
		$tips =  Cache::remember(self::SITE_CACHE_KEY, self::SITE_CACHE_MINUTES, function()
        {
            return Tip::all();
        });

        return $tips->random();
	}

}