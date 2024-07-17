<?php

namespace app\model;

use app\constants\FormError;
use app\core\DbModel;

class LoginForm extends DbModel
{
    public string $email = '';
    public string $password = '';

    function rules(): array
    {
        return [
            'email' => [FormError::REQUIRED, FormError::VALID_EMAIL],
            'password' => [FormError::REQUIRED],
        ];
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'email',
            'password'
        ];
    }


    public function login()
    {
        $user = $this->findUser(['email' => $this->email]);
        if(!$user)
        {
            $this->addError('email', 'Could not find this account');
            return false;
        }
        if(!password_verify($this->password, $user->password))
        {
            $this->addError('password', 'Incorrect Password');
            return false;
        }
        return true;

    }
}