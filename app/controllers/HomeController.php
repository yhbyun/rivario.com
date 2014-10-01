<?php

class HomeController extends BaseController
{

    public function getIndex()
    {
        $this->view('home.index');
    }
}
