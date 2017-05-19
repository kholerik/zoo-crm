<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчет по товарам';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
//            'vendor.name',
            [
                'attribute' => 'vendor',
                'value' => 'vendor.name'
            ],
            'manufacturer.name',
            'category.name',
            // 'price_id',
            // 'status_check',
             'price',
             'count',
            'update_date:date',
            'countOrders',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
