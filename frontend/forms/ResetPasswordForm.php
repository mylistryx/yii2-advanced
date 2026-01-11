<?php

namespace frontend\forms;

use common\components\forms\Form;
use common\models\Identity;
use Yii;
use yii\base\Exception;
use yii\base\InvalidArgumentException;

class ResetPasswordForm extends Form
{
    public ?string $password = null;

    private ?Identity $_identity = null;

    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_identity = Identity::findByPasswordResetToken($token);
        if (!$this->_identity) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * @throws Exception
     * @throws \yii\db\Exception
     */
    public function resetPassword(): bool
    {
        $identity = $this->_identity;
        $identity->setPassword($this->password);
        $identity->removePasswordResetToken();
        $identity->generateAuthKey();

        return $identity->save(false);
    }
}
