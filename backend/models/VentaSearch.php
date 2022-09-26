<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Venta;

/**
 * VentaSearch represents the model behind the search form of `backend\models\Venta`.
 */
class VentaSearch extends Venta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_cliente', 'id_producto', 'cantidad', 'total', 'estado'], 'integer'],
            [['precio_contado'], 'number'],
            [['fecha_venta'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Venta::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_cliente' => $this->id_cliente,
            'id_producto' => $this->id_producto,
            'precio_contado' => $this->precio_contado,
            'cantidad' => $this->cantidad,
            'total' => $this->total,
            'fecha_venta' => $this->fecha_venta,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }
}
