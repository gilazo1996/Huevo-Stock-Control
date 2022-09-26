<?php

namespace backend\controllers;

use backend\models\Venta;
use backend\models\VentaSearch;
use backend\models\Cliente;
use backend\models\Producto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentaController implements the CRUD actions for Venta model.
 */
class VentaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST', 'getproducto'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Venta models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venta model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Venta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Venta();


        if ($this->request->isPost) {
            
            //$model->load($this->request->post());
            //var_dump($model); die;
            //$model->validate();
            //var_dump($model->getErrors()); die;
            if ($model->load($this->request->post())) {


                date_default_timezone_set('America/Argentina/Buenos_Aires');  //ajusta el formato de fecha y hora del pais...
                $fechi_vent = date('Y-m-d H:i:s', strtotime('now'));   //si uso 'today' en vez de 'now' solo aplica para la fecha, el horario no lo reconoce
                //var_dump($fechi_vent); die;

                $model->fecha_venta = $fechi_vent;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Venta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Venta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Venta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Venta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venta::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetproducto()
    {
        $consult_prod = new Producto();

        if ($producte = $_POST['id_product']) 
        {
            $data = $consult_prod->obtenerPrecio($producte);
            echo json_encode($data);
        }
    }
    
    public function actionReporte()
    {
        $nombreCliente = new Cliente();
        $datosProducto = new Producto();
        $fechaVenta = 0;


        return $this->render('reporte');
    }
}

