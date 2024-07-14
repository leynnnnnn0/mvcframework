<?php

namespace app\core;

use app\constants\FormError;

abstract class Model
{
    public array $errors = [];

    public function getFirstError($key)
    {
        return $this->errors[$key][0];
    }


    public function loadData($data): void
    {
        foreach($data as $key => $value)
        {
            if(property_exists($this, $key))
            {
                $this->$key = $value;
            }
        }
    }
    public function validate($data): bool
    {
        foreach ($data as $key => $property) {
            $value = $property;
            $check = $this->errors()[$key];
            foreach($check as $error)
            {
                $errorName = $error;
                if(is_array($errorName))
                {
                    $errorName = $errorName[0];
                }

                if($errorName === FormError::REQUIRED && !$value)
                {
                    $this->errors[$key][] = "This field is required";
                }
                if($errorName === FormError::INVALID_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->errors[$key][] = "This email is not valid";
                }
                if($errorName === FormError::MIN && strlen($value) < $error['min'])
                {
                    $this->errors[$key][] = str_replace('num', $error['min'], "Password should contain at least num characters");
                }
                if($errorName === FormError::MATCHED && $value !== $this->{'password'})
                {
                    $this->errors[$key][] = "Password does not match";
                }

            }
        }
        return empty($this->errors);
    }

    abstract function errors() : array;
}