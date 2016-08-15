<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GoalsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?//= $form->field($model, 'id') ?>

    <?//= $form->field($model, 'id_pull') ?>

    <?= $form->field($model, 'title') ?>

    <?//= $form->field($model, 'type') ?>

    <?//= $form->field($model, 'repeat') ?>

    <?php // echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'begin') ?>

    <?php // echo $form->field($model, 'progress') ?>

    <?php // echo $form->field($model, 'image') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
