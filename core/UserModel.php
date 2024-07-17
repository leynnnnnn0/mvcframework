<?php

namespace app\core;

abstract class UserModel extends DbModel
{
    abstract function getPrimaryKey(): string;
}