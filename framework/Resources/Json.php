<?php

namespace Framework\Resources;


class Json implements Resource
{
    private $resource;

    public function __construct(array $resource = array())
    {
        $this->resource = $resource;
    }

    public function resolve()
    {
        header('Content-Type: application/json');
        echo json_encode($this->resource);
        exit;
    }
}