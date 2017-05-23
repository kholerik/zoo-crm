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
    <?php  echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label'=>'Наименование',
                'attribute' => 'name',
                'value' => 'name'
            ],
            [
                'label'=>'Поставщик',
                'attribute' => 'vendor',
                'value' => 'vendor.name'
            ],
            [
                'label'=>'Производитель',
                'attribute' => 'manufacturer',
                'value' => 'manufacturer.name'
            ],
            [
                'label'=>'Категория',
                'attribute' => 'category',
                'value' => 'category.name'
            ],
            [
                'label'=>'Цена',
                'attribute' => 'price',
                'value' => 'price'
            ],
            [
                'label'=>'Дата редактирования',
                'attribute' => 'update_date',
                'value' => 'update_date',
                'format' => 'date',
            ],

        ],
    ]); ?>
</div>
