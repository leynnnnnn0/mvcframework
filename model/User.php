<?php

namespace app\model;

use app\constants\FormError;
use app\core\UserModel;

class User extends UserModel
{
    public string $email = '';
    public string $username = '';
    public string $password = '';
    public string $confirmPassword = '';

    function rules() : array
    {
        return [
            'username' => [FormError::REQUIRED],
            'email' => [FormError::REQUIRED, FormError::VALID_EMAIL, [FormError::UNIQUE, 'class' => self::class]],
            'password' => [FormError::REQUIRED, [FormError::MIN, 'min' => 8]],
            'confirmPassword' => [FormError::REQUIRED, FormError::MATCHED]
        ];
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'username',
            'email',
            'password'
        ];
    }

    function getPrimaryKey(): string
    {
        return 'id';
    }
}