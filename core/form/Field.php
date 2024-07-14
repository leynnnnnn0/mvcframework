<?php

namespace app\core\form;
use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public string $type;
    public Model $model;
    public string $attribute;

    function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString(): string
    {
        return sprintf
        ('<div class="mb-3">
                    <label for="%s">%s</label>
                         <input
                                type="%s"
                                class="form-control"
                                id="%s"
                                name="%s"
                                value="%s"
                                />
                        <p class="text-danger">%s</p>
                    </div>',
            $this->attribute,
            $this->attribute,
            $this->type,
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField(): Field
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailField(): Field
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
}