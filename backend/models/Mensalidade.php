<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mensalidade".
 *
 * @property integer $id
 * @property integer $Registo_id
 * @property integer $Pack_id
 * @property integer $NumeroEntradas
 * @property string $Preco
 *
 * @property Pack $pack
 * @property Registo $registo
 * @property Presenca[] $presencas
 */
class Mensalidade extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'mensalidade';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Pack_id'], 'required'],
            [['Registo_id', 'Pack_id', 'NumeroEntradas'], 'integer'],
            [['Preco'], 'number'],
            [['Pack_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pack::className(), 'targetAttribute' => ['Pack_id' => 'id']],
            [['Registo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Registo::className(), 'targetAttribute' => ['Registo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Registo_id' => Yii::t('app', 'Registo'),
            'Pack_id' => Yii::t('app', 'Mensalidades'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPack() {
        return $this->hasOne(Pack::className(), ['id' => 'Pack_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisto() {
        return $this->hasOne(Registo::className(), ['id' => 'Registo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresencas() {
        return $this->hasMany(Presenca::className(), ['Mensalidade_id' => 'id']);
    }

}
