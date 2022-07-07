<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property int $id
 * @property string $modelo
 * @property int $marca_id
 *
 * @property Marca $marca
 * @property Veiculo[] $veiculos
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modelo', 'marca_id'], 'required'],
            [['marca_id'], 'integer'],
            [['modelo'], 'string', 'max' => 45],
            [['modelo'], 'unique'],
            [['marca_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marca::className(), 'targetAttribute' => ['marca_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'modelo' => 'Modelo',
            'marca_id' => 'Marca ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marca::className(), ['id' => 'marca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeiculos()
    {
        return $this->hasMany(Veiculo::className(), ['modelo_id' => 'id']);
    }
}
