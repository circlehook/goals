<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="post  finished finished-board">
    <center>
    <div style="font-size:12px; margin: 3px;"><b><?= Html::encode($model->title) ?></b></div>	
    
    <div class="finished-imgdiv">
    	<?= Html::img(Yii::getAlias('@web').'/images/'. $model->image,
                        ['class' => 'finishedimg']); ?>
    	<span>Достигнуто</span>
	</div>

    
    </center>
    <?//= HtmlPurifier::process($model->text) ?>    
</div>