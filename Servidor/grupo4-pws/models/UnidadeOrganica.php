<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unidadeorganica".
 *
 * @property int $id
 * @property string $unidadeOrganica
 */
class Unidadeorganica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidadeOrganica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unidadeOrganica'], 'required'],
            [['unidadeOrganica'], 'string', 'max' => 45],
            [['unidadeOrganica'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unidadeOrganica' => 'Unidade Organica',
        ];
    }
}
