<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Veiculo;
use yii\data\Pagination;

/**
 * VeiculoSearch represents the model behind the search form of `app\models\Veiculo`.
 */
class VeiculoSearch extends Veiculo
{

    public $disponibilidade_id;
    public $modelo_id;
    public $marca_id;

    /**
     * {@inheritdoc}
     */

    public function attributes()
    {

        return array_merge(parent::attributes(), ['modelo.marca.marca'], ['modelo.modelo'],

            ['tipoCombustivel.tipo'], ['disponibilidade.estado'],
            ['disponibilidade_id'], ['marca_id'], ['modelo_id']);

    }

    public function rules()
    {
        return [
            [['id', 'modelo_id', 'tipoCombustivel_id', 'disponibilidade_id','modelo_id','marca_id'], 'integer'],
            [['matricula', 'cor', 'capacidade_bagageira', 'lugares', 'modelo.marca.marca',
                'modelo.modelo', 'tipoCombustivel.tipo',
                'disponibilidade.estado'], 'safe'],
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
        $query = Veiculo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['modelo.marca']);

        $query->joinWith(['modelo']);

        $query->joinWith(['tipoCombustivel']);

        $query->joinWith(['disponibilidade']);


        $dataProvider->sort->attributes['modelo.modelo'] = [
            'asc' => ['modelo.modelo' => SORT_ASC],
            'desc' => ['modelo.modelo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['modelo.marca.marca'] = [
            'asc' => ['marca.marca' => SORT_ASC],
            'desc' => ['marca.marca' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tipoCombustivel.tipo'] = [
            'asc' => ['tipoCombustivel.tipo' => SORT_ASC],
            'desc' => ['tipoCombustivel.tipo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['disponibilidade.estado'] = [
            'asc' => ['disponibilidade.estado' => SORT_ASC],
            'desc' => ['disponibilidade.estado' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'modelo_id' => $this->modelo_id,
            'tipoCombustivel_id' => $this->tipoCombustivel_id,
            'disponibilidade_id' => $this->disponibilidade_id,
        ]);

        $query->andFilterWhere(['LIKE', 'modelo.marca.marca', $this->getAttribute('modelo.marca.marca')]);
        $query->andFilterWhere(['LIKE', 'modelo.modelo', $this->getAttribute('modelo.modelo')]);
        $query->andFilterWhere(['LIKE', 'tipoCombustivel.tipo', $this->getAttribute('tipoCombustivel.tipo')]);
        $query->andFilterWhere(['disponibilidade_id' => $this->disponibilidade_id]);
        $query->andFilterWhere(['modelo_id' => $this->modelo_id]);
        $query->andFilterWhere(['modelo.marca_id' => $this->marca_id]);
        $query->andFilterWhere(['tipoCombustivel_id' =>$this->tipoCombustivel_id]);


        $query->andFilterWhere(['like', 'matricula', $this->matricula])
            ->andFilterWhere(['like', 'cor', $this->cor])
            ->andFilterWhere(['like', 'capacidade_bagageira', $this->capacidade_bagageira])
            ->andFilterWhere(['like', 'lugares', $this->lugares]);

        return $dataProvider;
    }
}
