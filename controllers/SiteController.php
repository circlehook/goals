<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Session;
use app\models\forms\LoginForm;
use app\models\forms\ContactForm;
use app\models\Pull;
use app\models\forms\AddForm;
use app\models\Users;
use app\models\Shake;
use app\models\Goals;

class SiteController extends Controller
{

    

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }



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

    public function actionIndex()
    {
        $id_user = Yii::$app->user->id;
        $count = Users::getCount($id_user);
        $data = Users::findOne(['id' => $id_user]);
        $status = $data->status;
        // все id pull  как массив, перемешанные
        //$array = Pull::idList();
        //$shake = Pull::shake(Yii::$app->user->id, $array);

        return $this->render('index', [
            'count' => $count,
            //'shake' => $shake,
            'status' => $status,
            /*'data'    => $data,
            'id_pull' => $id_pull,
            'title'    => $title,*/

        ]);

    }

 
    


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
            
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // при логине увеличиваем счётчик в БД
            $data = Users::findOne(['id' => Yii::$app->user->id]);
            $count = $data->count;
            if($count == 0)
            {
                $array = Pull::idList();
                $shake = Pull::shake(Yii::$app->user->id, $array);
                $count++;
                $data->count = $count;
                $data->save();
            }
            else
            {
                $count++;
                $data->count = $count;
                $data->save();
            }



            //return $this->goBack();
             return $this->redirect(['goals/add']);
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

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}