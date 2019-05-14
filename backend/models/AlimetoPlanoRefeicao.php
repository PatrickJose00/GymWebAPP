<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alimeto_plano_refeicao".
 *
 * @property integer $id
 * @property integer $PlanosdeNutricao_id
 * @property integer $Dia
 *
 * @property AlimentoHasAlimetoPlanoRefeicao[] $alimentoHasAlimetoPlanoRefeicaos
 * @property Alimento[] $alimentos
 * @property Planodenutricao $planosdeNutricao
 * @property AlimetoPlanoRefeicaoHasRefeicao[] $alimetoPlanoRefeicaoHasRefeicaos
 * @property Refeicao[] $refeicaos
 */
class AlimetoPlanoRefeicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alimeto_plano_refeicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PlanosdeNutricao_id', 'Dia'], 'required'],
            [['PlanosdeNutricao_id', 'Dia'], 'integer'],
            [['PlanosdeNutricao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planodenutricao::className(), 'targetAttribute' => ['PlanosdeNutricao_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'PlanosdeNutricao_id' => Yii::t('app', 'Planos de Nutricão'),
            'Dia' => Yii::t('app', 'Dia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimentoHasAlimetoPlanoRefeicaos()
    {
        return $this->hasMany(AlimentoHasAlimetoPlanoRefeicao::className(), ['Alimeto_Plano_Refeicao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimentos()
    {
        return $this->hasMany(Alimento::className(), ['id' => 'Alimento_id'])->viaTable('alimento_has_alimeto_plano_refeicao', ['Alimeto_Plano_Refeicao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanosdeNutricao()
    {
        return $this->hasOne(Planodenutricao::className(), ['id' => 'PlanosdeNutricao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimetoPlanoRefeicaoHasRefeicaos()
    {
        return $this->hasMany(AlimetoPlanoRefeicaoHasRefeicao::className(), ['Alimeto_Plano_Refeicao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefeicaos()
    {
        return $this->hasMany(Refeicao::className(), ['id' => 'Refeicao_id'])->viaTable('alimeto_plano_refeicao_has_refeicao', ['Alimeto_Plano_Refeicao_id' => 'id']);
    }
}
