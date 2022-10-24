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
 * @property int|null $id_categoria
 * @property int|null $unidades
 * @property int|null $minimo_unidades
 *
 * @property Categoria $categoria
 * @property Proveedor $proveedor
 * @property Venta[] $ventas
 */
class Producto extends \yii\db\ActiveRecord
{
    public $proveedores = [];
    public $categorias = [];

    public function init()
    {
        $proveedores = new Proveedor();
        $this->proveedores = $proveedores->find()->all();

        $categorias = new Categoria();
        $this->categorias = $categorias->find()->all();
    }


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
            [['id_proveedor', 'descuento', 'id_categoria', 'unidades', 'minimo_unidades'], 'integer'],
            [['precio'], 'number'],
            [['nombre'], 'string', 'max' => 100],
            [['id_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::class, 'targetAttribute' => ['id_proveedor' => 'id']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['id_categoria' => 'id']],
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
            'id_categoria' => 'Id Categoria',
            'unidades' => 'Unidades',
            'minimo_unidades' => 'Minimo stock',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id' => 'id_categoria']);
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
    
    public function obtenerStock($id_prod)
    {
        $command = "SELECT unidades, minimo_unidades

        FROM producto

        WHERE producto.id = $id_prod";

        $data = Yii::$app->db->createCommand($command)->queryAll();
        return $data;
    }

    public function resta_deVenta($id_prod, $valQueResta)
    {
        $command = "UPDATE producto

        SET unidades = (unidades - ".$valQueResta.")

        WHERE producto.id = $id_prod";

        $data = Yii::$app->db->createCommand($command)->queryAll();
        return $data;
    }
}
