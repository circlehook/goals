<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\GoalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Мои цели';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'Главная';
?>
<div class="goals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a('Create Goals', ['create'], ['class' => 'btn btn-success']) ?>
    <?= 'Колличество ваших целей:'.$count ?>
    </p>
    <p>
        <?= 'C низким приоритетом:'.$low ?>
    </p>
    <p>
        <?= 'Cо средним  приоритетом:'.$medium ?>
    </p>
    <p>
        <?= 'C высоким приоритетом:'.$high ?>
    </p>
    <p>
        <?= 'Колличество завершённых целей:'.$finished ?>
    </p>


</div>
