<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">

        <p class="lead">Seleccione una de las entradas.</p><br>

        <p></p>
        <p><a class="btn btn-lg btn-danger col-5" href="<?php echo Url::toRoute(["producto/index"]);?>">Lista de productos</a></p>
        <p><a class="btn btn-lg btn-success col-5" href="<?php echo Url::toRoute(["venta/create"]);?>">Nueva Venta</a></p>
        <p><a class="btn btn-lg btn-warning col-5" href="<?php echo Url::toRoute(["venta/reporte"]);?>">Reportes</a></p>
    </div>

</div>

