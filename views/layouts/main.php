<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('Life Goals') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap <?php  if(Yii::$app->request->getUrl() == '/goals/web/'  || Yii::$app->request->getUrl() == '/goals/web/site/index') { echo 'hoome'; } ?>">
    <?php
    NavBar::begin([
        'brandLabel' => 'Life goals. pre-alfa v 0.3',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],

    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            
            ['label' => 'Добавить', 'url' => ['/goals/add'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Мои цели', 'url' => ['/goals/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Завершенные', 'url' => ['/goals/finished'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Статистика', 'url' => ['/goals/board'], 'visible' => !Yii::$app->user->isGuest],
            
			//['label' => 'About', 'url' => ['/site/about']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                //['label' => 'Home', 'url' => ['/site/index']]
                ['label' => 'Join', 'url' => ['/site/login']]
            ) : (
                 
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->email. ')',
                    ['class' => 'btn btn-link logoutfix']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Life Goals inc.  <?= date('Y') ?></p>

        <p class="pull-right"><?= "created by <a href='https://vk.com/dvinme'>Dmitry Vinichenko</a>"//Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>