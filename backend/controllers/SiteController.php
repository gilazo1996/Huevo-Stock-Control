<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\base\InvalidArgumentException;


use backend\models\User;
use common\models\LoginForm;
use common\models\SignupForm;
use common\models\VerifyEmailForm;
use common\models\ResetPasswordForm;
use common\models\PasswordResetRequestForm;


/**
 * Site controller
 */
class SiteController extends Controller
{
    //img unlz
    public $logo = '@web/img/logo-derecho.jpg';
    public $imagen = '@web/img/facultad-derecho.jpg';
    //img edf
    public $imagen_0 = 'https://yt3.ggpht.com/ytc/AKedOLSLRjKHopJL3YRWbbF4mVQKGLRLB4TiXOK-POE3dw=s900-c-k-c0x00ffffff-no-rj';
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['error', 'login',  'reset-password', 'verify-email', 'probando'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'probando'],
                        'allow' => true,
                        'roles' => ['@'], // un usuario
                    ],
                    [
                        'actions' => ['login', 'request-password-reset', 'reset-password', 'verify-email', 'verification', 'probando', 'signup', 'index'],
                        'allow' => true,
                        'roles' => ['?'], //invitado
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['imagen' => $this->imagen,]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
             return $this->goHome();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
            'logo' => $this->logo,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();

        return $this->redirect(['login']);
    }


    public function actionSignup()
    { 
        
        $this->layout = 'blank';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Gracias por registrarse. Por favor revise su bandeja de entrada para el correo electrónico de verificación.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
            'imagen' => $this->imagen,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'blank';

        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su correo electrónico para obtener más instrucciones.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Lo sentimos, no podemos restablecer la contraseña de la dirección de correo electrónico proporcionada.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
            'imagen' => $this->imagen,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword()
    {
        // $this->layout = 'blank';
        // var_dump($_GET);die;
        // $token = $_GET['token'];
        // try {
        //     //$model = new ResetPasswordForm($token);
        //     $model = new VerifyEmailForm($token);
        // } catch (InvalidArgumentException $e) {
        //     throw new BadRequestHttpException($e->getMessage());
        // }

        // if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
        //     $this->layout = 'main';
        //     Yii::$app->session->setFlash('success', 'Nueva contraseña guardada.');
        //     return $this->goHome();
        // }

        // return $this->render('resetPassword', [
        //     'model' => $model,
        //     'imagen' => $this->imagen,
        // ]);


        $model = new SignupForm();
        if($_GET['token'] && !isset($_POST["SignupForm"]['password']))
        {
            $token = $_GET['token'];
            $data = User::findOne(['password_reset_token' => $token]);
            
            
            if($data){
                return $this->render('verification', [
                    'model' => $model,
                ]);
            }
            else{
                Yii::$app->session->setFlash('error', 'Token invalido.');
            }
        }
        else if($_POST["SignupForm"] ["password"]){
            $token = $_GET['token'];
            $user = User::findOne(['password_reset_token' => $token]);            

            $user->setPassword($_POST["SignupForm"]['password']);
            $user->generateAuthKey();
            $user->updated_at = strtotime('today');
            $user->status = 10;
            $user->generatePasswordResetToken();
            $user->save(false);

            Yii::$app->session->setFlash('success', 'Nueva contraseña establecida con éxito !');

            return $this->redirect(['login']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
            'imagen' => $this->imagen,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model) {
            $model = User::findByVerificationToken($token);
            return $this->actionResetPassword($model->password_reset_token);
        }

        return $this->goHome();
    }

    public function actionVerification()
    {
        //$this->layout='blank'; //chau navbar

        $model = new SignupForm();
        if($_GET['token'] && !isset($_POST["SignupForm"]['password']))
        {
            $token = $_GET['token'];
            $data = User::findOne(['verification_token' => $token]);
            
            
            if($data){
                return $this->render('verification', [
                    'model' => $model,
                ]);
            } else{
                Yii::$app->session->setFlash('error', 'Token invalido.');
            }
        }
        else if($_POST["SignupForm"] ["password"]){
            $token = $_GET['token'];
            $user = User::findOne(['verification_token' => $token]);            

            $user->setPassword($_POST["SignupForm"]['password']);
            $user->generateAuthKey();
            $user->updated_at = strtotime('today');
            $user->status = 10;
            $user->verification_token = null;
            $user->save(false);

            Yii::$app->session->setFlash('success', 'Contraseña establecida con éxito !');

            return $this->redirect(['login']);
        }

        return $this->render('verification', [
            'model' => $model,
        ]);
    }

    public function actionProbando()
    {
        return $this->render('probando');
    }
}
