<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\models\ProductSearch */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

//use Jenssegers\Date\Date;
//
//
//Date::setLocale('ru');
////Date::createFromFormat('d F Y', '21 Май 2015');
////echo/Date::now()->format('l j F Y H:i:s'); // zondag 28 april 2013 21:58:16
////echo Date::parse('-1 day')->diffForHumans(); // 1 dag geleden
////print_r($date); die();
//$date = Date::createFromDate()
//echo $date;

//$datetime = '2015-May-07 12:45:00';
//echo Yii::$app->dtConverter->toDisplayDateTime($datetime);
?>



<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'vendor1', // Заголовок, если назвать как связь, примет другое имя
                'value' => 'vendorGet.name' // связь такая должна быть
            ],
            [
                'attribute' => 'manufacturer',
                'value' => 'manufacturer.name'
            ],
            [
                'attribute' => 'category1',
                'value' => 'category.name'
            ],
//                'attribute'=>'vendorName',
//                'value' => function ($model, $key, $index) {
//                    return $model->vendor->name;
//                },
//            ],
//            'manufacturer.name',
          // это ведь дубликат category1  ==  'category.name',

            'price',
            'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
