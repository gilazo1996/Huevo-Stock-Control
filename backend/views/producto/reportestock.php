<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\ActionColumnEspecial;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reporte de Stock';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="reporte-index">

    <div class="d-flex justify-content-start">
        <h1><?= Html::encode($this->title) ?></h1>
        
        &nbsp; &nbsp;
        <p>
            <a class="btn btn-warning m-2" href="<?php echo Url::toRoute(["venta/reporte"]);?>">Reporte ventas</a>
        </p>
        
        <!-- con "m-2" estoy aplicando un margin de 2% -->
        <!-- <p class="m-2"> 
            <?php //Html::a('Reporte ventas', ['reporte'], ['class' => 'btn btn-warning']) ?>
        </p> -->
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php //var_dump($arrayProvider); die; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_proveedor',
            'nombre',
            //'precio',
            //'descuento',
            //'id_categoria',
            'unidades',
            'minimo_unidades',
            [
                'class' => ActionColumnEspecial::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]) ;
                 }
            ],
        ],
    ]);?>

    <!-- <br>
    <table class="table table-striped table-dark table-bordered">
    <thead>
        <tr>
        <th scope="col"> # </th>
        <th scope="col"> Producto </th>
        <th scope="col"> Stock </th>
        <th scope="col"> Stock Minimo </th>
        <th scope="col"> Accion </th>
        </tr>
    </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
            </tr>

        </tbody>
    </table> -->

</div>

<style>
    .table
    {
        color:white;
        /*border-color: gray 2px solid;*/
    }

    .filters
    {
        background-color: gray;
    }

    table>thead>tr>th>a
    {
        color:white;
    }

    table>a
    {
        color:white;
    }
</style>