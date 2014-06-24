<?php

class Tag extends \Eloquent
{
    protected $fillable = [];

    public function lessons()
    {
        return $this->belongsToMany('Lesson');
    }

    public function seo()
    {
        return $this->morphMany('Seo', 'seoable');
    }
}
