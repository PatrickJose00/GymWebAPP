<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seguro".
 *
 * @property integer $id
 * @property integer $Renovacao
 * @property integer $DataCriacao
 * @property integer $Estado
 * @property integer $Cliente_id
 *
 * @property Cliente $cliente
 */
class Seguro extends \yii\db\ActiveRecord {

    const STATUS_SEGURO = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'seguro';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['Estado', 'default', 'value' => self::STATUS_SEGURO],
            [['DataCriacao', 'Estado', 'Cliente_id', 'Renovacao'], 'integer'],
            [['Cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Cliente_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'DataCriacao' => Yii::t('app', 'Data de Criação'),
            'Estado' => Yii::t('app', 'Estado'),
            'Renovacao' => Yii::t('app', 'Renovação'),
            'Cliente_id' => Yii::t('app', 'Cliente'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente() {
        return $this->hasOne(Cliente::className(), ['id' => 'Cliente_id']);
    }

    public function signupSeguro() {
        if (!$this->validate()) {
            return null;
        }

        $seguro = new Morada();
        $morada->Endereco = $this->Endereco;
        $morada->Latitude = $this->Latitude;
        $morada->Longitude = $this->Longitude;

        return $morada->save() ? $morada : null;
    }
}
