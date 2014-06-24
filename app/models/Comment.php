<?php

class Comment extends Eloquent
{
    // let eloquent know that these attributes will be available for mass assignment
    protected $fillable = array('author', 'text');
}
