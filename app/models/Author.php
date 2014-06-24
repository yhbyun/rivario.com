<?php

class Author extends \Eloquent
{
    protected $fillable = ['name', 'email'];

    public function posts()
    {
        return $this->hasMany('Post');
    }
}
