<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pull */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pulls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pull-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_catalog',
            'id_language',
            'name',
            'author',
            'description',
            'sex',
            'language',
            'country',
            'type',
            'repeat',
            'discus:ntext',
            'image1',
            'image2',
            'image3',
        ],
    ]) ?>

</div>
