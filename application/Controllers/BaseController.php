<?php

namespace Application\Controllers;

use Framework\Factories\FactoryJson;
use Application\Models\OAuth;
use Framework\Helpers\Headers;
use Framework\Services\BinaryConverter;

class BaseController
{
    public $resource;
    public $oauth;

    public function __construct(FactoryJson $factoryJson, OAuth $OAuth, Headers $headers, BinaryConverter $binaryConverter)
    {
        $this->resource = $factoryJson;
        $this->oauth = $OAuth;
        $this->headers = $headers;
        $this->BinaryConverter = $binaryConverter;
    }
}
