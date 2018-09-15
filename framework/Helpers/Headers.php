<?php

namespace Framework\Helpers;

class Headers
{
    public $headers;

    public function __construct()
    {
        $this->headers = getallheaders();
    }

    public function getBearerToken()
    {
        $authorization = $this->headers['Authorization'];
        preg_match("/^Bearer:\s(.*)/", $authorization, $token);

        return isset($token[1]) ? $token[1] : null;
    }
}
