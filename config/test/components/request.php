<?php

use Da\Config\Configuration;

return [
    'cookieValidationKey' => Configuration::env()->get('APP_COOKIE_VALIDATION_KEY'),

    'enableCsrfValidation' => false,

    // but if you absolutely need it set cookie domain to localhost
    /*
    'csrfCookie' => [
        'domain' => 'localhost',
    ],
    */
];
