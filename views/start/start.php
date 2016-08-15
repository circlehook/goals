<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="start-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_option') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'log') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'sex') ?>
        <?= $form->field($model, 'language') ?>
        <?= $form->field($model, 'country') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'history') ?>
        <?= $form->field($model, 'space') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- start-index -->
