<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Архив товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'price',
            'count',
            'vendor.name',
//            [
////                'header' => 'Поставщик',
//                'value' => function($model) {
//                    return $model->vendor->name;
//                }
//            ],
//            [
////                'header' => 'Производитель',
//                'value' => function($model) {
//                    return $model->manufacturer->name;
//                }
//            ],
//            [
////                'header' => 'Категория',
//                'value' => function($model) {
//                    return $model->category->name;
//                }
//            ],
            'manufacturer.name',
            'category.name',
            // 'price_id',
            // 'count',
            // 'status_id',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
