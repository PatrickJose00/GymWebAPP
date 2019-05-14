<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "professor".
 *
 * @property integer $id
 * @property string $Nome
 * @property integer $BI
 * @property integer $Contribuinte
 * @property string $Email
 * @property integer $DataNascimento
 * @property string $Foto
 *
 * @property Aula[] $aulas
 * @property Sessao[] $sessaos
 */
class Professor extends \yii\db\ActiveRecord
{
    const SCENARIO_FILE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'professor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['Foto', 'required', 'on' => self::SCENARIO_FILE],
            [['BI', 'Contribuinte'], 'unique'],
            [['BI', 'Contribuinte'], 'integer'],
            [['Nome', 'Email', 'DataNascimento', 'BI', 'Contribuinte'], 'required'],
            [['Foto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['DataNascimento'], 'safe'],
            [['Nome', 'Email'], 'string', 'max' => 100],
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
            'BI' => Yii::t('app', 'Bilhete de Entidade'),
            'Contribuinte' => Yii::t('app', 'Contribuinte'),
            'Email' => Yii::t('app', 'Email'),
            'DataNascimento' => Yii::t('app', 'Data de Nascimento'),
            'Foto' => Yii::t('app', 'Foto'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAulas()
    {
        return $this->hasMany(Aula::className(), ['Professor_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessaos()
    {
        return $this->hasMany(Sessao::className(), ['Professor_id' => 'id']);
    }
}
