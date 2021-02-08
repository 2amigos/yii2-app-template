<?php

use Da\Config\Configuration;

return [

    /*
     * --------------------------------------------------------------------------
     * Connection
     * --------------------------------------------------------------------------
     *
     * Represents a connection to a database via PDO.
     */

    'class' => 'yii\db\Connection',

    'dsn' => Configuration::env()->get('DATABASE_DSN'),

    'username' => Configuration::env()->get('DATABASE_USER'),

    'password' => Configuration::env()->get('DATABASE_PASSWORD'),

    'charset' => Configuration::env()->get('DATABASE_CHARSET'),

    'tablePrefix' => Configuration::env()->get('DATABASE_TABLE_PREFIX'),
];
