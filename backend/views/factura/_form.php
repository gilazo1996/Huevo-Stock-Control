<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Factura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="factura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_venta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_pedido')->textInput() ?>

    <?= $form->field($model, 'subtotal')->textInput() ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendedor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
