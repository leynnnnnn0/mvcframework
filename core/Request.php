<?php

namespace app\core;

class Request
{
    public function getMethod(): string{
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUrl(): string
    {
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }

}