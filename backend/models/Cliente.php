<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $id
 * @property string $Nome
 * @property integer $BI
 * @property integer $Contribuinte
 * @property integer $Telefone
 * @property integer $User_id
 * @property integer $DataNascimento
 * @property integer $Genero
 * @property integer $Morada_id
 *
 * @property Morada $morada
 * @property User $user
 * @property PlanoTreinoCliente[] $planoTreinoClientes
 * @property PlanosNutricaoCliente[] $planosNutricaoClientes
 * @property Registo[] $registos
 * @property Seguro[] $seguros
 */
class Cliente extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Nome', 'BI', 'Contribuinte', 'Telefone', 'DataNascimento', 'Genero'], 'required'],
            [['BI', 'Contribuinte', 'Telefone', 'Morada_id', 'Genero'], 'integer'],
            [['User_id'], 'safe'],
            [['DataNascimento'], 'safe'],
            [['Nome'], 'string', 'max' => 45],
            [['Morada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Morada::className(), 'targetAttribute' => ['Morada_id' => 'id']],
            [['User_id'], 'exist', 'skipOnError' => true, 'targetClass' => 'common\models\User', 'targetAttribute' => ['User_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Nome' => Yii::t('app', 'Nome do Cliente'),
            'BI' => Yii::t('app', 'Bilhete de Entidade'),
            'Contribuinte' => Yii::t('app', 'Número de Contribuinte'),
            'Telefone' => Yii::t('app', 'Telefone'),
            'Morada_id' => Yii::t('app', 'Morada'),
            'User_id' => Yii::t('app', 'Número de Cliente'),
            'Seguro' => Yii::t('app', 'Seguro'),
            'Aulas' => Yii::t('app', 'Aulas Inscrito'),
            'Registo' => Yii::t('app', 'Data Registo'),
            'Foto' => Yii::t('app', 'Foto'),
            'Mensalidade' => Yii::t('app', 'Mensalidade'),
            'DataNascimento' => Yii::t('app', 'Data de Nascimento'),
            'Genero' => Yii::t('app', 'Género'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMorada() {
        return $this->hasOne(Morada::className(), ['id' => 'Morada_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'User_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoTreinoClientes() {
        return $this->hasMany(PlanoTreinoCliente::className(), ['Cliente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanosNutricaoClientes() {
        return $this->hasMany(PlanosNutricaoCliente::className(), ['Cliente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegistos() {
        return $this->hasMany(Registo::className(), ['Cliente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeguro() {
        return $this->hasOne(Seguro::className(), ['Cliente_id' => 'id']);
    }

}
