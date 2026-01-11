<?php
/**
 * @var View $this
 * @var Identity $identity
 */

use common\models\Identity;
use yii\helpers\Html;
use yii\web\View;

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['signup/verify', 'token' => $identity->verification_token]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($identity->username) ?>,</p>
    <p>Follow the link below to verify your email:</p>
    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
