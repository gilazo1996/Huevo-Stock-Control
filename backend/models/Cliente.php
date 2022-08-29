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
 * @property Factura[] $facturas
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
     * Gets query for [[Facturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['id_cliente' => 'id']);
    }
}
