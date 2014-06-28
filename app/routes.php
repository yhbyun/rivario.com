<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

Route::controller('eloquent', 'EloquentController');
Route::controller('campaign', 'CampaignsController');
Route::controller('former', 'FormerController');

