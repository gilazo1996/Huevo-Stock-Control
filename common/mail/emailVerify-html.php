<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user backend\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verification', 'token' => $user->verification_token]);
?>
<div class="verify-email">
    <p><?= Yii::t('app', 'Bienvenido ') ?><?= Html::encode($user->username) ?>,</p>

    <p><?= Yii::t('app', 'Sigue el siguiente enlace para verificar tu correo electrónico::') ?></p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink, ['class' => 'btn btn-danger btn-lg btn-block']) ?></p>
</div>
