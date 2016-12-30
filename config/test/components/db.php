<?php

use SideKit\Config\ConfigKit;

return [

    /*
     * --------------------------------------------------------------------------
     * Connection
     * --------------------------------------------------------------------------
     *
     * Represents a connection to a database via PDO.
     */

    'class' => 'yii\db\Connection',

    'dsn' => ConfigKit::env()->get('DATABASE_DSN'),

    'username' => ConfigKit::env()->get('DATABASE_USER'),

    'password' => ConfigKit::env()->get('DATABASE_PASSWORD'),

    'charset' => ConfigKit::env()->get('DATABASE_CHARSET'),

    'tablePrefix' => ConfigKit::env()->get('DATABASE_TABLE_PREFIX'),
];
