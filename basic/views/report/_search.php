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


    <?= $form->field($model, 'manufacturer_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Manufacturer::find()->all(), 'id', 'name'), [
        'prompt' => '(не выбрано)']);?>
    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\ProductCategory::find()->all(), 'id', 'name'), [
        'prompt' => '(не выбрано)']);?>


    <?=  $form->field($model, 'createdFrom')->widget(\yii\jui\DatePicker::className())  ?>
    <?=  $form->field($model, 'createdTo')->widget(\yii\jui\DatePicker::className())  ?>



    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
