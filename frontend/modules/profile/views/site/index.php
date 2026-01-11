<?php
/**
 * @var View $this
 */

use yii\bootstrap5\Html;
use yii\web\View;

$this->title = 'My profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Profile!</h1>
        </div>
    </div>
    <div class="body-content">
        <?= Html::a('Edit Profile', ['edit'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>
