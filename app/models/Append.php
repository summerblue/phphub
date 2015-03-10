<?php

class Append extends \Eloquent
{
    protected $fillable = ['topic_id', 'content'];

    public function topic()
    {
        return $this->belongsTo('Topic');
    }
}
