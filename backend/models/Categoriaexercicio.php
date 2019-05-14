<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categoriaexercicio".
 *
 * @property integer $id
 * @property string $Nome
 *
 * @property Exercicio[] $exercicios
 */
class Categoriaexercicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoriaexercicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome'], 'required'],
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
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['CategoriaExercicio_id' => 'id']);
    }
}
