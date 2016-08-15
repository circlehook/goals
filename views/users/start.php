<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="users-start">

    <?php $form = ActiveForm::begin(); ?>

       
        <?= $form->field($model, 'sex') ?>
        <?= $form->field($model, 'language') ?>
        <?= $form->field($model, 'country') ?>
        <?= $form->field($model, 'name') ?>
       
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- users-start -->
