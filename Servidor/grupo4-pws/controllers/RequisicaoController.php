<?php

namespace app\controllers;

use app\models\Manutencao;
use app\models\Utilizador;
use app\models\Veiculo;
use app\models\VeiculoSearch;
use webvimark\modules\UserManagement\models\User;
use Yii;
use app\models\Requisicao;
use app\models\RequisicaoSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Link;
use yii\web\NotFoundHttpException;
use app\models\UtilizadorSearch;
use yii\helpers\Url;

/**
 * RequisicaoController implements the CRUD actions for Requisicao model.
 */
class RequisicaoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'ghost-access' => [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Lists all Requisicao models.
     * @return mixed
     */

    public function actionReqhistorico()
    {
        $searchModel = new RequisicaoSearch();
        $searchModel->utilizador_id = Utilizador::getCurrentUtilizador()->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('reqhistorico', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRequisitarveiculo()
    {
        $searchModel = new VeiculoSearch();
        //mostra apenas os veiculos disponiveis
        $searchModel->disponibilidade_id = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('requisitarveiculo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new RequisicaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //na pagina requisição em recepcionista cancela as requisições do mesmo
        if (User::hasRole('rececionista', false)) {
            $dataProvider->query->andWhere(['not', ['user_id' => \webvimark\modules\UserManagement\models\User::getCurrentUser()->id]]);
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Requisicao model.
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
     * Creates a new Requisicao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null)
    {
        //o $id é subistitudo pelo id do url
        $model = new Requisicao();

        $modelVeiculo = Veiculo::find()->where(['id' =>$id])->one();

        if (isset($id)) {
            $model->veiculo_id = $id;
            $model->utilizador_id= Utilizador::getCurrentUtilizador()->id;
            $model->validacao_id= 3;
            $model->km_chegada = 0;
        }
        if (!isset($model->data_submit_req)) {
            $model->data_submit_req = date('Y-m-d - H:i:s');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->utilizador_id = Utilizador::getCurrentUtilizador()->id;

            $url= Url::to(['/requisicao/view',[ 'id' => $model->id]]);
            if ($model->save()){
                Yii::$app->mailer->compose()
                    ->setFrom('gestaodeviaturas@gmail.com')
                    ->setTo('gestaodeviaturas@gmail.com')
                    ->setSubject('Pedido de Requisição')
                    ->setTextBody('Novo pedido de requisição: '. "\n". 'Requisitante: '.$model->utilizador->nome .' '. $model->utilizador->apelido . "\n".'Número Mecanográfico: '.$model->utilizador->numeroMecanografico. "\n". 'Email: '. $model->utilizador->user->email . "\n". 'Telemóvel: '. $model->utilizador->telemovel . "\n" . 'Data: '. $model->data_req . "\n" .'Motivo: ' .$model->motivo_requisicao . "\n". 'Veículo: '. $model->veiculo->matricula )
                    ->send();
                $modelVeiculo->disponibilidade_id = 3;
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
     * Updates an existing Requisicao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $modelUser= User::find()->where(['id'=>$id])->one();
        $modelVeiculo = Veiculo::find()->where(['id' =>$id])->one();

        $email=$model->utilizador->user->getAttribute('email');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if ($model->validacao_id == 2) {
                    Yii::$app->mailer->compose()
                        ->setFrom('gestaodeviaturas@gmail.com')
                        ->setTo($email)
                        ->setSubject('Pedido de Requisição')
                        ->setTextBody('O seu pedido de requisição foi rejeitado')
                        ->send();
                    $modelVeiculo->disponibilidade_id = 1;
                    $modelVeiculo->save();
                }
                if ($model->validacao_id == 1) {
                    Yii::$app->mailer->compose()
                    ->setFrom('gestaodeviaturas@gmail.com')
                        ->setTo($email)
                        ->setSubject('Pedido de Requisição')
                        ->setTextBody('O seu pedido de requisição foi aceite')
                        ->send();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Requisicao model.
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
     * Finds the Requisicao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Requisicao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Requisicao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
