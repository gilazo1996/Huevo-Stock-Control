<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Producto;

$proveedores = ArrayHelper::map($model->proveedores, 'id', 'nombre_prov');
$categorias = ArrayHelper::map($model->categorias, 'id', 'nombre');

/** @var yii\web\View $this */
/** @var backend\models\Producto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_proveedor')->dropDownList($proveedores, ['prompt' => 'Seleccione proveedor' ]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'precio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descuento')->textInput() ?>

    <?= $form->field($model, 'id_categoria')->dropDownList($categorias, ['prompt' => 'Seleccione categoria' ]); ?>

    <?= $form->field($model, 'unidades')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
