<?php

namespace app\constants;

enum FormType: string
{
    case TEXT = "text";
    case PASSWORD = "password";
    case EMAIL = "email";
}