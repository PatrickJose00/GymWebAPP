<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pack".
 *
 * @property integer $id
 * @property string $Nome
 * @property string $Descricao
 * @property string $Preco
 * @property integer $NumeroEntradas
 *
 * @property Mensalidade[] $mensalidades
 */
class Pack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pack';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'Descricao', 'Preco', 'NumeroEntradas'], 'required'],
            [['Preco'], 'number'],
            [['Nome'], 'string', 'max' => 100],
            [['Descricao'], 'string', 'max' => 200],
            [['NumeroEntradas'], 'integer'],
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
            'Descricao' => Yii::t('app', 'Descrição'),
            'Preco' => Yii::t('app', 'Preço'),
            'NumeroEntradas' => Yii::t('app', 'Número Entradas'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensalidades()
    {
        return $this->hasMany(Mensalidade::className(), ['Pack_id' => 'id']);
    }
}
