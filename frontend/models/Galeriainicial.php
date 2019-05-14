<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "galeriainicial".
 *
 * @property integer $id
 * @property string $Imagem
 */
class Galeriainicial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'galeriainicial';
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
