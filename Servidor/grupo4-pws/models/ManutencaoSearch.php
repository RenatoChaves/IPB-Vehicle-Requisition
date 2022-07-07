<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Manutencao;

/**
 * ManutencaoSearch represents the model behind the search form of `app\models\Manutencao`.
 */
class ManutencaoSearch extends Manutencao
{

    public $marca_id;
    public $modelo_id;
    public $disponibilidade_id;
    public $utilizador_id;

    public $data_from;
    public $data_to;

    public $data_inspecao_from;
    public $data_inspecao_to;

    public function attributes()
    {

        return array_merge(parent::attributes(), ['modelo.marca.marca'], ['modelo.modelo'],

            ['veiculo.matricula'], ['veiculo.disponibilidade.estado'],
            ['disponibilidade_id'], ['marca_id'], ['modelo_id'], ['veiculo.modelo.modelo'],
            ['veiculo.modelo.marca.marca'],['data_from'],['data_to'],['data_inspecao_from'],['data_inspecao_to'],
            ['utilizador_id'],['utilizador.nome']);

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'km_saida', 'km_chegada', 'veiculo_id', 'requisicao_id', 'utilizador_id','disponibilidade_id',
                'marca_id','modelo_id','data_from','data_to','data_inspecao_from','data_inspecao_to'], 'integer'],
            [['data', 'observacoes', 'data_inspecao','utilizador.nome','veiculo.matricula'], 'safe'],
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
        $query = Manutencao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['veiculo.disponibilidade']);
        $query->joinWith(['veiculo']);
        $query->joinWith(['veiculo.modelo']);
        $query->joinWith(['veiculo.modelo.marca']);
        $query->joinWith(['utilizador']);

        $dataProvider->sort->attributes['veiculo.disponibilidade.estado'] = [
            'asc' => ['disponibilidade.estado' => SORT_ASC],
            'desc' => ['disponibilidade.estado' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['veiculo.matricula'] = [
            'asc' => ['veiculo.matricula' => SORT_ASC],
            'desc' => ['veiculo.matricula' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['veiculo.modelo.modelo'] = [
            'asc' => ['modelo.modelo' => SORT_ASC],
            'desc' => ['modelo.modelo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['veiculo.modelo.marca.marca'] = [
            'asc' => ['marca.marca' => SORT_ASC],
            'desc' => ['marca.marca' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['utilizador.nome'] = [
            'asc' => ['utilizador.nome' => SORT_ASC],
            'desc' => ['utilizador.nome' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['disponibilidade_id' => $this->disponibilidade_id]);
        $query->andFilterWhere(['LIKE', 'matricula', $this->veiculo_id]);
        $query->andFilterWhere(['LIKE', 'modelo_id', $this->modelo_id]);
        $query->andFilterWhere(['LIKE', 'marca_id', $this->marca_id]);
        $query->andFilterWhere(['LIKE', 'nome', $this->utilizador_id]);


        $query->andFilterWhere(['>=', 'data', $this->data_from])
            ->andFilterWhere(['<=', 'data', $this->data_to]);

        $query->andFilterWhere(['>=', 'data_inspecao', $this->data_inspecao_from])
            ->andFilterWhere(['<=', 'data_inspecao', $this->data_inspecao_to]);


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data' => $this->data,
            'km_saida' => $this->km_saida,
            'km_chegada' => $this->km_chegada,
            'data_inspecao' => $this->data_inspecao,
            'veiculo_id' => $this->veiculo_id,
            'requisicao_id' => $this->requisicao_id,
            'utilizador_id' => $this->utilizador_id,
        ]);

        $query->andFilterWhere(['like', 'observacoes', $this->observacoes]);

        return $dataProvider;
    }
}
