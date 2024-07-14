<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($method = "GET", $action = "") : Form
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end() : string
    {
        return '</form>';
    }

    public function field(Model $model, $attribute): Field
    {
        return new Field($model, $attribute);
    }
}