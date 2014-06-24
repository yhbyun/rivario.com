<?php

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';

    public function seoable()
    {
        return $this->morphTo();
    }
}
