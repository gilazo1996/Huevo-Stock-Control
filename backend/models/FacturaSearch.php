<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Factura;

/**
 * FacturaSearch represents the model behind the search form of `backend\models\Factura`.
 */
class FacturaSearch extends Factura
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_venta', 'id_cliente', 'subtotal', 'vendedor'], 'integer'],
            [['fecha_pedido', 'region'], 'safe'],
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
        $query = Factura::find();

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
            'id_venta' => $this->id_venta,
            'id_cliente' => $this->id_cliente,
            'fecha_pedido' => $this->fecha_pedido,
            'subtotal' => $this->subtotal,
            'vendedor' => $this->vendedor,
        ]);

        $query->andFilterWhere(['like', 'region', $this->region]);

        return $dataProvider;
    }
}
