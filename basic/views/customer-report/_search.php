<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?=  $form->field($model, 'createdFrom')->widget(\yii\jui\DatePicker::className())  ?>
    <?=  $form->field($model, 'createdTo')->widget(\yii\jui\DatePicker::className())  ?>



    <div class="form-group">
        <?= Html::submitButton('Исквать', ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
