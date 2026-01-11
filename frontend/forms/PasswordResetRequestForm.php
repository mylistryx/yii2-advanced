<?php

namespace frontend\forms;

use common\models\Identity;
use Yii;
use yii\base\Model;

class PasswordResetRequestForm extends Model
{
    public ?string $email = null;

    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => Identity::class,
                'filter' => ['status' => Identity::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.',
            ],
        ];
    }

    public function sendEmail(): bool
    {
        /* @var $identity Identity */
        $identity = Identity::findOne([
            'status' => Identity::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$identity) {
            return false;
        }

        if (!Identity::isPasswordResetTokenValid($identity->password_reset_token)) {
            $identity->generatePasswordResetToken();
            if (!$identity->save()) {
                return false;
            }
        }

        return Yii::$app
            ->mailer
            ->compose(
                [
                    'html' => 'passwordResetToken-html',
                    'text' => 'passwordResetToken-text',
                ],
                [
                    'identity' => $identity,
                ],
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }
}
