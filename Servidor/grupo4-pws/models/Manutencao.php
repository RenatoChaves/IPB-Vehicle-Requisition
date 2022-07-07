<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manutencao".
 *
 * @property int $id
 * @property string $data
 * @property int $km_saida
 * @property int $km_chegada
 * @property string $observacoes
 * @property string $data_inspecao
 * @property int $veiculo_id
 * @property int $requisicao_id
 * @property int $utilizador_id
 *
 * @property Requisicao $requisicao
 * @property Utilizador $utilizador
 * @property Veiculo $veiculo
 */
class Manutencao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manutencao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data', 'km_saida', 'km_chegada', 'observacoes', 'data_inspecao', 'veiculo_id', 'requisicao_id', 'utilizador_id'], 'required'],
            [['data', 'data_inspecao'], 'safe'],
            [['km_saida', 'km_chegada', 'veiculo_id', 'requisicao_id', 'utilizador_id'], 'integer'],
            [['observacoes'], 'string', 'max' => 500],
            [['requisicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicao::className(), 'targetAttribute' => ['requisicao_id' => 'id']],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::className(), 'targetAttribute' => ['utilizador_id' => 'id']],
            [['veiculo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Veiculo::className(), 'targetAttribute' => ['veiculo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'km_saida' => 'Km Saida',
            'km_chegada' => 'Km Chegada',
            'observacoes' => 'Observacoes',
            'data_inspecao' => 'Data Inspecao',
            'veiculo_id' => 'Veiculo ID',
            'requisicao_id' => 'Requisicao ID',
            'utilizador_id' => 'Utilizador ID',
        ];
    }

    /**
     *  Gets query for [[Requisicao]].
     * @return \yii\db\ActiveQuery
     */
    public function getRequisicao()
    {
        return $this->hasOne(Requisicao::className(), ['id' => 'requisicao_id']);
    }

    /**
     *  Gets query for [[Utilizador]].
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::className(), ['id' => 'utilizador_id']);
    }

    /**
     *  Gets query for [[Veiculo]].
     * @return \yii\db\ActiveQuery
     */
    public function getVeiculo()
    {
        return $this->hasOne(Veiculo::className(), ['id' => 'veiculo_id']);
    }

    public static function getCurrentKm_chegada()
    {
        return Requisicao::find()->where(['requisicao.km_chegada'=> 'km_chegada'])->one();
    }

}
