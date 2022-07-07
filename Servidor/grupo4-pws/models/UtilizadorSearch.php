<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Utilizador;

/**
 * UtilizadorSearch represents the model behind the search form of `app\models\Utilizador`.
 */
class UtilizadorSearch extends Utilizador
{
    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['user.username'],['unidadeOrganica.unidadeOrganica'],['user.email']);
    }

    public function rules()
    {
        return [
            [['id', 'unidadeOrganica_id', 'user_id'], 'integer'],
            [['nome', 'apelido', 'numeroBI', 'numeroMecanografico', 'telemovel',
                'unidadeOrganica.unidadeOrganica', 'user.username', 'user.email'], 'safe'],
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
        $query = Utilizador::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['user']);

        $query->joinWith(['unidadeOrganica']);


        $dataProvider->sort->attributes['user.username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['unidadeOrganica.unidadeOrganica'] = [
            'asc' => ['unidadeOrganica.unidadeOrganica' => SORT_ASC],
            'desc' => ['unidadeOrganica.unidadeOrganica' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user.email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
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
            'unidadeOrganica_id' => $this->unidadeOrganica_id,
            'user_id' => $this->user_id,
        ]);
        $query->andFilterWhere(['LIKE', 'user.username', $this->getAttribute('user.username')]);
        $query->andFilterWhere(['LIKE', 'unidadeOrganica.unidadeOrganica', $this->getAttribute('unidadeOrganica.unidadeOrganica')]);
        $query->andFilterWhere(['LIKE', 'user.email', $this->getAttribute('user.email')]);


        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'apelido', $this->apelido])
            ->andFilterWhere(['like', 'numeroBI', $this->numeroBI])
            ->andFilterWhere(['like', 'numeroMecanografico', $this->numeroMecanografico])
            ->andFilterWhere(['like', 'telemovel', $this->telemovel]);
//            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
