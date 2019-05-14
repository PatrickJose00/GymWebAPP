<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inscricao".
 *
 * @property integer $id
 * @property integer $Aula_id
 * @property integer $Registo_id
 * @property string $Preco
 *
 * @property Aula $aula
 * @property Registo $registo
 */
class Inscricao extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'inscricao';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Aula_id'], 'required'],
            [['Aula_id', 'Registo_id'], 'integer'],
            [['Preco'], 'number'],
            [['Aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::className(), 'targetAttribute' => ['Aula_id' => 'id']],
            [['Registo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Registo::className(), 'targetAttribute' => ['Registo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Aula_id' => Yii::t('app', 'Aulas'),
            'Registo_id' => Yii::t('app', 'Registo ID'),
            'Preco' => Yii::t('app', 'Preço'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAula() {
        return $this->hasOne(Aula::className(), ['id' => 'Aula_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisto() {
        return $this->hasOne(Registo::className(), ['id' => 'Registo_id']);
    }

}
