<?php

namespace frontend\modules\profile\controllers;

use common\components\controllers\WebController;
use yii\web\Response;

final class SiteController extends WebController
{
    public function actionIndex(): Response
    {
        return $this->render('index');
    }
}