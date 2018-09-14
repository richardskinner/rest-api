<?php

namespace Application\Controllers;

use Framework\Factories\FactoryJson;
use Application\Models\OAuth;

class BaseController
{
    public $resource;
    public $oauth;

    public function __construct(FactoryJson $factoryJson, OAuth $OAuth)
    {
        $this->resource = $factoryJson;
        $this->oauth = $OAuth;
    }
}
