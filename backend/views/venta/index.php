<?php

use backend\models\Venta;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\VentaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Venta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'id_cliente',
            'id_producto',
            'precio_contado',
            'cantidad',
            'total',
            'fecha_venta',
            'estado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Venta $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

</div>

<style>
    .table
    {
        color:white;
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
