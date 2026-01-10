<?php

namespace frontend\forms;

use common\models\Identity;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class VerifyEmailForm extends Model
{
    public ?string $token = null;
    private ?Identity $_user = null;

    public function __construct($token, array $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Verify email token cannot be blank.');
        }
        $this->_user = Identity::findByVerificationToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong verify email token.');
        }
        parent::__construct($config);
    }

    public function verifyEmail(): ?Identity
    {
        $user = $this->_user;
        $user->status = Identity::STATUS_ACTIVE;
        return $user->save(false) ? $user : null;
    }
}
