<?php

namespace app\commands;

use SideKit\Config\ConfigKit;
use Yii;
use yii\console\Controller;

class PostInstallController extends Controller
{
    /**
     * This command generates the cookie validation on the .env file after project has been installed by composer.
     */
    public function actionGenerateCookieValidation()
    {
        $key = Yii::$app->security->generateRandomString();
        ConfigKit::env()->changeEnvironmentFile(['APP_COOKIE_VALIDATION_KEY' => $key]);
    }
}
