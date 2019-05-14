<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "galeriagym".
 *
 * @property integer $id
 * @property string $Nome
 * @property string $Imagem
 */
class Galeriagym extends \yii\db\ActiveRecord
{
    const SCENARIO_FILE = "create";
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
            ['Imagem', 'required', 'on' => self::SCENARIO_FILE],
            [['Nome'], 'required'],
            [['Imagem'], 'string', 'max' => 5000],
            [['Nome'], 'string', 'max' => 200],
            [['Imagem'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
            'Imagem' => Yii::t('app', 'Imagem'),
        ];
    }
}
