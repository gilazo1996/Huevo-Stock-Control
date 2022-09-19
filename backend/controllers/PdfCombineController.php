<?php

namespace backend\controllers;
require_once "vendor/autoload.php";


use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use iio\libmergepdf\Merger;

class PdfCombineController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}