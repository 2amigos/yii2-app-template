<?php

namespace tests\models;

use app\models\ContactForm;

class ContactFormTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testEmailIsSentOnContact()
    {
        /** @var ContactForm $model */
        $this->model = $this->getMockBuilder('app\models\ContactForm')
            ->onlyMethods(['validate'])
            ->getMock();

        $this->model->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(true));

        $this->model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
        ];

        verify_that($this->model->contact('admin@example.com'));

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();
        verify_that($emailMessage)->instanceOf('yii\mail\MessageInterface');
        verify_that($emailMessage->getTo())->arrayHasKey('admin@example.com');
        verify_that($emailMessage->getFrom())->arrayHasKey('tester@example.com');
        verify_that($emailMessage->getSubject())->equals('very important letter subject');
        verify_that($emailMessage->toString())->stringContainsString('body of current message');
    }
}
