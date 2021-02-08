<?php

use Da\Config\Configuration;
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

Configuration::app()
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

// Configuration::app()
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

Configuration::env()->load();

/*
 * --------------------------------------------------------------------------
 * Initialize constants required by Yii
 * --------------------------------------------------------------------------
 *
 * I cannot get rid of them. They are being used within core. Oh well...
 */

defined('YII_DEBUG') or define('YII_DEBUG', Configuration::env()->get('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', Configuration::env()->get('YII_ENV'));

/*
 * --------------------------------------------------------------------------
 * Register Yii and its class auto loader
 * --------------------------------------------------------------------------
 *
 * Why Yii autoloader must be here?
 *
 * Because when including Yii.php file it automatically injects BaseYii.php.
 * When that is happening, BaseYii.php registers YII_DEBUG and YII_ENV
 * constants, therefore not honouring their declaration above these lines.
 * - Thanks @jmper
 *
 * Yii also provides a high-performance class autoloader fully compliant with
 * the PSR-4 standard. When using the Yii autoloader together with other
 * autoloaders (Composer), you should include the Yii.php file after all other
 * autoloaders are installed. This will make the Yii autoloader the first one
 * responding to any class autoloading request.
 *
 * Note: If you do not want to use the Yii autoloader at all you will have to
 * create your very own version of Yii (see the file on 'vendor/yiisoft/yii2')
 * and include it in the script.
 */

require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
