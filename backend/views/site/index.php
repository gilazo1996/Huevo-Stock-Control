<?php
use yii\helpers\Url;
use yii\bootstrap4\Html;
/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Bienvenido!</h1>

        <p class="lead">Control de inventario.</p>

        <p></p>
        <p><a class="btn btn-lg btn-danger" href="<?php echo Url::toRoute(["producto/index"]);?>">Lista de productos</a></p>
        <p><a class="btn btn-lg btn-success" href="<?php echo Url::toRoute(["venta/index"]);?>">Ventas</a></p>
    </div>

</div>
