<?php

namespace frontend\tests\unit\models;

use Codeception\Test\Unit;
use common\enums\IdentityStatus;
use common\fixtures\UserFixture;
use frontend\forms\VerifyEmailForm;
use frontend\tests\UnitTester;
use yii\base\InvalidArgumentException;
use common\models\Identity;

class VerifyEmailFormTest extends Unit
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

    public function testVerifyWrongToken(): void
    {
        $this->tester->expectThrowable(InvalidArgumentException::class, function () {
            new VerifyEmailForm('');
        });

        $this->tester->expectThrowable(InvalidArgumentException::class, function () {
            new VerifyEmailForm('notexistingtoken_1391882543');
        });
    }

    public function testAlreadyActivatedToken(): void
    {
        $this->tester->expectThrowable(InvalidArgumentException::class, function () {
            new VerifyEmailForm('already_used_token_1548675330');
        });
    }

    public function testVerifyCorrectToken(): void
    {
        $model = new VerifyEmailForm('4ch0qbfhvWwkcuWqjN8SWRq72SOw1KYT_1548675330');
        $user = $model->verifyEmail();
        verify($user)->instanceOf(Identity::class);

        verify($user->username)->equals('test.test');
        verify($user->email)->equals('test@mail.com');
        verify($user->status)->equals(IdentityStatus::Active->value);
        verify($user->validatePassword('Test1234'))->true();
    }
}
