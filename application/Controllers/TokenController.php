<?php

namespace Application\Controllers;

class TokenController extends BaseController
{
    public function index()
    {
        if ($token = $this->oauth->getToken($_REQUEST['client_id'], $_REQUEST['client_secret'])) {
            $this->resource->create([
                'access_token' => $token,
                'expires_in' => 99999999999,
                'token_type' => '',
                'scope' => 'TheForce',
            ])->resolve();
        }

        $this->resource->create([
            'code' => 1024,
            'message' => 'Validation Failed',
            'description' => 'The credentials provided do not match any in R2D2\'s database.',
        ])->resolve();
    }
}