<?php

use Da\Config\Configuration;

return [
    'cookieValidationKey' => Configuration::env()->get('APP_COOKIE_VALIDATION_KEY'),
];
