<?php

View::name('layouts.master', 'layout');
$layout = View::of('layout');

View::name('layouts.slide', 'slide');
$slide = View::of('slide');

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

Route::controller('eloquent', 'EloquentController');
Route::controller('campaign', 'CampaignsController');
Route::controller('former', 'FormerController');
Route::resource('videos', 'VideosController');
Route::resource('api/persons', 'API\PersonsController');

Route::get('endpage', array('as' => 'endpage.index', function () use ($layout) {
    return $layout->nest('content', 'endpage.index');
}));

Route::get('slide/gulp', array('as' => 'slide.gulp', function () use ($slide) {
    return $slide->nest('content', 'slide.gulp');
}));

Route::get('slide/atom-shell', array('as' => 'slide.atom-shell', function () use ($slide) {
    return $slide->nest('content', 'slide.atom-shell');
}));
