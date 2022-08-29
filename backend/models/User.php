<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class User extends ActiveRecord implements IdentityInterface
{

    public $re_password;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    public static function tableName()
    {
        return '{{%user}}';
    }


    public function rules()
    {
        return [
            //usernar guarda el DNI en formato argentino
            ['username', 'trim'],
            ['username', 'required', 'message' => 'El Usuario no puede estar vacio.'],
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'Este nombre de usuario ya ha sido tomado.'],
            ['username', 'string', 'min' => 8, 'max' => 8, 'message' => 'El Usuario tiene solo 8 dígitos.'],
            ['username', 'match', 'pattern' => '/^[0-9]{8}$/', 'message' => 'El Usuario debe ser numérico'], 

            ['email', 'trim'],
            ['email', 'required', 'message' => 'El email no puede estar vacio.'],
            ['email', 'email'],
            ['email', 'match', 'pattern' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/'],
            ['email', 'string', 'max' => 50],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => 'Esta dirección de correo electrónico ya se encuntra cargada.'],

            ['password_hash', 'required', 'message' => 'La contraseñas no puede estar vacio.'],
            ['password_hash', 'match', 
                    'pattern' => '/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', 
                    'message' => 'La contraseña debe contener un carácter alfabético, una mayúscula y un numero.'],

            ['re_password', 'required', 'message' => 'La confirmacion de contraseñas no puede estar vacio.'],
            ['re_password', 'compare', 
                    'compareAttribute' => 'password_hash', 
                    'type' => 'string',
                    'message' => 'Las contraseñas no son iguales.'
                ],
            
            [['status'], 'required'],            
            [['status', 'created_at', 'updated_at'], 'trim'],
            [['status', 'created_at', 'updated_at'], 'integer'],

        ];
    }

    public function create()
    {
        $date = date_create();
        

        $this->email = strtolower($this->email);
        // $this->setPassword($this->password_hash);
        $this->setPassword('Dev2021');
        $this->generateAuthKey();
        $this->generateEmailVerificationToken();
        $this->generatePasswordResetToken();
        $this->created_at = $this->updated_at = date_timestamp_get($date);

        return $this->save(false) && $this->sendEmail($this);
    }

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Registro de cuenta en ' . Yii::$app->name)
            ->send();
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }


    public static function findByPasswordResetToken($token)
    {
        if (!self::isPasswordResetTokenValid($token)) {
            return null;
        }

        return self::findOne([//busco pass no me interesa el toklen
            'password_reset_token' => $token,
        ]);
    }


    public static function findByVerificationToken($token)
    {
        // var_dump($token);die;
        return self::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }


    public static function isPasswordResetTokenValid($token)
    {

        if (empty($token)) {
            return false;
        }
        // var_dump($token);die();

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $d = ($timestamp + $expire) >= time();

        // var_dump($d);die();

        return $d;
    }


    public function getId()
    {
        return $this->getPrimaryKey();
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }


    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }


    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }


    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
