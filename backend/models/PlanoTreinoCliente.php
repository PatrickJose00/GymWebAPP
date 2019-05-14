<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plano_treino_cliente".
 *
 * @property integer $id
 * @property integer $Clientes_id
 * @property integer $Plano_de_Treino_id
 * @property integer $Data
 *
 * @property Cliente $clientes
 * @property PlanoDeTreino $planosDeTreino
 */
class PlanoTreinoCliente extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'plano_treino_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Plano_de_Treino_id'], 'required'],
            [['Plano_de_Treino_id'], 'verificarInscricao'],
            [['Clientes_id', 'Plano_de_Treino_id', 'Data'], 'integer'],
            [['Clientes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Clientes_id' => 'id']],
            [['Plano_de_Treino_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanoDeTreino::className(), 'targetAttribute' => ['Plano_de_Treino_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Clientes_id' => Yii::t('app', 'Cliente'),
            'Plano_de_Treino_id' => Yii::t('app', 'Planos de Treino'),
            'Data' => Yii::t('app', 'Data de Adesão'),
        ];
    }

    public function verificarInscricao($attribute) {
        $cliente_id = Yii::$app->request->get('id');
        if (!empty($cliente_id) && !empty($this->$attribute)) {
            $acesso = PlanoTreinoCliente::find()->where(['Clientes_id' => $cliente_id])->andWhere(['Plano_de_Treino_id' => $this->attributes])->one();
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
    public function getPlanosDeTreino() {
        return $this->hasOne(PlanoDeTreino::className(), ['id' => 'Plano_de_Treino_id']);
    }

}
