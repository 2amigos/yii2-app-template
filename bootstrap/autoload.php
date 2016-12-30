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

require __DIR__ . '/../vendor/autoload.php';

/*
 * --------------------------------------------------------------------------
 * Register Yii and its class auto loader
 * --------------------------------------------------------------------------
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

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
