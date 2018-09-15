<?php

namespace Application\Controllers;

class ReactorController extends BaseController
{
    public function exhaust($id)
    {
        if ($this->oauth->checkToken($this->headers->getBearerToken())) {
            $this->resource->create([
                'code' => 0,
                'message' => "Deletion Successful"
            ])->resolve();
        }

        $this->resource->create([
            'code' => 1175,
            'message' => 'Deletion Failed',
            'description' => 'Your attempt to delete the reactor has failed.',
        ])->resolve();
    }
}
