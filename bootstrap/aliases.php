<?php

use Da\Config\Configuration;

/*
 * --------------------------------------------------------------------------
 * Register custom Yii aliases
 * --------------------------------------------------------------------------
 *
 * As we have changed the structure. Modify default Yii aliases here.
 */
Yii::setAlias('@tests', Configuration::app()->getBasePath() . DIRECTORY_SEPARATOR . '../tests');
Yii::setAlias('@root', Configuration::app()->getRootPath());
Yii::setAlias('@web', Configuration::app()->getBasePath() . DIRECTORY_SEPARATOR . '../public');
