<?php

namespace app\models;

use app\models\Requisicao;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UtilizadorSearch;

/**
 * RequisicaoSearch represents the model behind the search form of `app\models\Requisicao`.
 */
class RequisicaoSearch extends Requisicao
{
    public $disponibilidade_id;
    public $modelo_id;
    public $validacao_id;

    public $data_submit_req_from;
    public $data_submit_req_to;

    public $data_req_from;
    public $data_req_to;

    public $data_saida_from;
    public $data_saida_to;

    public $data_chegada_from;
    public $data_chegada_to;

    public $km_saida_min;
    public $km_saida_max;

    public $km_chegada_min;
    public $km_chegada_max;

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['utilizador.nome'], ['veiculo.disponibilidade.estado'], ['disponibilidade_id'],
            ['veiculo.modelo.marca.marca'],['veiculo.modelo.modelo'],['modelo_id'],['marca_id'],
            ['veiculo.matricula'],['validacao_id'],['validacao.estado']);
    }

    public function rules()
    {
        return [
            [['id', 'km_saida', 'km_chegada', 'veiculo_id', 'disponibilidade_id','modelo_id','marca_id','validacao_id'], 'integer'],
            [['data_submit_req','data_req', 'data_saida', 'utilizador.nome', 'data_chegada', 'motivo_requisicao', 'veiculo.disponibilidade.estado',
                'disponibilidade_id', 'veiculo.modelo.marca.marca','veiculo.modelo.modelo','modelo_id','marca_id',
                'veiculo.matricula','validacao_id','validacao.estado','data_req_from','data_req_to',
                'data_saida_from','data_saida_to','data_chegada_from','data_chegada_to',
                'data_submit_req_from','data_submit_req_to'], 'safe'],
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
        $query = Requisicao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['utilizador']);
        $query->joinWith(['veiculo.disponibilidade']);
        $query->joinWith(['veiculo.modelo.marca']);
        $query->joinWith(['veiculo.modelo']);
        $query->joinWith(['veiculo']);
        $query->joinWith(['validacao']);

        $dataProvider->sort->attributes['utilizador.nome'] = [
            'asc' => ['utilizador.nome' => SORT_ASC],
            'desc' => ['utilizador.nome' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['veiculo.disponibilidade.estado'] = [
            'asc' => ['disponibilidade.estado' => SORT_ASC],
            'desc' => ['disponibilidade.estado' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['veiculo.modelo.marca.marca'] = [
            'asc' => ['marca.marca' => SORT_ASC],
            'desc' => ['marca.marca' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['veiculo.modelo.modelo'] = [
            'asc' => ['modelo.modelo' => SORT_ASC],
            'desc' => ['modelo.modelo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['veiculo.matricula'] = [
            'asc' => ['veiculo.matricula' => SORT_ASC],
            'desc' => ['veiculo.matricula' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['validacao.estado'] = [
            'asc' => ['validacao.estado' => SORT_ASC],
            'desc' => ['validacao.estado' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere(['LIKE', 'utilizador.nome', $this->getAttribute('utilizador.nome')]);
        $query->andFilterWhere(['disponibilidade_id' => $this->disponibilidade_id]);
        $query->andFilterWhere(['LIKE', 'marca.marca', $this->getAttribute('veiculo.modelo.marca.marca')]);
        $query->andFilterWhere(['LIKE', 'modelo.modelo', $this->getAttribute('veiculo.modelo.modelo')]);
        $query->andFilterWhere(['LIKE', 'veiculo.matricula', $this->getAttribute('veiculo.matricula')]);
        $query->andFilterWhere(['validacao_id' => $this->validacao_id]);

        $query->andFilterWhere(['>=', 'data_submit_req', $this->data_submit_req_from])
            ->andFilterWhere(['<=', 'data_submit_req', $this->data_submit_req_to]);

        $query->andFilterWhere(['>=', 'data_req', $this->data_req_from])
            ->andFilterWhere(['<=', 'data_req', $this->data_req_to]);

        $query->andFilterWhere(['>=', 'data_saida', $this->data_saida_from])
            ->andFilterWhere(['<=', 'data_saida', $this->data_saida_to]);

        $query->andFilterWhere(['>=', 'data_chegada', $this->data_chegada_from])
            ->andFilterWhere(['<=', 'data_chegada', $this->data_chegada_to]);

        $query->andFilterWhere(['>=', 'km_saida', $this->km_saida_min])
            ->andFilterWhere(['<=', 'km_saida', $this->km_saida_max]);

        $query->andFilterWhere(['>=', 'km_chegada', $this->km_chegada_min])
            ->andFilterWhere(['<=', 'km_chegada', $this->km_chegada_max]);


        $query->andFilterWhere([
            'id' => $this->id,
            'data_req' => $this->data_req,
            'data_saida' => $this->data_saida,
            'data_chegada' => $this->data_chegada,
            'km_saida' => $this->km_saida,
            'km_chegada' => $this->km_chegada,
            'utilizador_id' => $this->utilizador_id,
            'veiculo_id' => $this->veiculo_id,
            'veiculo.modelo.modelo' => $this->modelo_id,
            'validacao_id' => $this->validacao_id,
        ]);
        $query->andFilterWhere(['like', 'motivo_requisicao', $this->motivo_requisicao]);

        return $dataProvider;
    }

}
