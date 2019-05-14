<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alimeto_plano_refeicao_has_refeicao".
 *
 * @property integer $Alimeto_Plano_Refeicao_id
 * @property integer $Refeicao_id
 *
 * @property AlimetoPlanoRefeicao $alimetoPlanoRefeicao
 * @property Refeicao $refeicao
 */
class AlimetoPlanoRefeicaoHasRefeicao extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'alimeto_plano_refeicao_has_refeicao';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Refeicao_id'], 'required'],
            [['Alimeto_Plano_Refeicao_id', 'Refeicao_id'], 'integer'],
            [['Alimeto_Plano_Refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlimetoPlanoRefeicao::className(), 'targetAttribute' => ['Alimeto_Plano_Refeicao_id' => 'id']],
            [['Refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Refeicao::className(), 'targetAttribute' => ['Refeicao_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Alimeto_Plano_Refeicao_id' => Yii::t('app', 'Alimento Plano Refeição'),
            'Refeicao_id' => Yii::t('app', 'Horário Refeição'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimetoPlanoRefeicao() {
        return $this->hasOne(AlimetoPlanoRefeicao::className(), ['id' => 'Alimeto_Plano_Refeicao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefeicao() {
        return $this->hasOne(Refeicao::className(), ['id' => 'Refeicao_id']);
    }

}
