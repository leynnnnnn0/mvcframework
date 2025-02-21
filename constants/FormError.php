<?php

namespace app\constants;

enum FormError
{
    case REQUIRED;
    case MAX;
    case MIN;
    case VALID_EMAIL;
    case MATCHED;
    case UNIQUE;
}