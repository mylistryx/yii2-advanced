<?php

namespace frontend\forms;

use common\components\forms\Form;
use common\models\Identity;
use Yii;
use yii\db\Exception;

class SignupForm extends Form
{
    public ?string $username = null;
    public ?string $email = null;
    public ?string $password = null;


    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => Identity::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => Identity::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * @throws Exception
     * @throws \yii\base\Exception
     */
    public function signup(): ?bool
    {
        if (!$this->validate()) {
            return null;
        }

        $identity = new Identity();
        $identity->username = $this->username;
        $identity->email = $this->email;
        $identity->setPassword($this->password);
        $identity->generateAuthKey();
        $identity->generateEmailVerificationToken();

        return $identity->save() && $this->sendEmail($identity);
    }

    protected function sendEmail($identity): bool
    {
        return Yii::$app
            ->mailer
            ->compose(
                [
                    'html' => 'emailVerify-html',
                    'text' => 'emailVerify-text',
                ],
                [
                    'identity' => $identity,
                ],
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
