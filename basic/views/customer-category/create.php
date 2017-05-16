<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CustomerCategory */

$this->title = 'Категории покупателей';
$this->params['breadcrumbs'][] = ['label' => 'Customer Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
