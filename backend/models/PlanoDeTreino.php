<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plano_de_treino".
 *
 * @property integer $id
 * @property string $Nome
 *
 * @property ExercicioPlano[] $exercicioPlanos
 * @property PlanoTreinoCliente[] $planoTreinoClientes
 */
class PlanoDeTreino extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plano_de_treino';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome'], 'required'],
            [['Nome'], 'unique'],
            [['Nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Nome' => Yii::t('app', 'Nome'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicioPlanos()
    {
        return $this->hasMany(ExercicioPlano::className(), ['Plano_de_Treino_id' => 'id'])->orderBy('Dia asc');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoTreinoClientes()
    {
        return $this->hasMany(PlanoTreinoCliente::className(), ['Plano_de_Treino_id' => 'id']);
    }
}
