<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function showName($name = "Bellen", $date = 27)
    {
        echo "My name is $name, born on $date";
    }
}
