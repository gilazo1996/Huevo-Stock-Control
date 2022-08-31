<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\ArrayHelper;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="utf-8">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Questrial">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100 bg-dark text-white" >

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => '<div style="display:flex;"><img src="https://images.vexels.com/media/users/3/143110/isolated/preview/e1793c369f7f4a17cb22a902b551bc8f-icono-plano-de-huevo.png" 
                style="vertical-align:top; height:5vh;"/>' . '&nbsp<h class="text-dark">'.Yii::$app->name.'</h></div>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-light fixed-top',
            ],
        ]);

        $menuItems = [];

        if (Yii::$app->user->can('god_access')) 
        {
            $menuItems = ArrayHelper::merge($menuItems, [                
                ['label' => 'Inicio', 'url' => ['/site/index']],
                [
                    'label' => 'Clientes',  'items' => [
                        ['label' => 'Lista cliente' , 'url' => ['cliente/index']], 
                        ['label' => 'Crear cliente' , 'url' => ['cliente/create']],
                    ],
                ],
                [
                    'label' => 'Productos',  'items' => [
                        ['label' => 'Lista producto' , 'url' => ['producto/index']], 
                        ['label' => 'Crear producto' , 'url' => ['producto/create']],
                    ],
                ],
                [
                    'label' => 'Proveedores',  'items' => [
                        ['label' => 'Lista proveedor' , 'url' => ['proveedor/index']], 
                        ['label' => 'Crear proveedor' , 'url' => ['proveedor/create']],
                    ],
                ],
                
                ['label' => 'Administrar Usuarios', 'url' => ['/user']],
                ['label' => 'Gii', 'url' => ['/gii']],   
            ]);
        }

        else if (Yii::$app->user->can('admin_access')) 
        {
            $menuItems = ArrayHelper::merge($menuItems, [                
                ['label' => 'Inicio', 'url' => ['/site/index']],
                [
                    'label' => 'Clientes',  'items' => [
                        ['label' => 'Lista cliente' , 'url' => ['cliente/index']], 
                        ['label' => 'Crear cliente' , 'url' => ['cliente/create']],
                    ],
                ],
                [
                    'label' => 'Productos',  'items' => [
                        ['label' => 'Lista producto' , 'url' => ['producto/index']], 
                        ['label' => 'Crear producto' , 'url' => ['producto/create']],
                    ],
                ],
                [
                    'label' => 'Proveedores',  'items' => [
                        ['label' => 'Lista proveedor' , 'url' => ['proveedor/index']], 
                        ['label' => 'Crear proveedor' , 'url' => ['proveedor/create']],
                    ],
                ],
                [
                    'label' => 'Usuarios',  'items' => [
                        ['label' => 'Lista usuario' , 'url' => ['user/index']], 
                        ['label' => 'Crear usuario' , 'url' => ['user/create']],
                    ],
                ], 
            ]);
        }

        else if (Yii::$app->user->can('user_access')) 
        {
            $menuItems = [
                ['label' => 'Usuarios', 'url' => ['/user/index']],
                ['label' => 'Proveedor' , 'url' => ['proveedor/index']],
                ['label' => 'Producto' , 'url' => ['producto/index']], 
                ['label' => Yii::t('app', 'Reports'), 'url' => ['/report']],
            ];
        }
        else 
        {
            $menuItems = [];
        }

        if (!Yii::$app->user->isGuest) 
        {
            // $menuItems = [
            //     ['label' => Yii::t('app', 'Reports'), 'url' => ['/report']],
            // ];


            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    '👋🏻' . 'cerrar sesion', //. Yii::$app->user->identity->email,
                    ['class' => 'btn btn-link logout text-dark']
                )
                . Html::endForm()
                . '</li>';
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);

        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container">
            <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();