<?php

use actions\AddContactAction;
use actions\AuthAction;
use actions\ContactEditAction;
use actions\ContactInfoAction;
use actions\DeleteContactAction;
use actions\GetContactFormAction;
use actions\LogoutAction;
use actions\PhoneBookAction;
use actions\RegisterAction;

return [
    'db' => [
        'root_password' => 'root',
        'database' => 'phonebook',
        'user' => 'phonebook',
        'password' => 'root',
        'port' => '3306',
        'host' => '127.0.0.1:3306',
    ],
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
        '/contact-info' => [
            'action' => ContactInfoAction::class,
        ],
        '/get-contact-form' => [
            'action' => GetContactFormAction::class
        ],
        '/add-contact' => [
            'action' => AddContactAction::class,
        ],
        '/edit-contact' => [
            'action' => ContactEditAction::class,
        ],
        '/delete-contact' => [
            'action' => DeleteContactAction::class,
        ],
        '/logout' => [
            'action' => LogoutAction::class,
        ],
    ],
];
