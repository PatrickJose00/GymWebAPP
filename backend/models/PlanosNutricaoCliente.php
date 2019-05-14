<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "planos_nutricao_cliente".
 *
 * @property integer $id
 * @property integer $Clientes_id
 * @property integer $PlanosdeNutricao_id
 * @property integer $Data
 *
 * @property Cliente $clientes
 * @property Planodenutricao $planosdeNutricao
 */
class PlanosNutricaoCliente extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'planos_nutricao_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['PlanosdeNutricao_id'], 'required'],
            [['PlanosdeNutricao_id'], 'verificarInscricao'],
            [['Clientes_id', 'PlanosdeNutricao_id', 'Data'], 'integer'],
            [['Clientes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Clientes_id' => 'id']],
            [['PlanosdeNutricao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Planodenutricao::className(), 'targetAttribute' => ['PlanosdeNutricao_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Clientes_id' => Yii::t('app', 'Clientes ID'),
            'PlanosdeNutricao_id' => Yii::t('app', 'Planosde Nutricao ID'),
            'Data' => Yii::t('app', 'Data'),
        ];
    }

    public function verificarInscricao($attribute) {
        $cliente_id = Yii::$app->request->get('id');
        if (!empty($cliente_id) && !empty($this->$attribute)) {
            $acesso = PlanosNutricaoCliente::find()->where(['Clientes_id' => $cliente_id])->andWhere(['PlanosdeNutricao_id' => $this->attributes])->one();
            if ($acesso !== null) {
                $this->addError($attribute, 'Este cliente já tem acesso a este plano!');
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes() {
        return $this->hasOne(Cliente::className(), ['id' => 'Clientes_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanosdeNutricao() {
        return $this->hasOne(Planodenutricao::className(), ['id' => 'PlanosdeNutricao_id']);
    }

}
