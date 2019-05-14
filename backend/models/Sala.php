<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sala".
 *
 * @property integer $id
 * @property string $Nome
 * @property integer $Lotacao
 *
 * @property Sessao[] $sessaos
 */
class Sala extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sala';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'Lotacao'], 'required'],
            [['Lotacao'], 'integer'],
            [['Nome'], 'string', 'max' => 100],
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
            'Lotacao' => Yii::t('app', 'Lotação'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessaos()
    {
        return $this->hasMany(Sessao::className(), ['Sala_id' => 'id']);
    }
}
