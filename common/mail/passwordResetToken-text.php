<?php
/**
 * @var View $this
 * @var Identity $user
 */

use common\models\Identity;
use yii\web\View;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
