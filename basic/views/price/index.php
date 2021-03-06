<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Справочник цен';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product.name',
            'value',
            'create_date:date',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
