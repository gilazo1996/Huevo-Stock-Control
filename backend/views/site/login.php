<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Iniciar Sesion';
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Por favor, rellene los siguientes campos para iniciar sesion:</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Iniciar sesion', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>

            <div class="my-2 d-flex flex-row justify-content-between">
                <a href="<?php echo Url::toRoute(["site/signup"]);?>">Registrarse</a>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
