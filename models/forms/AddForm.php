<?php

namespace app\models;
namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Goals;


/**
 * StartForm is the model behind the contact form.
 */
class AddForm extends Model
{

      public $id;
      public $path;
      public $name;
      public $text;
      public $priority=1; 
      public $progress;
      public $num;

     /* public $id_option ;
      public $name;
      public $email;
      public $password;
      public $sex;
      public $language;
      public $country;
      public $status;
      public $space;
      public $history;
      public $log;*/

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
          [['priority', 'progress' ], 'integer'],
            // email has to be a valid email address
           // ['email', 'email'],
            //[['id'], 'required'],
       // [['priority'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
           // 'id' => 'ID',
           /* 'id_option' => 'Id Option',*/
           // 'name' => 'Name',
           /* 'email' => 'Email',
            'password' => 'Password',
            'sex' => 'Sex',
            'language' => 'Language',
            'country' => 'Country',
            'status' => 'Status',
            'space' => 'Space',
            'history' => 'History',
            'log' => 'Log',*/
            'text' => 'Texxxt',
            'priority' => 'Priority',
        ];
    }

    
    
}
