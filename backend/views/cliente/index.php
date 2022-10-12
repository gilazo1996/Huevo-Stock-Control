<?php

use backend\models\Cliente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ClienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dni',
            'nombre',
            'apellido',
            'domicilio',
            //'email:email',
            [
                'attribute' => 'email',
                'contentOptions' => ['style' => 'color:white'], // For TD
            ],
            //'num_telefono',
            [
                'attribute' => 'num_telefono',
                'contentOptions' => ['style' => 'color:white'], // For TD
                'headerOptions' => ['class' => 'ur-class'] // For TH
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
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
