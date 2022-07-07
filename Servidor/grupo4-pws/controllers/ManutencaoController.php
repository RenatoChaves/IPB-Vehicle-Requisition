<?php

namespace app\controllers;

use Yii;
use app\models\Manutencao;
use app\models\ManutencaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Veiculo;
use app\models\VeiculoSearch;
use app\models\Utilizador;
use app\models\UtilizadorSearch;
use app\models\RequisicaoSearch;
use app\models\Requisicao;

/**
 * ManutencaoController implements the CRUD actions for Manutencao model.
 */
class ManutencaoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Lists all Manutencao models.
     * @return mixed
     */

    public function actionManutencaoindex()
    {
        $searchModel = new RequisicaoSearch();
        $searchModel->validacao_id = 4;
//        $searchModel->utilizador_id = Utilizador::getCurrentUtilizador()->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('manutencaoindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionManutencao()
    {
        $searchModel = new ManutencaoSearch();
        $searchModel = new VeiculoSearch();
        //mostra apenas os veiculos disponiveis
//        $searchModel->disponibilidade_id = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('manutencao', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new ManutencaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Manutencao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Manutencao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        $model = new Manutencao();

        $requisicao = Requisicao::find()->where(['id'=>$id])->one();
        $modelVeiculo = Veiculo::find()->where(['id'=>$requisicao->veiculo_id])->one();

        $model->requisicao_id = $requisicao->id;

        $model->km_saida = $requisicao->km_chegada;

        $model->data = date('Y-m-d - H:i:s');

        $model->veiculo_id = $requisicao->veiculo_id;


        if ($model->load(Yii::$app->request->post())) {
            $model->utilizador_id = Utilizador::getCurrentUtilizador()->id;


            if ($model->save()) {

                $modelVeiculo->disponibilidade_id  = 1;
                $modelVeiculo->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                throw new Exception("erro");
            }

        }



        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Manutencao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Manutencao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Manutencao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Manutencao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Manutencao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
