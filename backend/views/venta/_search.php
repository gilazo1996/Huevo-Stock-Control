<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\VentaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_cliente') ?>

    <?= $form->field($model, 'id_producto') ?>

    <?= $form->field($model, 'precio_contado') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'fecha_venta') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
