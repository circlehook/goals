<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property integer $id
 * @property integer $id_option
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $sex
 * @property string $language
 * @property string $country
 * @property integer $status
 * @property string $space
 * @property string $history
 * @property integer $log
 */
class Users extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{

  /*  public $id;
    public $id_option;
    public $name;
    public $email;
    public $password;
    public $sex;
    public $language;
    public $country;
    public $status;
    public $space;
    public $history;
    public $log; */
    //public $username;
    //public $password;
    //public $count;
    //public $status;
    public $authKey;
    public $accessToken;
    //public $gender;
      /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id_option', 'status', 'log'], 'integer'],
            //[['email', 'password', 'sex', 'language', 'country', 'status'], 'required'],
            ['email', 'unique'],
            ['email', 'email'],
            [['email', 'password', 'sex', 'language'], 'required'],
            ['sex', 'string'],
            ['language', 'string'],  
            /*[['password'], 'string', 'min' => 6],
            [['sex'], 'in', 'range'=>['m','f']],
            [['sex'], 'string', 'max'=>1],*/
            [['status'], 'integer'],
            [['count'], 'integer'],
           // ['status',  'default','value'=>'2'],
            //['count', 'default','value'=>'0'],

            //[['name', 'email', 'history'], 'string', 'max' => 255],
            //[['username'], 'string', 'max' => 255],

            
            //[['sex', 'language'], 'string', 'max' => 5],
            //[['space'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_option' => 'Id Option',
            'name' => 'Name',
            'username' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
            'sex' => 'Gender',
            'language' => 'Language',
            'country' => 'Country',
            'status' => 'Status',
            'space' => 'Space',
            'history' => 'History',
            'log' => 'Log',
            'count' => 'Count',
        ];
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }*/
        //$user = Users::findOne(['name' => $username]);
        //return new static($user);
        return static::findOne(['username'=>$username]);
       // return null;

    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function setCount($id)
    {

        static::findOne(['id'=>$id]);
    }

    public function getCount($id)
    {
        $data = Users::findOne(['id' => $id]);
        return $data->count;
    }

    public static function updateStatus($id_user, $status)
    {
        $data = Users::findOne(['id' => $id_user]);
        $data->status = $status;
        if($data->save())
        {
          return true;  
        }
        else
        {
          return false;
        }
        
    }

}