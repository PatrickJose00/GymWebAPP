<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sessao".
 *
 * @property integer $id
 * @property integer $PrimeiraSessao
 * @property integer $SegundaSessao
 * @property integer $Duracao
 * @property string $Descricao
 * @property integer $Sala_id
 * @property integer $Aula_id
 *
 * @property Aula $aula
 * @property Sala $sala
 */
class Sessao extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sessao';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['PrimeiraSessao', 'SegundaSessao', 'Descricao', 'Sala_id', 'Aula_id'], 'required'],
            [['Sala_id', 'Aula_id'], 'integer'],
            [['PrimeiraSessao', 'SegundaSessao', 'Duracao'], 'safe'],
            [['Descricao'], 'string', 'max' => 150],
            [['Aula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aula::className(), 'targetAttribute' => ['Aula_id' => 'id']],
            [['Sala_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sala::className(), 'targetAttribute' => ['Sala_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'PrimeiraSessao' => Yii::t('app', 'Primeira Sessão'),
            'SegundaSessao' => Yii::t('app', 'Segunda Sessão'),
            'Duracao' => Yii::t('app', 'Duração'),
            'Descricao' => Yii::t('app', 'Descrição'),
            'Sala_id' => Yii::t('app', 'Sala'),
            'Aula_id' => Yii::t('app', 'Aula'),
        ];
    }

    function convertHoursToSeconds() {
        $hours = $this->Duracao;
        $minutes = 0;
        if (strpos($hours, ':')) {
            list($hours, $minutes) = explode(':', $hours);
        }
        $newMinutes = $hours * 60 + $minutes;
        $seconds = $newMinutes * 60;
        return $seconds;
    }

    function dateSort($a, $b) {
        return strtotime($a) - strtotime($b);
    }

    public static function traduzirDiaSemana($dia) {
        switch ($dia):
            case "Monday":
                return "Segunda";
                break;
            case "Tuesday":
                return "Terça";
                break;
            case "Wednesday":
                return "Quarta";
                break;
            case "Thursday":
                return "Quinta";
                break;
            case "Friday":
                return "Sexta";
                break;
            case "Saturday":
                return "Sábado";
                break;
            case "Sunday":
                return "Domingo";
                break;
        endswitch;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAula() {
        return $this->hasOne(Aula::className(), ['id' => 'Aula_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala() {
        return $this->hasOne(Sala::className(), ['id' => 'Sala_id']);
    }

}
