<?php

namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\UserFixture;
use frontend\forms\ResetPasswordForm;
use frontend\tests\UnitTester;
use yii\base\InvalidArgumentException;

class ResetPasswordFormTest extends Unit
{
    protected UnitTester $tester;


    public function _before(): void
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ]);
    }

    public function testResetWrongToken(): void
    {
        $this->tester->expectThrowable(InvalidArgumentException::class, function () {
            new ResetPasswordForm('');
        });

        $this->tester->expectThrowable(InvalidArgumentException::class, function () {
            new ResetPasswordForm('notexistingtoken_1391882543');
        });
    }

    public function testResetCorrectToken(): void
    {
        $user = $this->tester->grabFixture('user', 0);
        $form = new ResetPasswordForm($user['password_reset_token']);
        verify($form->resetPassword())->notEmpty();
    }
}
