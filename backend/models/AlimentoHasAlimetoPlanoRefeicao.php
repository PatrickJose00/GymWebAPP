<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alimento_has_alimeto_plano_refeicao".
 *
 * @property integer $Alimento_id
 * @property integer $Peso
 * @property integer $Alimeto_Plano_Refeicao_id
 *
 * @property Alimento $alimento
 * @property AlimetoPlanoRefeicao $alimetoPlanoRefeicao
 */
class AlimentoHasAlimetoPlanoRefeicao extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'alimento_has_alimeto_plano_refeicao';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Peso'], 'string'],
//            ['Alimento_id', 'safe'],
//            ['Alimento_id', 'validarAlimento'],
            ['Peso', 'validarPeso'],
            [['Alimento_id', 'Peso'], 'required'],
            [['Alimeto_Plano_Refeicao_id', 'Alimento_id'], 'integer'],
            [['Alimento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Alimento::className(), 'targetAttribute' => ['Alimento_id' => 'id']],
            [['Alimeto_Plano_Refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => AlimetoPlanoRefeicao::className(), 'targetAttribute' => ['Alimeto_Plano_Refeicao_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Alimento_id' => Yii::t('app', 'Alimento'),
            'Alimeto_Plano_Refeicao_id' => Yii::t('app', 'Alimeto  Plano  Refeicao ID'),
            'Peso' => Yii::t('app', 'Peso(s)'),
        ];
    }

    public function validarPeso() {
        $pesos = explode(',', $this->Peso);
        if (count($pesos) != count($this->Alimento_id)) {
            $this->addError('Peso', "A quantidade de pesos tem que ser igual ao número de alimentos selecionados!");
        }
        return true;
    }

    public function validarAlimento($attribute) {
        $alimentos = Yii::$app->request->post('AlimentoHasAlimetoPlanoRefeicao')['Alimento_id'];
        foreach ($alimentos as $alimento) {
            if (!is_numeric($alimento)) {
                $this->addError($attribute, "Alimento inválido!");
            }
        }
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimento() {
        return $this->hasOne(Alimento::className(), ['id' => 'Alimento_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimetoPlanoRefeicao() {
        return $this->hasOne(AlimetoPlanoRefeicao::className(), ['id' => 'Alimeto_Plano_Refeicao_id']);
    }

}
