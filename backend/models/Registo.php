<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "registo".
 *
 * @property integer $id
 * @property integer $Data
 * @property string $OutrosDetalhes
 * @property integer $Cliente_id
 * @property integer $Estado
 *
 * @property Inscricao[] $inscricaos
 * @property Mensalidade[] $mensalidades
 * @property Cliente $cliente
 */
class Registo extends \yii\db\ActiveRecord {

    const STATUS_ACTIVE = 1;
    const SCENARIO_MODALIDADE = "modalidade";
    const SCENARIO_AULAS = "aulas";

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'registo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['Estado', 'default', 'value' => self::STATUS_ACTIVE],
            [['Data', 'Cliente_id', 'Estado'], 'integer'],
            [['Cliente_id'], 'required'],
            [['Cliente_id'], 'verificaRegistoMensalidade', 'on' => self::SCENARIO_MODALIDADE],
            [['Cliente_id'], 'verificaRegistoAulas', 'on' => self::SCENARIO_AULAS],
            [['OutrosDetalhes'], 'string', 'max' => 200],
            [['Cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['Cliente_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Data' => Yii::t('app', 'Data'),
            'OutrosDetalhes' => Yii::t('app', 'Outros Detalhes'),
            'Cliente_id' => Yii::t('app', 'Cliente'),
            'Estado' => Yii::t('app', 'Estado'),
        ];
    }

    public static function checkNextMonth($data) {
        $nextMonth = false;
        $currentTime = time();
        $firstDayNextMonth = date('Y-m-d', strtotime('first day of next month', $data));
        if ($currentTime > strtotime($firstDayNextMonth)) {
            $nextMonth = true;
        }
        return $nextMonth;
    }

    public function verificaRegistoMensalidade($attribute) {
        $registo = Registo::find()->where([$attribute => $this->$attribute])->andWhere(['Estado' => 1])->all();
        foreach ($registo as $r) {
            if (!empty($r->mensalidades)) {
                $this->addError($attribute, "Este cliente já se encontra registado numa modalidade");
                return false;
            }
        }
        return true;
    }

    public function verificaRegistoAulas($attribute) {
        $registo = Registo::find()->where([$attribute => $this->$attribute])->andWhere(['Estado' => 1])->all();
        $aulas = Yii::$app->request->post('Inscricao')['Aula_id'];
        foreach ($registo as $r) {
            if (!empty($r->inscricaos)) {
                foreach ($r->inscricaos as $inscr) {
                    foreach ($aulas as $aula) {
                        if ($inscr->Aula_id == $aula) {
                            $this->addError($attribute, "Este cliente já se encontra registado na aula de " . $inscr->aula->Nome);
                            return false;
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos() {
        return $this->hasMany(Inscricao::className(), ['Registo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensalidades() {
        return $this->hasMany(Mensalidade::className(), ['Registo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente() {
        return $this->hasOne(Cliente::className(), ['id' => 'Cliente_id']);
    }

}
