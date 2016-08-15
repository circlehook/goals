<?php

namespace app\models;

use Yii;
use app\models\Users;
use app\models\Pull;

/**
 * This is the model class for table "{{%shake}}".
 *
 * @property integer $id
 * @property integer $id_pull
 * @property integer $id_user
 * @property integer $num
 */
class Shake extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shake}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pull', 'id_user', 'num'], 'required'],
            [['id_pull', 'id_user', 'num'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_pull' => Yii::t('app', 'Id Pull'),
            'id_user' => Yii::t('app', 'Id User'),
            'num' => Yii::t('app', 'Num'),
        ];
    }

    
    public function count($id_user)
    {
        $data = Shake::findOne(['id' => $id_user]);
    }

    public static function maxNum($id_user)
    {

        $data = Shake::find()->where(['id_user' => $id_user])->asArray()->all();

        foreach ($data as $value) {
            $array[] = $value['num'];
        }
        //max($array);
        return max($array);
           
    }

    
}
