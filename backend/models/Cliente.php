<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property int $dni
 * @property string $nombre
 * @property string $apellido
 * @property string|null $domicilio
 * @property string|null $email
 * @property int|null $num_telefono
 *
 * @property Venta[] $ventas
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dni', 'nombre', 'apellido'], 'required'],
            [['dni', 'num_telefono'], 'integer'],
            [['nombre', 'email'], 'string', 'max' => 70],
            [['apellido'], 'string', 'max' => 120],
            [['domicilio'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dni' => 'Dni',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'domicilio' => 'Domicilio',
            'email' => 'Email',
            'num_telefono' => 'Num Telefono',
        ];
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::class, ['id_cliente' => 'id']);
    }
}
