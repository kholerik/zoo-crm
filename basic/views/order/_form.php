<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Product::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'customer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Customer::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'at_date')->widget(\yii\jui\DatePicker::className(),['clientOptions' => [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]]) ?>

    <?= $form->field($model, 'delivery_date')->widget(\yii\jui\DatePicker::className(),['clientOptions' => [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ]]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= !$model->isNewRecord ? $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\OrderStatus::find()->all(), 'id', 'name')) : ''?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
