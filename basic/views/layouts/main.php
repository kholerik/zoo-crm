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
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Товары для животных',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],

            ['label' => 'Товары',
                //'url' => ['/admin/default/index'],
                'items' => [
                    ['label' => 'Товары', 'url' => ['/product/index']],
                    ['label' => 'Поставщики', 'url' => ['/vendor/index']],
                    ['label' => 'Производители', 'url' => ['/manufacturer/index']],
                    ['label' => 'Категории', 'url' => ['/product-category/index']],
                    ['label' => 'Цены', 'url' => ['/price/index']],
                    ['label' => 'Архив', 'url' => ['/product/archive']],
                ],
            ],
            ['label' => 'Покупатели',
                //'url' => ['/admin/default/index'],
                'items' => [
                    ['label' => 'Покупатели', 'url' => ['/customer/index']],
                    ['label' => 'Категории', 'url' => ['/customer-category/index']],
                    ['label' => 'Наценки', 'url' => ['/margin/index']],
                ],
            ],
            ['label' => 'Заказы',
                'url' => ['/order/index'],
                //'items' => [
                //    ['label' => 'Покупатели', 'url' => ['/customer/index']],
                //    ['label' => 'Категории', 'url' => ['/customer-category/index']],
                //    ['label' => 'Наценки', 'url' => ['/margin/index']],
                //],
            ],
            ['label' => 'Отчеты',
                //'url' => ['/order/index'],
                'items' => [
                    ['label' => 'Популярность товаров', 'url' => ['/report/index']],
                    ['label' => 'Активность клиентов', 'url' => ['/customer-report/index']],
                    ['label' => 'Продажи за период', 'url' => ['/order-report/index']],
                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
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
        <p class="pull-left">&copy; Товары для животных <?= date('Y') ?></p>

<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
