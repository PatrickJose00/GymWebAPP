<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "planodenutricao".
 *
 * @property integer $id
 * @property string $Nome
 *
 * @property AlimetoPlanoRefeicao[] $alimetoPlanoRefeicaos
 * @property PlanosNutricaoCliente[] $planosNutricaoClientes
 */
class Planodenutricao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planodenutricao';
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
    public function getAlimetoPlanoRefeicaos()
    {
        return $this->hasMany(AlimetoPlanoRefeicao::className(), ['PlanosdeNutricao_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanosNutricaoClientes()
    {
        return $this->hasMany(PlanosNutricaoCliente::className(), ['PlanosdeNutricao_id' => 'id']);
    }
}
