<?php

namespace app\models;

use Yii;
use app\models\Shake;
use app\models\Pull;

/**
 * This is the model class for table "{{%pull}}".
 *
 * @property integer $id
 * @property integer $id_catalog
 * @property integer $id_language
 * @property string $name
 * @property string $author
 * @property string $description
 * @property string $sex
 * @property string $language
 * @property string $country
 * @property string $type
 * @property string $repeat
 * @property string $discus
 * @property string $image1
 * @property string $image2
 * @property string $image3
 */
class Pull extends \yii\db\ActiveRecord
{
     public $title;
    public $path;
	public $arrayID;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pull}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_catalog', 'id_language'], 'integer'],
            [['name', 'image1'], 'required'],
            [['discus'], 'string'],
            [['name', 'description', 'image1', 'image2', 'image3'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 100],
            [['sex', 'language', 'country'], 'string', 'max' => 5],
            [['type', 'repeat'], 'string', 'max' => 20],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_catalog' => Yii::t('app', 'Id Catalog'),
            'id_language' => Yii::t('app', 'Id Language'),
            'name' => Yii::t('app', 'Title'),
            'author' => Yii::t('app', 'Author'),
            'description' => Yii::t('app', 'Description'),
            'sex' => Yii::t('app', 'Sex'),
            'language' => Yii::t('app', 'Language'),
            'country' => Yii::t('app', 'Country'),
            'type' => Yii::t('app', 'Type'),
            'repeat' => Yii::t('app', 'Repeat'),
            'discus' => Yii::t('app', 'Discus'),
            'image1' => Yii::t('app', 'Image1'),
            'image2' => Yii::t('app', 'Image2'),
            'image3' => Yii::t('app', 'Image3'),
        ];
    }

    public function idList()
    {

		$data = Pull::find()->asArray()->all();
		// перебераем и получаем  массив с id-шниками всех записей
        foreach ($data as $value) {
			$array[] = $value['id'];
            //return $value['id'];
            //array_push($array, $value['id']);
        }
        // перемешиваем случайно все id
        
        //$result =  shuffle($array);
        return $array;
    }

    
    /*
    *   записывает в таблицу shake перемешанный массив соответствия ключей записей пользователю
    */
    public function shake($id_user, $array)
    {
        //Shake::deleteAll();
        shuffle($array);
        $i=0;
        $count=0;
        foreach ($array as $id_pull)
        {
            $i++;
            $shake = new Shake();
            $shake->id_pull = $id_pull;
            $shake->id_user = $id_user;
            $shake->num     = $i;
            if($shake->save())
            {
                $count++;

            }
            else
            {
                return 'falsedsfsdf';
            }
        }
        return 'asdasd'.$count;
    }
}