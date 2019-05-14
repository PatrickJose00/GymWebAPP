<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exercicio".
 *
 * @property integer $id
 * @property string $Nome
 * @property string $Descricao
 * @property integer $CategoriaExercicio_id
 * @property string $Foto
 *
 * @property Categoriaexercicio $categoriaExercicio
 * @property ExercicioPlano $exercicioPlano
 */
class Exercicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exercicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'Descricao', 'CategoriaExercicio_id', 'Foto'], 'required'],
            [['CategoriaExercicio_id'], 'integer'],
            [['Nome', 'Descricao'], 'string', 'max' => 45],
            [['Foto'], 'string', 'max' => 500],
            [['CategoriaExercicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoriaexercicio::className(), 'targetAttribute' => ['CategoriaExercicio_id' => 'id']],
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
            'Descricao' => Yii::t('app', 'Descricao'),
            'CategoriaExercicio_id' => Yii::t('app', 'Categoria Exercício'),
            'Foto' => Yii::t('app', 'Foto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaExercicio()
    {
        return $this->hasOne(Categoriaexercicio::className(), ['id' => 'CategoriaExercicio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicioPlano()
    {
        return $this->hasOne(ExercicioPlano::className(), ['Exercicios_id' => 'id']);
    }
}
