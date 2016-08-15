<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Мои цели';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'Завершенные цели';
?>
<div class="goals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a('Create Goals', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' =>   '_finish',
        //'filterModel' => $searchModel,
        //'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'id_pull',
            //'id_user',
          //  'title',
            //'type',
            //'repeat',
            //'priority',
            //'begin',
            //'progress',
           /* [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/images/'. $data['image'],
                        ['width' => '200px']);
                },
            ],*/
                        

           // ['class' => 'yii\grid\ActionColumn'],
        //],
    ]); ?>

</div>
