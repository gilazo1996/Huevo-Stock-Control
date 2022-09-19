<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property int $id_proveedor
 * @property string $nombre
 * @property float|null $precio
 * @property int|null $descuento
 * @property string|null $categoria
 * @property int|null $unidades
 *
 * @property Proveedor $proveedor
 * @property Venta[] $ventas
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_proveedor', 'nombre'], 'required'],
            [['id_proveedor', 'descuento', 'unidades'], 'integer'],
            [['precio'], 'number'],
            [['nombre'], 'string', 'max' => 100],
            [['categoria'], 'string', 'max' => 70],
            [['id_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::class, 'targetAttribute' => ['id_proveedor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proveedor' => 'Id Proveedor',
            'nombre' => 'Nombre',
            'precio' => 'Precio',
            'descuento' => 'Descuento',
            'categoria' => 'Categoria',
            'unidades' => 'Unidades',
        ];
    }

    /**
     * Gets query for [[Proveedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::class, ['id' => 'id_proveedor']);
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::class, ['id_producto' => 'id']);
    }

    public function obtenerPrecio($received)
    {
        $command = "SELECT precio

        FROM producto

        WHERE producto.id = $received";

        $data = Yii::$app->db->createCommand($command)->queryAll();
        return $data;
    }    
}
