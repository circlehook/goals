<?php

namespace app\controllers;
use app\models;
use app\models\Users;
use app\models\StartForm;
use app\models\LoginForm;

use yii;



class StartController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        $model = new StartForm();

    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены

            // делаем что-то полезное с $model ...

            return $this->render('ok', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('index', ['model' => $model]);
        }


        
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

      public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
