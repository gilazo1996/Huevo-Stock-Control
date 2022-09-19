<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "venta".
 *
 * @property int $id
 * @property int $id_cliente
 * @property int $id_producto
 * @property float|null $precio_contado
 * @property int $cantidad
 * @property int $total
 * @property int $estado
 *
 * @property Cliente $cliente
 * @property Producto $producto
 */
class Venta extends \yii\db\ActiveRecord
{

    public $clientes = [];
    public $productos = [];
   // public $estado = array(1=>'pendiente', 2=>'finalizado');   
   //['pendiente', 'finalizado'];
    
    public function init()
    {
        $clientes = new Cliente();
        $this->clientes = $clientes->find()->all();

        $productos = new Producto();
        $this->productos = $productos->find()->all();
    }

//--------------------------- sub model estado
// private static $validPropertyStatuses = array(

//     1 => 'pendiente',

//     2 => 'finalizado',
// );

// public static function getPropertyStatusOptions()
// {
//     return self::$validPropertyStatuses;
// }

// public function getPropertyStatusForDisplay()
// {
//     if (isset(self::$validPropertyStatuses[$this->pr_status]))

//         return self::$validPropertyStatuses[$this->pr_status];

//     return false; // Or throw exception or something
// }
//----------------------------------------


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
            [['id_cliente', 'id_producto', 'cantidad', 'total', 'estado'], 'required'],
            [['id_cliente', 'id_producto', 'cantidad', 'total', 'estado'], 'integer'],
            [['precio_contado'], 'number'],
            [['id_producto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::class, 'targetAttribute' => ['id_producto' => 'id']],
            [['id_cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['id_cliente' => 'id']],
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
            'id_producto' => 'Id Producto',
            'precio_contado' => 'Precio Contado',
            'cantidad' => 'Cantidad',
            'total' => 'Total',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::class, ['id' => 'id_cliente']);
    }

    /**
     * Gets query for [[Producto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::class, ['id' => 'id_producto']);
    }


        /**
     * este metodo hace cosas, COMENTAR
     */
    public function hola($id_product)
    {
        $result = null;

        foreach ($this->productos as $p) 
        {
            if ($p->id == $id_product) 
            {
                $result = $p;
            }
        }

        return $result;
    }
}
