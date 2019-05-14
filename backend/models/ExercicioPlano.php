<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exercicio_plano".
 *
 * @property integer $id
 * @property integer $Exercicios_id
 * @property integer $Repeticoes
 * @property integer $Carga
 * @property integer $Pausa
 * @property integer $Dia
 * @property integer $Series
 * @property integer $Plano_de_Treino_id
 *
 * @property PlanoDeTreino $planoDeTreino
 * @property Exercicio $exercicios
 */
class ExercicioPlano extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'exercicio_plano';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Exercicios_id', 'Repeticoes', 'Carga', 'Pausa', 'Series', 'Plano_de_Treino_id', 'Dia'], 'integer'],
            [['Exercicios_id', 'Plano_de_Treino_id', 'Repeticoes', 'Carga', 'Pausa', 'Series', 'Dia'], 'required'],
//            [['Exercicios_id'], 'unique'],
            [['Plano_de_Treino_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanoDeTreino::className(), 'targetAttribute' => ['Plano_de_Treino_id' => 'id']],
            [['Exercicios_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicio::className(), 'targetAttribute' => ['Exercicios_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Exercicios_id' => Yii::t('app', 'Exercícios'),
            'Repeticoes' => Yii::t('app', 'Repetições'),
            'Carga' => Yii::t('app', 'Carga'),
            'Pausa' => Yii::t('app', 'Pausa'),
            'Series' => Yii::t('app', 'Séries'),
            'Plano_de_Treino_id' => Yii::t('app', 'Plano de Treino'),
            'Dia' => Yii::t('app', 'Dia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanoDeTreino() {
        return $this->hasOne(PlanoDeTreino::className(), ['id' => 'Plano_de_Treino_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios() {
        return $this->hasOne(Exercicio::className(), ['id' => 'Exercicios_id']);
    }

}
