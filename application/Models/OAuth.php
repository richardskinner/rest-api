<?php

namespace Application\Models;

use function DI\get;

class OAuth
{
    public function authenticate($id, $secret)
    {
        if (getenv('OAUTH_CLIENT_ID') === $id && getenv('OAUTH_CLIENT_SECRET') === $secret) {
            return getenv('OAUTH_TOKEN');
        }

        return false;
    }

    public function checkToken($token)
    {
        if (getenv('OAUTH_TOKEN') === $token) {
            return true;
        }

        return false;
    }
}
