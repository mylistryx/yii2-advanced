<?php

namespace api\controllers;

use common\components\controllers\ApiController;
use yii\web\ErrorAction;

class SiteController extends ApiController
{
    public function actions2(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function actionIndex(): array
    {
        return [
            'code' => 200,
            'data' => []
        ];
    }
}