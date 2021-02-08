<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use Da\Config\Configuration;

class PostInstallController extends Controller
{
    /**
     * This command generates the cookie validation on the .env file after project has been installed by composer.
     */
    public function actionGenerateCookieValidation()
    {
        $key = Yii::$app->security->generateRandomString();
        Configuration::env()->changeEnvironmentFile(['APP_COOKIE_VALIDATION_KEY' => $key]);
    }
}
