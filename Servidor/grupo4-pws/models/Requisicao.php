<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requisicao".
 *
 * @property int $id
 * @property string $data_req
 * @property string $motivo_requisicao
 * @property string $data_submit_req
 * @property string|null $data_saida
 * @property string|null $data_chegada
 * @property int|null $km_saida
 * @property int $km_chegada
 * @property string|null $validador
 * @property int $utilizador_id
 * @property int $veiculo_id
 * @property int $validacao_id
 *
 * @property Manutencao[] $manutencaos
 * @property Utilizador $utilizador
 * @property Validacao $validacao
 * @property Veiculo $veiculo
 */
class Requisicao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requisicao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_req', 'data_submit_req', 'motivo_requisicao', 'km_chegada', 'utilizador_id', 'veiculo_id', 'validacao_id'], 'required'],
            [['data_req', 'data_submit_req', 'data_saida', 'data_chegada'], 'safe'],
            [['km_saida', 'km_chegada', 'utilizador_id', 'veiculo_id', 'validacao_id'], 'integer'],
            [['motivo_requisicao'], 'string', 'max' => 500],
            [['validador'], 'string', 'max' => 45],
            [['utilizador_id'], 'exist', 'skipOnError' => true, 'targetClass' => Utilizador::className(), 'targetAttribute' => ['utilizador_id' => 'id']],
            [['validacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Validacao::className(), 'targetAttribute' => ['validacao_id' => 'id']],
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
            'data_req' => 'Data Req',
            'data_submit_req' => 'Data Submit Req',
            'data_saida' => 'Data Saida',
            'data_chegada' => 'Data Chegada',
            'motivo_requisicao' => 'Motivo Requisicao',
            'km_saida' => 'Km Saida',
            'km_chegada' => 'Km Chegada',
            'validador' => 'Validador',
            'utilizador_id' => 'Utilizador ID',
            'veiculo_id' => 'Veiculo ID',
            'validacao_id' => 'Validacao ID',
        ];
    }

    /**
     * Gets query for [[Manutencaos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManutencaos()
    {
        return $this->hasMany(Manutencao::className(), ['requisicao_id' => 'id']);
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(Utilizador::className(), ['id' => 'utilizador_id']);
    }

    /**
     * Gets query for [[Validacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValidacao()
    {
        return $this->hasOne(Validacao::className(), ['id' => 'validacao_id']);
    }

    /**
     * Gets query for [[Veiculo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVeiculo()
    {
        return $this->hasOne(Veiculo::className(), ['id' => 'veiculo_id']);
    }
}
