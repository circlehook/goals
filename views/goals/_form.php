<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Goals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'id_pull')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'repeat')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'priority')->textInput() ?>
    <center><?= $form->field($model, 'priority')->radioList(['1' => 'низкий', '2' => 'средний', '3' => 'высокий' ])->label(false) ?></center>

    <?//= $form->field($model, 'begin')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'progress')->textInput() ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
