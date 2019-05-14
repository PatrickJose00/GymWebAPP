<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "galeriainicial".
 *
 * @property integer $id
 * @property string $Imagem
 * @property string $Nome
 */
class Galeriainicial extends \yii\db\ActiveRecord
{
    const SCENARIO_FILE = "create";
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
            'Imagem' => Yii::t('app', 'Imagem'),
            'Nome' => Yii::t('app', 'Nome'),
        ];
    }
}
