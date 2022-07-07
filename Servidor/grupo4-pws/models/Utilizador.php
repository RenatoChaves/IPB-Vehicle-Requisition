<?php

namespace app\models;

use Yii;
use webvimark\modules\UserManagement\models\User;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $id
 * @property string $nome
 * @property string $apelido
 * @property string $numeroBI
 * @property string $numeroMecanografico
 * @property string $telemovel
 * @property int $unidadeOrganica_id
 * @property int $user_id
 *
 * @property Manutencao[] $manutencaos
 * @property Requisicao[] $requisicaos
 * @property UnidadeOrganica $unidadeOrganica
 * @property User $user
 */
class Utilizador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'apelido', 'numeroBI', 'numeroMecanografico', 'telemovel', 'unidadeOrganica_id', 'user_id'], 'required'],
            [['unidadeOrganica_id', 'user_id'], 'integer'],
            [['nome', 'apelido', 'numeroBI', 'numeroMecanografico', 'telemovel'], 'string', 'max' => 45],
            [['numeroBI'], 'unique'],
            [['numeroMecanografico'], 'unique'],
            [['telemovel'], 'unique'],
            [['unidadeOrganica_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadeOrganica::className(), 'targetAttribute' => ['unidadeOrganica_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'apelido' => 'Apelido',
            'numeroBI' => 'Numero Bi',
            'numeroMecanografico' => 'Numero Mecanografico',
            'telemovel' => 'Telemovel',
            'unidadeOrganica_id' => 'Unidade Organica ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManutencaos()
    {
        return $this->hasMany(Manutencao::className(), ['utilizador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequisicaos()
    {
        return $this->hasMany(Requisicao::className(), ['utilizador_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeOrganica()
    {
        return $this->hasOne(UnidadeOrganica::className(), ['id' => 'unidadeOrganica_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
//função para ir buscar o id do utilizador com o id do user do RBAC
    public static function getCurrentUtilizador()
    {
        return Utilizador::find()->where(['user_id'=>Yii::$app->user->id])->one();
    }
}
