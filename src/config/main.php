<?php

use actions\AuthAction;
use actions\LogoutAction;
use actions\PhoneBookAction;
use actions\RegisterAction;

return [
    'routes' => [
        '/auth' => [
            'action' => AuthAction::class,
        ],
        '/register' => [
            'action' => RegisterAction::class,
        ],
        '/' => [
            'action' => PhoneBookAction::class,
        ],
        '/phone-book' => [
            'action' => PhoneBookAction::class,
        ],
        '/logout' => [
            'action' => LogoutAction::class,
        ],
    ],
];
