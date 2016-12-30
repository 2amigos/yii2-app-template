<?php

return [

    /*
     * --------------------------------------------------------------------------
     * Mailer
     * --------------------------------------------------------------------------
     *
     * Mailer implements a mailer based on SwiftMailer.
     */

    'class' => 'yii\swiftmailer\Mailer',

    /*
     * --------------------------------------------------------------------------
     * useFileTransport property
     * --------------------------------------------------------------------------
     *
     * Send all mails to a file by default. You have to set 'useFileTransport' to
     * false and configure a transport for the mailer to send real emails.
     */

    'useFileTransport' => true,

    /*
     * --------------------------------------------------------------------------
     * viewPath property
     * --------------------------------------------------------------------------
     *
     * Configure the directory that contains the view files for composing emails.
     * Defaults to '@app/mail', let's place its views where it supposed to be.
     */

    'viewPath' => '@app/views/mail'
];
