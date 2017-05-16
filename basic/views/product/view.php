<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
//        'attributes' => [
////            'id',
//            'name',
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
//            'price',
//            'count'
//        ],

        'attributes' => [
            'name',
            'vendor.name',
            'manufacturer.name',
            'category.name',
            'price',
            'count',
        ],
    ]) ?>

</div>
