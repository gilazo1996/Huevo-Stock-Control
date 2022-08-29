<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $id
 * @property string $nombre
 * @property float|null $precio
 * @property int|null $descuento
 * @property string|null $categoria
 * @property int|null $unidades
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
            [['nombre'], 'required'],
            [['precio'], 'number'],
            [['descuento', 'unidades'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['categoria'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'precio' => 'Precio',
            'descuento' => 'Descuento',
            'categoria' => 'Categoria',
            'unidades' => 'Unidades',
        ];
    }
}
