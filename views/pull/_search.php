<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PullSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pull-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_catalog') ?>

    <?= $form->field($model, 'id_language') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'repeat') ?>

    <?php // echo $form->field($model, 'discus') ?>

    <?php // echo $form->field($model, 'image1') ?>

    <?php // echo $form->field($model, 'image2') ?>

    <?php // echo $form->field($model, 'image3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
