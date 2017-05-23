<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Активность клиентов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'ФИО',
                'attribute' => 'name',
                'value' => 'name'
            ],
            [
                'label'=>'Телефон',
                'attribute' => 'phone',
                'value' => 'phone'
            ],
            [
                'label'=>'Категория',
                'attribute' => 'category',
                'value' => 'category.name'
            ],
            [
                'label'=>'Животные',
                'attribute' => 'pets',
                'value' => 'pets'
            ],
            [
                'label'=>'Кол-во заказов',
                'attribute' => 'countOrders',
                'value' => 'countOrders'
            ],
            [
                'label' => 'Сумма заказов',
                'attribute' => 'sumOrders',
                'value' => 'sumOrders'
            ],
            [
                'label'=>'Дата заказа',
                'attribute' => 'dateOrders',
                'value' => 'dateOrders'
            ],

        ],
    ]); ?>
</div>
