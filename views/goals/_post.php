<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="post">
    <h4><?= Html::encode($model->title) ?></h4>
    <?= Html::img(Yii::getAlias('@web').'/images/'. $model->image,
                        ['class' => 'finished']); ?>
    <?//= HtmlPurifier::process($model->text) ?>    
</div>