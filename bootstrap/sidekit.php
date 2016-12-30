<?php

use SideKit\Config\ConfigKit;
use App\Configuration\ConfigurationBuilder;

/*
 * --------------------------------------------------------------------------
 * Initialize SideKit
 * --------------------------------------------------------------------------
 *
 * SideKit helps to organize our project the way we want. It orchestrates
 * the configuration in the architecture and provides extra functionality
 * missing on Yii.
 */

$root = dirname(__DIR__);

/*
 * Add specific builder for this type of configuration.
 */

$builder = new ConfigurationBuilder();

ConfigKit::config()
    ->useConfigurationBuilder($builder)
    ->useRootPath($root);

/*
 * --------------------------------------------------------------------------
 * Custom architecture
 * --------------------------------------------------------------------------
 *
 * By default SideKit has the following settings. The following is an example
 * to show you that you can actually modify your folder architecture as long
 * as the following is specified.
 */

// ConfigKit::config()
//    ->useConfigurationBuilder($builder)
//    ->useRootPath($root)
//    ->useBasePath($root . '/app')
//    ->useConfigPath($root . '/config')
//    ->useEnvConfigPath($root . '/config/env')
//    ->useRuntimePath($root . '/runtime')
//    ->useVendorPath($root . '/vendor');

/*
 * --------------------------------------------------------------------------
 * Load environment variables
 * --------------------------------------------------------------------------
 *
 * The project should only hold data related to the development. Production
 * information should never *ever* be in projects when deploying to production.
 * Backend instructions should be in place in our production servers to have
 * the appropriate .env file in the path specified in SideKit.
 */

ConfigKit::env()->load();

/*
 * --------------------------------------------------------------------------
 * Initialize constants required by Yii
 * --------------------------------------------------------------------------
 *
 * I cannot get rid of them. They are being used within core. Oh well...
 */

defined('YII_DEBUG') or define('YII_DEBUG', ConfigKit::env()->get('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', ConfigKit::env()->get('YII_ENV'));
