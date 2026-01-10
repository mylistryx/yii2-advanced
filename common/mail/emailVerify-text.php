<?php
/**
 * @var View $this
 * @var Identity $user
 */

use common\models\Identity;
use yii\web\View;

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>
