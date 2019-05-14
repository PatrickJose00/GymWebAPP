<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "refeicao".
 *
 * @property integer $id
 * @property integer $Hora
 *
 * @property AlimetoPlanoRefeicaoHasRefeicao[] $alimetoPlanoRefeicaoHasRefeicaos
 * @property AlimetoPlanoRefeicao[] $alimetoPlanoRefeicaos
 */
class Refeicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refeicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Hora'], 'required'],
            [['Hora'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Hora' => Yii::t('app', 'Hora'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimetoPlanoRefeicaoHasRefeicaos()
    {
        return $this->hasMany(AlimetoPlanoRefeicaoHasRefeicao::className(), ['Refeicao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimetoPlanoRefeicaos()
    {
        return $this->hasMany(AlimetoPlanoRefeicao::className(), ['id' => 'Alimeto_Plano_Refeicao_id'])->viaTable('alimeto_plano_refeicao_has_refeicao', ['Refeicao_id' => 'id']);
    }
}
