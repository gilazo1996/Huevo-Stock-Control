<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Venta;

$cliente = ArrayHelper::map($model->clientes, 'id', 'nombre');
$producto = ArrayHelper::map($model->productos, 'id', 'nombre');

$estado = ['0'=>'finalizado', '1'=>'pendiente'];

	
//setlocale(LC_ALL,"es_RA");
//$fechata = date('d/m/Y');   $horata = date("H".":"."i");   $fechata_unix = time();   

//$fechata_transf = strtotime("now");   $hoy = getdate($fechata_transf);
//$fechi_vent = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'].' '.$hoy['seconds'].':'.$hoy['minutes'].':'.$hoy['hours'];

//$fechita = $hoy['hours'].':'.$hoy['minutes'].' - '.$hoy['weekday'].' '.$hoy['mday'].'/'.$hoy['mon'].'/'.$hoy['year'];
//var_dump($fechi_vent); die;
//2022-09-26 00:20:57

/** @var yii\web\View $this */
/** @var backend\models\Venta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="venta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_cliente')->textInput(['maxlength' => true]) ?>
    <?php //$form->field($model, 'id_producto')->textInput(['maxlength' => true]) ?>
    <?php //$form->field($model, 'estado')->textInput() ?>

    <?= $form->field($model, 'id_cliente')->dropDownList($cliente, ['prompt' => 'Seleccione cliente' ]); ?>

    <?= $form->field($model, 'id_producto')->dropDownList($producto, ['prompt'=>'Seleccione producto', 'id'=>'dropDownProd', 'onchange'=>'onProduct(this.value)']); ?>

    <?= $form->field($model, 'precio_contado')->textInput(['maxlength'=>true, 'id'=>'priceUnit', 'readonly'=>true]) ?>

    <?= $form->field($model, 'cantidad')->textInput(['type' => 'number', 'min'=>'1', 'id'=>'cantiUnit', 'onchange'=>'onStockPrice(this.value)']) ?>

    <?= $form->field($model, 'total')->textInput(['type' => 'number', 'id'=>'totalUnit', 'readonly'=>true]) ?>

    <?php //$form->field($model, 'fecha_venta')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList(($estado), ['prompt' => 'Seleccione estado de venta' ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
  
    function onProduct(id_product)
    {
        //var aaa = "<?php //echo $model->hola(); ?>";
        var aaa = id_product;

        //alert(aaa);

        let url = "<?php echo Yii::$app->request->baseUrl ?>";

        var campo_stock = document.getElementById('cantiUnit');
        var total_precio = document.getElementById('totalUnit');
        total_precio.value = 0;
        campo_stock.value = 0;
        var unidades_prod = 0;

        //console.log(url + '/producto/findModel');

        $.ajax({
            url: url + '/venta/getproducto',
            type: 'POST',
            data: {
                id_product: id_product
            },
            success: function(res) {
                var campo_precio = document.getElementById('priceUnit');
                //console(res);
                JSON.stringify(res);
                vfinal = res.replace(/[^0-9]+/g, "");
                campo_precio.value = vfinal;
            },
            error: function() {
                console.log("Error");
            }
        })

        // $.ajax({
        //     url: url + '/venta/getstockproducto',
        //     type: 'POST',
        //     data: {
        //         id_product: id_product
        //     },
        //     success: function(res) {
        //         JSON.stringify(res);
        //         dfinal = res.replace(/[^0-9]+/g, "");
        //         unidades_prod = dfinal;
        //         //console(dfinal);
        //     },
        //     error: function() {
        //         console.log("Error");
        //     }
        // })

        // console(unidades_prod);
    }

    function onStockPrice(canti_prods)
    {
        //alert(canti_prods);
        var campo_precio = document.getElementById('priceUnit');
        var campo_stock = canti_prods;
        var total_precio = document.getElementById('totalUnit');
        
        //alert(campo_precio.value);

        var val_total = (campo_precio.value * campo_stock);
        var campo_stock_2 = document.getElementById('cantiUnit');
        total_precio.value = val_total;

    }

</script>
