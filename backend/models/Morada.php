<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "morada".
 *
 * @property integer $id
 * @property string $Endereco
 * @property string $Latitude
 * @property string $Longitude
 *
 * @property Cliente[] $clientes
 */
class Morada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'morada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['Latitude', 'Longitude'], 'number'],
            [['Endereco'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Endereco' => Yii::t('app', 'Endereço'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'Longitude' => Yii::t('app', 'Longitude'),
        ];
    }

    public function signupMorada()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $morada = new Morada();
        $morada->Endereco = $this->Endereco;
        $morada->Latitude = $this->Latitude;
        $morada->Longitude = $this->Longitude;
        
        return $morada->save() ? $morada : null;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['Morada_id' => 'id']);
    }
}
