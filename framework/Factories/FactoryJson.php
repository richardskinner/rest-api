<?php

namespace Framework\Factories;


use Framework\Resources\Json;

class FactoryJson
{
    public function create(array $resource = array())
    {
        return new Json($resource);
    }
}