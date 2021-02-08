<?php
namespace tests\models;

use app\models\User;
use yii\web\IdentityInterface;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        verify_that($user = User::findIdentity(100))->instanceOf('yii\web\IdentityInterface');
        verify($user->username)->equals('admin');

        verify_that(User::findIdentity(999))->null();
    }

    public function testFindUserByAccessToken()
    {
        verify_that($user = User::findIdentityByAccessToken('100-token'))->instanceOf('yii\web\IdentityInterface');
        verify($user->username)->equals('admin');

        verify_that(User::findIdentityByAccessToken('non-existing'))->null();
    }

    public function testFindUserByUsername()
    {
        verify_that($user = User::findByUsername('admin'))->instanceOf('yii\web\IdentityInterface');
        verify_that(User::findByUsername('not-admin'))->null();
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser()
    {
        $user = User::findByUsername('admin');
        verify_that($user->validateAuthKey('test100key'))->true();
        verify_that($user->validateAuthKey('test102key'))->false();

        verify_that($user->validatePassword('admin'))->true();
        verify_that($user->validatePassword('123456'))->false();
    }
}
