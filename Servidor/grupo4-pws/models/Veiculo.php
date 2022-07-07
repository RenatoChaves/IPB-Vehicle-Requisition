<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veiculo".
 *
 * @property int $id
 * @property string $matricula
 * @property string $cor
 * @property string $capacidade_bagageira
 * @property string $lugares
 * @property int $modelo_id
 * @property int $tipoCombustivel_id
 * @property int $disponibilidade_id
 *
 * @property Manutencao[] $manutencaos
 * @property Requisicao[] $requisicaos
 * @property Disponibilidade $disponibilidade
 * @property Modelo $modelo
 * @property TipoCombustivel $tipoCombustivel
 */

class Veiculo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'veiculo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matricula', 'cor', 'capacidade_bagageira', 'lugares', 'modelo_id', 'tipoCombustivel_id', 'disponibilidade_id'], 'required'],
            [['modelo_id', 'tipoCombustivel_id', 'disponibilidade_id'], 'integer'],
            [['matricula', 'cor', 'capacidade_bagageira', 'lugares'], 'string', 'max' => 45],
            [['matricula'], 'unique'],
            [['disponibilidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Disponibilidade::className(), 'targetAttribute' => ['disponibilidade_id' => 'id']],
            [['modelo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['modelo_id' => 'id']],
            [['tipoCombustivel_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoCombustivel::className(), 'targetAttribute' => ['tipoCombustivel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'matricula' => 'Matricula',
            'cor' => 'Cor',
            'capacidade_bagageira' => 'Capacidade Bagageira',
            'lugares' => 'Lugares',
            'modelo_id' => 'Modelo ID',
            'tipoCombustivel_id' => 'Tipo Combustivel ID',
            'disponibilidade_id' => 'Disponibilidade ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManutencaos()
    {
        return $this->hasMany(Manutencao::className(), ['veiculo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequisicaos()
    {
        return $this->hasMany(Requisicao::className(), ['veiculo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisponibilidade()
    {
        return $this->hasOne(Disponibilidade::className(), ['id' => 'disponibilidade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModelo()
    {
        return $this->hasOne(Modelo::className(), ['id' => 'modelo_id']);
    }

    public function getMarca()
    {
        return $this->hasOne(Marca::className(), ['id' => 'marca_id'])->via('modelo');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoCombustivel()
    {
        return $this->hasOne(TipoCombustivel::className(), ['id' => 'tipoCombustivel_id']);
    }
}
