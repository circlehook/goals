<?php

/* @var $this yii\web\View */
use app\models\Users;
use app\models\Pull;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        </br></br></br></br></br>
        <h1>Выбери яркое будущее</h1>
        </br>
        <?php 
        

         /* echo '</br>id:'.Yii::$app->user->id;
         echo '</br>';
         echo 'count:'.$count.'</br>';
         print_r(Yii::$app->user);
         echo '</br>echo data:'; print_r($data);
         print_r(Pull::find()->asArray()->all());
         $data = Users::findOne(['id' => 1]);
         */
         

        //if(Yii::$app->user->isGuest) { echo 'guest'; }else{ echo 'not guest';  }

        //var_dump(Users::findAll(['name' => 'dima']));
        // var_dump(Pull::findOne(['id' => '2']));
        ?>


        <p class="lead">хочешь изменить жизнь? Жми кнопку</p>
        </br>
        <p>
            <a class="btn btn-lg btn-success" 
               href="<?= Yii::$app->user->isGuest ? (Yii::$app->homeUrl.'site/login' ) : (Yii::$app->homeUrl.'web/index.php?r=goals/add') ?>">
                Начать
            </a>
        </p>
    </div>

    

    

</div>