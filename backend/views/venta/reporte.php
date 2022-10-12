<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="reporte-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php //var_dump($arrayProvider); die; ?>

    <?php //GridView::widget([
        //'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //[
                //'label'=>'Cliente',
                //'attribute'=>'id_cliente',
            //],
            //[
                //'label'=>'Producto',
                //'attribute'=>'id_producto',
                // 'value'=>function($model_prod)
                // {
                //     $id_a_buscar = $dataProvider->$model_prod->id_producto;
                //     return $model_prod->devolverProducto($id_a_buscar);
                // }
            //],
            //'id_producto',
            //'precio_contado',
            //'cantidad',
            //'total',
            //'fecha_venta',
            //'estado',
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Venta $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],*/
        //],]); 
        ?>

    <br>
    <table class="table table-striped table-dark table-bordered">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre cliente</th>
        <th scope="col">Nombre producto</th>
        <th scope="col">Precio contado</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Total</th>
        <th scope="col">Fecha venta</th>
        <th scope="col">Estado</th>
        </tr>
    </thead>
        <tbody>
            <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr> -->

            <?php 
                $conti = 0;   $max_conti = count($arrayProvider);   //var_dump($max_conti); die;

                while($conti < $max_conti)
                {
                    echo
                        "<tr>
                            <th scope='row'>".($conti+1)."</th>
                            <td scope='row'>".($arrayProvider[$conti]['nom_cliente'])."</td>
                            <td scope='row'>".($arrayProvider[$conti]['nom_producto'])."</td>
                            <td scope='row'>".($arrayProvider[$conti]['precio_contado'])."</td>
                            <td scope='row'>".($arrayProvider[$conti]['cantidad'])."</td>
                            <td scope='row'>".($arrayProvider[$conti]['total'])."</td>
                            <td scope='row'>".($arrayProvider[$conti]['fecha_venta'])."</td>
                            <td scope='row'>".($arrayProvider[$conti]['estado'])."</td>
                        </tr>";   $conti++;
                }   
            ?>

        </tbody>
    </table>

</div>