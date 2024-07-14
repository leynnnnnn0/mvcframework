<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        if(Application::$app->request->getMethod() === 'POST')
        {
            return 'LOGIN FORM SUBMITTED';
        }
        $this->setLayout("auth");
        return $this->render('login');
    }

    public function register()
    {
        if(Application::$app->request->getMethod() === 'POST') {
            return 'REGISTRATION FORM SUBMITTED';
        }
        $this->setLayout("auth");
        return $this->render('register');
    }
}