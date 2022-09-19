<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $id
 * @property string $nombre_prov
 * @property string $contacto_prov
 * @property string|null $email
 * @property string $domicilio
 * @property int|null $num_telefono
 *
 * @property Producto[] $productos
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_prov', 'contacto_prov', 'domicilio'], 'required'],
            [['num_telefono'], 'integer'],
            [['nombre_prov'], 'string', 'max' => 130],
            [['contacto_prov', 'domicilio'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_prov' => 'Nombre Prov',
            'contacto_prov' => 'Contacto Prov',
            'email' => 'Email',
            'domicilio' => 'Domicilio',
            'num_telefono' => 'Num Telefono',
        ];
    }

    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::class, ['id_proveedor' => 'id']);
    }
}
