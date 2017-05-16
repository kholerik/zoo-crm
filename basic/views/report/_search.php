<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>
<!---->
<!--    --><?//= $form->field($model, 'name') ?>

<!--    --><?//= $form->field($model, 'vendor_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Vendor::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'manufacturer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Manufacturer::find()->all(), 'id', 'name'), [
        'prompt' => '(не выбрано)']);?>
    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\ProductCategory::find()->all(), 'id', 'name'), [
        'prompt' => '(не выбрано)']);?>
    <?=  $form->field($model, 'createdFrom')->widget(\yii\jui\DatePicker::className(),['clientOptions' => [
        'dateFormat' => 'dd.mm.yyyy',
        'language' => 'ru'
    ]])  ?>

     <?= $form->field($model, 'createdTo')->widget(\yii\jui\DatePicker::className(),['clientOptions' => [
        'language' => 'ru',
         'dateFormat' => 'yyyy-MM-dd',
    ]])  ?>

    <?php // echo $form->field($model, 'price_id') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'status_check') ?>

    <?php // echo $form->field($model, 'price') ?>

<!--    --><?php // echo $form->field($model, 'update_date')->widget(\yii\jui\DatePicker::className(),['clientOptions' => [
//        'language' => 'ru',
//        'dateFormat' => 'yyyy-MM-dd',
//    ]])  ?>

    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
