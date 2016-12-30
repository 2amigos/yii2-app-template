<?php

use SideKit\Config\ConfigKit;
use yii\web\Application;
use App\Configuration\ConfigurationBuilder;

/*
 * --------------------------------------------------------------------------
 * Initialize SideKit
 * --------------------------------------------------------------------------
 *
 * SideKit helps to organize our project the way we want. It orchestrates
 * the configuration in the architecture and provides extra functionality
 * missing on Yii.
 *
 * Test file requires a different approach. It requires to forcely load
 * (override) any environment variables. The only way to ensure is by calling
 * overload.
 */

$root = dirname(__DIR__);

$builder = (new ConfigurationBuilder())->useDirectory($root . DIRECTORY_SEPARATOR . 'config');

ConfigKit::config()
    ->useConfigurationBuilder($builder)
    ->useRootPath($root);

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

ConfigKit::env()->loadEnvironmentFrom('.env.test')->overload();

/*
 * --------------------------------------------------------------------------
 * Create Yii test web application
 * --------------------------------------------------------------------------
 *
 * Grab the configuration for the 'web' application and initialize an
 * Application instance with it. Remember that the file 'sidekit.php' has to
 * be *required* prior inserting this script so we can access the environment
 * variables.
 */

$config = ConfigKit::config()->build('test', ConfigKit::env()->get('CONFIG_USE_CACHE'));

$app = new Application($config);

/*
 * --------------------------------------------------------------------------
 * Return application
 * --------------------------------------------------------------------------
 *
 * Return instance to calling script, that way we separate initialization
 * processes and liberate the entry script with too much code.
 */

return $app;
