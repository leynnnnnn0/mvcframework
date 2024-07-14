<?php

namespace app\model;

use app\constants\FormError;
use app\core\Model;

class RegisterModel extends Model
{
    public string $email;
    public string $username;
    public string $password;
    public string $confirmPassword;

    function errors() : array
    {
        return [
            'username' => [FormError::REQUIRED],
            'email' => [FormError::REQUIRED, FormError::INVALID_EMAIL],
            'password' => [FormError::REQUIRED, [FormError::MIN, 'min' => 8]],
            'confirmPassword' => [FormError::REQUIRED, FormError::MATCHED]
        ];
    }
}