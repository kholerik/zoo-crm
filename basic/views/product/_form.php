<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Vendor::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'manufacturer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Manufacturer::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\ProductCategory::find()->all(), 'id', 'name')) ?>

<!--    --><?//= $form->field($model, 'price_id')->textInput() ?>
    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= !$model->isNewRecord ? $form->field($model, 'status_check')->checkbox(): ''?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
