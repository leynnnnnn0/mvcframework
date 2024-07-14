<?php

namespace app\controller;
use app\core\Controller;

class SiteController extends Controller
{
    public function home()
    {
        $params = ["name" => "Nathaniel"];
        return $this->render('home', $params);
    }
    public function contact()
    {
        return $this->render('contact');
    }
}