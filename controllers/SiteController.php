<?php

namespace app\controllers;

use app\models\service\DirService;
use Yii;
use yii\web\Controller;
use Exception;


class SiteController extends Controller
{

    private $service;

    public function __construct($id, $module, DirService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dir = Yii::getAlias('@webroot');
        try {
            $dataProvider = $this->service->show($dir);
        } catch (Exception $e) {
            Yii::$app->session->addFlash('error', $e->getMessage());
        }

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionRefresh()
    {
        $dir = Yii::getAlias('@webroot');
        try {
            $dataProvider = $this->service->refresh($dir);
            Yii::$app->session->addFlash('success', 'Refresh complete successfully');

        } catch (Exception $e) {
            Yii::$app->session->addFlash('error', $e->getMessage());
        }

        return $this->render('index', ['dataProvider' => $dataProvider]);

    }

}
