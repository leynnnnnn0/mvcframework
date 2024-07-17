<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Session;
use app\model\LoginForm;
use app\model\User;

class AuthController extends Controller
{
    public function login()
    {
        $loginForm = new LoginForm();
        if(Application::$app->request->getMethod() === 'POST')
        {
            $loginForm->loadData($_POST);
            if($loginForm->validate($_POST) && $loginForm->login())
            {
                Application::$app->response->redirect('/');
            }
            $this->setLayout("auth");
            return $this->render('login', ['model' => $loginForm]);
        }
        $this->setLayout("auth");
        return $this->render('login', ['model' => $loginForm]);
    }

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/login');
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
                Application::$app->session::set_flash('success', 'Account Created.');
                Application::$app->response->redirect('/');
            }
            $this->setLayout("auth");
            return $this->render('register', ['model' => $registerModel]);
        }
        $registerModel= new User();
        $this->setLayout("auth");
        return $this->render('register', ['model' => $registerModel]);
    }
}