<?php

use SideKit\Config\ConfigKit;

return [
    'cookieValidationKey' => ConfigKit::env()->get('APP_COOKIE_VALIDATION_KEY'),
];
