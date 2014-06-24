<?php

class Post extends \Eloquent
{
    protected $fillable = [];

    public function author()
    {
        return $this->belongsTo('Author');
    }

    public function seo()
    {
        return $this->morphMany('Seo', 'seoable');
    }
}
