<?php

namespace backend\models;

use yii\base\Model;
use Yii;
use yii\data\ActiveDataProvider;
use backend\models\Venta;
use backend\models\Cliente;
use backend\models\Producto;

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

    public function searchReport($params)
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
        
        //var_dump($query); die;
        return $dataProvider;
    }

    public function getConsulta()
    {
        $query_master = "SELECT cli.nombre as nom_cliente, prod.nombre as nom_producto, venta.precio_contado, venta.cantidad, venta.total, venta.fecha_venta, venta.estado
        FROM cliente AS cli INNER JOIN producto AS prod INNER JOIN venta ON cli.id = venta.id_cliente AND prod.id = venta.id_producto
        ORDER BY venta.id ASC;";

        $query_A = "SELECT * FROM egg_store_base.venta";
        $query_B = "SELECT * FROM egg_store_base.cliente";
        $query_C = "SELECT * FROM egg_store_base.producto";

        $data_master = Yii::$app->db->createCommand($query_master)->queryAll();
        $dataQueryA = Yii::$app->db->createCommand($query_A)->queryAll();
        $dataQueryB = Yii::$app->db->createCommand($query_B)->queryAll();
        $dataQueryC = Yii::$app->db->createCommand($query_C)->queryAll();
        
        return $data_master;
        //var_dump($data_master[5]['cantidad']); die;
    }
}
