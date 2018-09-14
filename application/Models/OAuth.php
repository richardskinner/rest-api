<?php

namespace Application\Models;

use function DI\get;

class OAuth
{
    public function getToken($id, $secret)
    {
        if (getenv('OAUTH_CLIENT_ID') === $id && getenv('OAUTH_CLIENT_SECRET') === $secret) {
            return getenv('OAUTH_TOKEN');
        }

        return false;
    }
}