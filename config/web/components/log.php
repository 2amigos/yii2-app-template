<?php

use SideKit\Config\ConfigKit;

return [

    'traceLevel' => ConfigKit::env()->get('YII_TRACE_LEVEL'),

    /*
     * --------------------------------------------------------------------------
     * Log Targets
     * --------------------------------------------------------------------------
     *
     * A log target is an instance of the yii\log\Target class or its child class.
     * It filters the log messages by their severity levels and categories and then
     * exports them to some medium. You can register multiple targets.
     *
     */

    'targets' => [

        [
            /*
             * --------------------------------------------------------------------------
             * FileTarget
             * --------------------------------------------------------------------------
             * Records log messages in a file.
             */

            'class' => 'yii\log\FileTarget',

            /*
             * --------------------------------------------------------------------------
             * Message Levels
             * --------------------------------------------------------------------------
             * The message levels that this target is interested in.
             */
            'levels' => ['error', 'warning'],
        ],
    ],
];
