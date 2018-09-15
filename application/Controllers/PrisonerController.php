<?php

namespace Application\Controllers;

class PrisonerController extends BaseController
{
    public function leia()
    {
        if ($this->oauth->checkToken($this->headers->getBearerToken())) {;
            $this->resource->create([
                'cell' => $this->BinaryConverter->translate('01000011 01100101 01101100 01101100 00100000 00110010 00110001 00111000 00110111'),
                'block' => $this->BinaryConverter->translate('01000100 01100101 01110100 01100101 01101110 01110100 01101001 01101111 01101110 00100000 01000010 01101100 01101111 01100011 01101011 00100000 01000001 01000001 00101101 00110010 00110011 00101100')
            ])->resolve();
        }

        $this->resource->create([
            'code' => 2018,
            'message' => 'No Prisoner',
            'description' => 'No prisoner exists.',
        ])->resolve();
    }
}
