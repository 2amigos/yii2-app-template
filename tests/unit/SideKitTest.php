<?php

use SideKit\Config\ConfigKit;

class SideKitTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testEnviroment()
    {
        expect(ConfigKit::env()->get('DATABASE_DSN_DB'))->equals('yii2_tests');
    }
}
