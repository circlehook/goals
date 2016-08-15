<?php

namespace app\models;
//namespace yii\helpers;

use Yii;
use yii\helpers\Url;
use yii\helpers\Time;


/**
 * This is the model class for table "{{%goals}}".
 *
 * @property integer $id
 * @property integer $id_pull
 * @property string $title
 * @property string $type
 * @property string $repeat
 * @property integer $priority
 * @property string $begin
 * @property integer $progress
 * @property string $image
 */
class Goals extends \yii\db\ActiveRecord
{
    public $logo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goals}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pull', 'id_user'], 'integer'],
            [['priority', 'progress'], 'integer'],
            //[['title', 'type', 'priority', 'begin', 'progress', 'image'], 'required'],
            [['title', 'image'], 'required'],
            [['title', 'image'], 'string', 'max' => 255],
            [['type', 'repeat', 'begin'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_pull' => 'Id Pull',
            'title' => 'Title',
            'type' => 'Type',
            'repeat' => 'Repeat',
            'priority' => 'Priority',
            'begin' => 'Begin',
            'progress' => 'Progress',
            'image' => 'Image',
        ];
    }

    

    public static function addGoal($id_user,$id_pull,$title,$image,$progress, $priority)
    {
        $goals = new Goals;
        //$date = new DateTime();
        //$time = new \DateTime('now', new \DateTimeZone('UTC'));
        $now = date('Y-m-d');
        $goals->id_user     = $id_user;
        $goals->id_pull     = $id_pull;
        $goals->title       = $title;
        $goals->image       = $image;
        $goals->progress    = $progress;
        $goals->priority    = $priority;
        $goals->date_create = $now;
        if($goals->save()){
          return true;
        }else{
          return false;  
        } 
    }

    /**
     * @
     * @return array all user goals 
     */
    public function userGoals()
    {
        $id_user = Yii::$app->user->id;
        //$array = Goals::find()->where(['id_user' => $id_user])->asArray();
        $data = Goals::find()->where(['id_user' => $id_user])->asArray()->all();
        foreach ($data as $value) {
            $array[] = $value['id'];
        }
        return $array;   
    }

    public function countGoals()
    {
        $id_user = Yii::$app->user->id;
        $count = Goals::find()->where(['id_user' => $id_user])->count();
        
        return $count;   
    }

    public function countPriorityGoals($priority)
    {
        $id_user = Yii::$app->user->id;
        $count = Goals::find()->where(['id_user' => $id_user, 'priority'=> $priority ])->count();
        
        return $count;   
    }

    public function countFinishedGoals()
    {
        $id_user = Yii::$app->user->id;
        $count = Goals::find()->where(['id_user' => $id_user, 'progress'=> '100' ])->count();
        
        return $count;   
    }
    
/*
    public function actionAdd()
    {
        $form = new AddForm();
        
        $id_user = Yii::$app->user->id;
        $data = Users::findOne(['id' => $id_user]);
        $status = $data->status;
        $count =  $data->count;
        
        $shake = Shake::findOne(['id_user' => $id_user, 'num'=> $status+1]);
        $id_pull = $shake->id_pull;

        $pull = Pull::findOne(['id'=> $id_pull]);
        $title = $pull->name;
        $image = $pull->image1;

        if ($form->load(Yii::$app->request->post())) {

            $request  = Yii::$app->request;
            $button   = $request->post('button');
            $priority = $form->priority;
            $progress = $form->progress;
            
            if($button === 'yes')
            {
                if(Goals::addGoal($id_user,$id_pull,$title,$image, $progress, $priority))
                {
                    if(!Users::updateStatus($id_user, $status+1))
                    {
                        $result = 'status not update';
                    }
                    //Yii::$app->session->setFlash('success', 'Thank you');
                    return $this->refresh();
                }
                else
                {
                    $result = 'not saved';     
                }    
            }
            elseif($button === 'no')
            {
                if(!Users::updateStatus($id_user, $status+1))
                {
                    $result = 'status not update';
                }
                return $this->refresh();
            }
            elseif($button === 'done')
            {
                if(Goals::addGoal($id_user,$id_pull,$title,$image, 100, $priority))
                {
                    if(!Users::updateStatus($id_user, $status+1))
                    {
                        $result = 'status not update';
                    }
                    return $this->refresh();
                }
                else
                {
                    $result = 'not saved';     
                }    
            }
            else
            {
                $result = 'not saved';
            }
        }
        return $this->render('add', [
            'name'  =>$title,
            'path'  =>$pull->image1,
            'status'=>($status+1),
            'model' =>$form,
            'result'=>$result,
        ]);
    }

*/
}
