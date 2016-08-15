<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Мои цели';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'Мои цели';

?>
<div class="goals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Goals', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'id_pull',
            //'id_user',
            'title',
            //'type',
            //'repeat',
            //'priority',
            //'begin',
            'progress',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img(Yii::getAlias('@web').'/images/'. $data['image'],
                        ['width' => '100px']);
                },
            ],
                        

            [ 'class' => 'yii\grid\ActionColumn', 
              'template' => '{update} {delete}',
            ],



        ],
        'rowOptions'=>function ($model, $key, $index, $grid){
            
            if($model['priority'] == 1) $class='green';
            if($model['priority'] == 2) $class='orange';
            if($model['priority'] == 3) $class='red';
            //if($model['priority'] == 2) { $class == 'green';}else 
            return [
                //'key'=>$key,
                //'index'=>$index,
                'class'=>$class
           ];
        },

    ]); ?>

</div>


<style>
    
.red{
background-color: rgba(255, 0, 0, 0.3) !important;
/*background-color: #F78181 !important;*/
vertical-align: middle !important;

}

.red  td {
    vertical-align: middle !important;
}
.green  td {
    vertical-align: middle !important;
}
.orange  td {
    vertical-align: middle !important;
}

.green{
/*background-color: #A9F5A9 !important;*/
background-color: rgba(46, 254, 100, 0.3) !important;
vertical-align: middle !important;

}

.orange{
    /*background-color: #F2F5A9 !important;*/
    background-color: rgba(255, 191, 0, 0.3) !important;
    vertical-align: middle !important;
    
}

</style>