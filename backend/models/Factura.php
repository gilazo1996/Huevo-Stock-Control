<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "factura".
 *
 * @property int $id
 * @property int $id_venta
 * @property int $id_cliente
 * @property string $fecha_pedido
 * @property int $subtotal
 * @property string $region
 * @property int $vendedor
 *
 * @property Cliente $cliente
 * @property Venta $venta
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
            [['id_venta', 'id_cliente', 'subtotal', 'region', 'vendedor'], 'required'],
            [['id_venta', 'id_cliente', 'subtotal', 'vendedor'], 'integer'],
            [['fecha_pedido'], 'safe'],
            [['region'], 'string', 'max' => 100],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['id_cliente' => 'id']],
            [['id_venta'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['id_venta' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_venta' => 'Id Venta',
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
     * Gets query for [[Venta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVenta()
    {
        return $this->hasOne(Venta::className(), ['id' => 'id_venta']);
    }
}
