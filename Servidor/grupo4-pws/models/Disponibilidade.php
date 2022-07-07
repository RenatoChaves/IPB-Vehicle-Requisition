<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "disponibilidade".
 *
 * @property int $id
 * @property string $estado
 */
class Disponibilidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disponibilidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['estado'], 'string', 'max' => 45],
            [['estado'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estado' => 'Estado',
        ];
    }
        //novo Gets query for [[Veiculos]].
    /**
     * Gets query for [[Veiculos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVeiculos()
    {
        return $this->hasMany(Veiculo::className(), ['disponibilidade_id' => 'id']);
    }
}
