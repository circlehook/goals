<?php

namespace app\controllers;


use Yii;
use app\models\GoalsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Pull;
use app\models\forms\AddForm;
use app\models\Users;
use app\models\Shake;
use app\models\Goals;

/**
 * GoalsController implements the CRUD actions for Goals model.
 */
class GoalsController extends Controller
{
    public $defaultAction = 'add';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all complete Goals models.
     * @return mixed
     */
    public function actionFinished()
    {
        $searchModel = new GoalsSearch();
        $dataProvider = $searchModel->searchComplete(Yii::$app->request->queryParams);

        return $this->render('finished', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goals model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $userGoals = Goals::userGoals();
        //$model = $this->findModel($id);
        if (in_array($id, $userGoals)) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->redirect(['goals/index']);
        }
    }

    /**
     * Creates a new Goals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $id_user = Yii::$app->user->id;

        $model = new Goals();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Goals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $userGoals = Goals::userGoals();
        $model = $this->findModel($id);
        if (in_array($id, $userGoals)) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->redirect(['goals/index']);
        }

    }

    /**
     * Deletes an existing Goals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $userGoals = Goals::userGoals();
        if (in_array($id, $userGoals)) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['goals/index']);
        }

    }

    /**
     * Finds the Goals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goals::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList()
    {
        $id_user = Yii::$app->user->id;
        $data = Goals::find()->where(['id_user' => $id_user])->all();

        return $this->render('list', [
            'model' => $data,
        ]);
    }

    public function actionAdd()
    {
        $form = new AddForm();

        $id_user = Yii::$app->user->id;
        $data = Users::findOne(['id' => $id_user]);
        $status = $data->status;
        $count = $data->count;

        $numMax = Shake::maxNum($id_user);
        $goals_count = Shake::find()->where(['id_user' => $id_user])->count();
        $shake = Shake::findOne(['id_user' => $id_user, 'num' => $status + 1]);
        $id_pull = $shake->id_pull;

        $pull = Pull::findOne(['id' => $id_pull]);
        $title = $pull->name;
        $image = $pull->image1;

        if ($form->load(Yii::$app->request->post())) {

            $progress = '0';
            $button = Yii::$app->request->post('button');
            //$button = $request->post('button');
            $priority = $form->priority;
            $progress = $form->progress;
            if ($numMax > $status) {
                if ($button === 'yes') {
                    if (Goals::addGoal($id_user, $id_pull, $title, $image, $progress, $priority)) {
                        if (!Users::updateStatus($id_user, $status + 1)) {
                            $result = 'status not update';
                        }
                        return $this->refresh();
                    } else {
                        $result = 'not saved';
                    }
                } elseif ($button === 'no') {
                    if (!Users::updateStatus($id_user, $status + 1)) {
                        $result = 'status not update';
                    }
                    return $this->refresh();
                } elseif ($button === 'done') {
                    if (Goals::addGoal($id_user, $id_pull, $title, $image, 100, $priority)) {
                        if (!Users::updateStatus($id_user, $status + 1)) {
                            $result = 'status not update';
                        }
                        return $this->refresh();
                    } else {
                        $result = 'not saved';
                    }
                } else {
                    $result = 'not saved';
                }
            } else {
                //throw new NotFoundHttpException('На данный момент предложений нет.');
                return $this->render('empty', [

                ]);
            }

        }
        return $this->render('add', [
            'name'      => $title,
            'image'     => $image,
            'status'    => $status,
            'model'     => $form,
            'result'    => $result,
            'count'     => $goals_count
        ]);
    }

    public function actionBoard()
    {
        $id_user = Yii::$app->user->id;
        $count = Users::getCount($id_user);
        $data = Users::findOne(['id' => $id_user]);
        $status = $data->status;
        $count = Goals::countGoals();
        $low = Goals:: countPriorityGoals(1);
        $medium = Goals::countPriorityGoals(2);
        $high = Goals::countPriorityGoals(3);
        $finished = Goals::countFinishedGoals();
        // все id pull  как массив, перемешанные
        //$array = Pull::idList();
        //$shake = Pull::shake(Yii::$app->user->id, $array);

        return $this->render('board', [
            'count' => $count,
            'low' => $low,
            'medium' => $medium,
            'high' => $high,
            'finished' => $finished,
            'status' => $status,
            /*'data'    => $data,
            'id_pull' => $id_pull,
            'title'    => $title,*/

        ]);

    }

}
