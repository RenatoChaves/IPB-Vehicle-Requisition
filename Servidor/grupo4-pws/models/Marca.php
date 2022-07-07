<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property int $id
 * @property string $marca
 *
 * @property Modelo[] $modelos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca'], 'required'],
            [['marca'], 'string', 'max' => 45],
            [['marca'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marca' => 'Marca',
        ];
    }

    /**
     * Gets query for [[Modelos]].
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasMany(Modelo::className(), ['marca_id' => 'id']);
    }
}
