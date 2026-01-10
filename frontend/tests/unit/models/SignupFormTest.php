<?php

namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\forms\SignupForm;
use frontend\tests\UnitTester;
use common\models\Identity;
use Yii;
use yii\mail\MessageInterface;

class SignupFormTest extends Unit
{
    protected UnitTester $tester;


    public function _before(): void
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCorrectSignup(): void
    {
        $model = new SignupForm([
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
        ]);

        $user = $model->signup();
        verify($user)->notEmpty();

        /** @var Identity $user */
        $user = $this->tester->grabRecord(Identity::class, [
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'status' => Identity::STATUS_INACTIVE
        ]);

        $this->tester->seeEmailIsSent();

        $mail = $this->tester->grabLastSentEmail();

        verify($mail)->instanceOf(MessageInterface::class);
        verify($mail->getTo())->arrayHasKey('some_email@example.com');
        verify($mail->getFrom())->arrayHasKey(Yii::$app->params['supportEmail']);
        verify($mail->getSubject())->equals('Account registration at ' . Yii::$app->name);
        verify($mail->toString())->stringContainsString($user->verification_token);
    }

    public function testNotCorrectSignup(): void
    {
        $model = new SignupForm([
            'username' => 'troy.becker',
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
        ]);

        verify($model->signup())->empty();
        verify($model->getErrors('username'))->notEmpty();
        verify($model->getErrors('email'))->notEmpty();

        verify($model->getFirstError('username'))
            ->equals('This username has already been taken.');
        verify($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}
