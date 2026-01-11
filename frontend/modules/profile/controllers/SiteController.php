<?php

namespace frontend\modules\profile\controllers;

use common\components\controllers\WebController;
use frontend\modules\profile\forms\EditIdentityProfileForm;
use yii\web\Response;

final class SiteController extends WebController
{
    public function actionIndex(): Response
    {
        return $this->render('index');
    }

    public function actionEdit(): Response
    {
        $model = new EditIdentityProfileForm();
        return $this->render('edit');
    }
}