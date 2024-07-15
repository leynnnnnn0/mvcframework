<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\model\User;

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
            $registerModel = new User();
            // Create a model for the submitted data
            $registerModel->loadData($_POST);
            // validate the data
            if($registerModel->validate($registerModel) && $registerModel->insertAndSave())
            {
                return 'REGISTER FORM SUBMITTED';
            }
            $this->setLayout("auth");
            return $this->render('register', ['model' => $registerModel]);
        }
        $registerModel= new User();
        $this->setLayout("auth");
        return $this->render('register', ['model' => $registerModel]);
    }
}