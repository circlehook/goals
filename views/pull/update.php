<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pull */

$this->title = 'Update Pull: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pulls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pull-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
