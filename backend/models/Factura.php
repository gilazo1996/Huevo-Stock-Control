<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "factura".
 *
 * @property int $id
 * @property int $id_cliente
 * @property string $fecha_pedido
 * @property int $subtotal
 * @property string $region
 * @property int $vendedor
 *
 * @property Cliente $cliente
 * @property Venta $id0
 */
class Factura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'factura';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_cliente', 'subtotal', 'region', 'vendedor'], 'required'],
            [['id', 'id_cliente', 'subtotal', 'vendedor'], 'integer'],
            [['fecha_pedido'], 'safe'],
            [['region'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['id' => 'id_factura']],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['id_cliente' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_cliente' => 'Id Cliente',
            'fecha_pedido' => 'Fecha Pedido',
            'subtotal' => 'Subtotal',
            'region' => 'Region',
            'vendedor' => 'Vendedor',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'id_cliente']);
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Venta::className(), ['id_factura' => 'id']);
    }
}
