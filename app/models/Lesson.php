<?php

class Lesson extends \Eloquent
{
    protected $fillable = [];

    public function tags()
    {
        return $this->belongsToMany('Tag');
    }
}
