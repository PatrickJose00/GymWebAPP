<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "presenca".
 *
 * @property integer $id
 * @property integer $Data_Hora
 * @property integer $Mensalidade_id
 *
 * @property Mensalidade $mensalidade
 */
class Presenca extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'presenca';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Data_Hora', 'Mensalidade_id'], 'integer'],
            [['Mensalidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mensalidade::className(), 'targetAttribute' => ['Mensalidade_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Data_Hora' => Yii::t('app', 'Data  Hora'),
            'Mensalidade_id' => Yii::t('app', 'Mensalidade ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensalidade() {
        return $this->hasOne(Mensalidade::className(), ['id' => 'Mensalidade_id']);
    }

}
