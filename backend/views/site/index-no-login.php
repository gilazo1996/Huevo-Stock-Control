<?php
use yii\helpers\Url;
//use yii\bootstrap4\Html;
use yii\helpers\Html;
/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Bienvenido!</h1>

        <p class="lead">Control de inventario.</p>

        <?= Html::img('@web/img/logo_huevo_stock.png', ['alt' => 'My logo', 'width'=>'256px']) ?>
    </div>

</div>

