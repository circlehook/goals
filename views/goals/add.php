<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pull;
use app\models\AddForm;
use yii\helpers\BaseHtml;


//$this->title = 'Добавить цель';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'Добавить цель';
?>
<!--  <div class="site-about">
    <h1><?//= Html::encode($this->title) ?></h1> 
 </div> -->

<?php if (Yii::$app->session->hasFlash('finished')): ?>

    <div class="alert alert-success">
        <?//=$request;?>
    </div>

<?php else: ?>

    <div class="row">

        <div class="col-lg-5 addgoal">


            <?php $form = ActiveForm::begin(['id' => 'add-form']); ?>

            <center>
                <h3 style="font-family: cursive;">
                    <?//= $form->field($model, 'name')->hiddenInput(['value'=>$name1])?>
                    <?//= $form->field($model, 'id')->hiddenInput(['value'=>$id])->label(false) ?>
                    <?= Html::encode($name.'('.$status.'/'.$count.')') ?>
                </h3>



                <?= Html::img(Yii::getAlias('@web').'/images/'. $image,['class' => 'addpicture']); ?>

                <br/><br/>

                <?//= $form->field($model, 'text') ?>
                <?= $form->field($model, 'priority')->radioList(['1' => 'низкий', '2' => 'средний', '3' => 'высокий' ])->label(false) ?>

                <?= $form->field($model, 'progress')->listBox( ['0'=>'0%', '10' => '10%', '25' =>'25%', '50'=>'50%', '75'=>'75%'], ['size'=>1, 'class' => 'width100'])->label(false)  ?>
                <?// http://stackoverflow.com/questions/28014596/yii2correct-syntax-for-listbox ?>

                <div class="form-group">
                    <?//= Html::submitButton('Ещё', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
                    <?= Html::submitButton('Добавить',   ['name'=>'button', 'value'=>'yes', 'class' => 'btn btn-primary',]) ?>
                    <?= Html::submitButton('Пропустить', ['name'=>'button',  'value'=>'no',  'class' => 'btn btn-primary',]) ?>
                    <?= Html::submitButton('Сделано!', 	 ['name'=>'button',  'value'=>'done',  'class' => 'btn btn-primary',]) ?>
                </div>
                <div><?//= $result ?></div>
                <div><?//= var_dump($set) ?></div>
            </center>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php endif; ?>

