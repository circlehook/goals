<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PullSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pulls';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pull-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pull', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_catalog',
            'id_language',
            'title',
            'author',
            // 'description',
            // 'sex',
            // 'language',
            // 'country',
            // 'type',
            // 'repeat',
            // 'discus:ntext',
            // 'image1',
            // 'image2',
            // 'image3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
