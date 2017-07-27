<?php

use SideKit\Config\ConfigKit;
/*
 * --------------------------------------------------------------------------
 * Register custom Yii aliases
 * --------------------------------------------------------------------------
 *
 * As we have changed the structure. Modify default Yii aliases here.
 */
Yii::setAlias('@root', ConfigKit::config()->getRootPath());
Yii::setAlias('@web', ConfigKit::config()->getBasePath() . DIRECTORY_SEPARATOR . '../public');
