<?php

/*
 * --------------------------------------------------------------------------
 * Register Composer class auto loader
 * --------------------------------------------------------------------------
 *
 * Composer is a tool for dependency management in PHP. It allows you to
 * declare the libraries your project depends on and it will manage
 * (install/update) them for you.
 */

require __DIR__ . '/../../bootstrap/autoload.php';

/*
 * --------------------------------------------------------------------------
 * Initialize SideKit library
 * --------------------------------------------------------------------------
 *
 * This step is required *prior* adding the application script.
 *
 */

require __DIR__ . '/../../bootstrap/sidekit-test.php';

/*
 * --------------------------------------------------------------------------
 * Initialize custom aliases
 * --------------------------------------------------------------------------
 *
 * Add custom aliases to the application. Added after sidekit to take
 * advantage of its loaded configuration values
 */

require __DIR__ . '/../../bootstrap/aliases.php';

/*
 * --------------------------------------------------------------------------
 * Return the configuration
 * --------------------------------------------------------------------------
 *
 * Add custom aliases to the application. Added after sidekit to take
 * advantage of its loaded configuration values
 */

use SideKit\Config\ConfigKit;

return ConfigKit::config()->build('test', ConfigKit::env()->get('CONFIG_USE_CACHE'));
