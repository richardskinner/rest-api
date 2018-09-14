<?php

return [
    'routes' => [
        '/token'  => [
            'controller' => 'Token',
            'method' => 'index',
            'request_method' => 'POST',
        ],
        '/reactor/exhaust/1' => [
            'controller' => 'Reactor',
            'method' => 'exhaust',
            'request_method' => 'DELETE',
        ],
        '/prisoner/leia' => [
            'controller' => 'Prisoner',
            'method' => 'leia',
            'request_method' => 'GET',
        ],
    ]
];