
</br></br>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Goals */

//$this->title = 'Update Goals: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Goals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
