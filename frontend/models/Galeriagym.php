<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "galeriagym".
 *
 * @property integer $id
 * @property string $Imagem
 */
class Galeriagym extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'galeriagym';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Imagem'], 'required'],
            [['Imagem'], 'string', 'max' => 5000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'Imagem' => Yii::t('app', 'Imagem'),
        ];
    }
}
