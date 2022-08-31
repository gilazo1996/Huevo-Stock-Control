<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "venta".
 *
 * @property int $id
 * @property int $id_factura
 * @property int $id_producto
 * @property int $cantidad
 * @property float|null $precio_contado
 * @property int $total
 *
 * @property Factura[] $facturas
 * @property Producto $producto
 */
class Venta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_factura', 'id_producto', 'cantidad', 'total'], 'required'],
            [['id_factura', 'id_producto', 'cantidad', 'total'], 'integer'],
            [['precio_contado'], 'number'],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['id_producto' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_factura' => 'Id Factura',
            'id_producto' => 'Id Producto',
            'cantidad' => 'Cantidad',
            'precio_contado' => 'Precio Contado',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[Facturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Factura::className(), ['id_venta' => 'id']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'id_producto']);
    }
}
