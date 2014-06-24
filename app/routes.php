<?php

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

Route::controller('eloquent', 'EloquentController');
