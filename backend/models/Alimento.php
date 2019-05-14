<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alimento".
 *
 * @property integer $id
 * @property string $Nome
 * @property integer $Quantidade
 * @property string $Proteinas
 * @property string $Lipidos
 * @property string $CarboHidratos
 * @property integer $Calorias
 * @property integer $CategoriaAlimentos_id
 *
 * @property Categoriaalimento $categoriaAlimentos
 * @property AlimentoHasAlimetoPlanoRefeicao[] $alimentoHasAlimetoPlanoRefeicaos
 * @property AlimetoPlanoRefeicao[] $alimetoPlanoRefeicaos
 */
class Alimento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alimento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'Quantidade', 'Proteinas', 'Lipidos', 'CarboHidratos', 'Calorias', 'CategoriaAlimentos_id'], 'required'],
            [['Quantidade', 'Calorias', 'CategoriaAlimentos_id'], 'integer'],
            [['Proteinas', 'Lipidos', 'CarboHidratos'], 'number'],
            [['Nome'], 'string', 'max' => 45],
            [['CategoriaAlimentos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoriaalimento::className(), 'targetAttribute' => ['CategoriaAlimentos_id' => 'id']],
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
            'Quantidade' => Yii::t('app', 'Quantidade'),
            'Proteinas' => Yii::t('app', 'Proteinas'),
            'Lipidos' => Yii::t('app', 'Lipidos'),
            'CarboHidratos' => Yii::t('app', 'Carbo Hidratos'),
            'Calorias' => Yii::t('app', 'Calorias'),
            'CategoriaAlimentos_id' => Yii::t('app', 'Categoria Alimentos ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaAlimentos()
    {
        return $this->hasOne(Categoriaalimento::className(), ['id' => 'CategoriaAlimentos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimentoHasAlimetoPlanoRefeicaos()
    {
        return $this->hasMany(AlimentoHasAlimetoPlanoRefeicao::className(), ['Alimento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimetoPlanoRefeicaos()
    {
        return $this->hasMany(AlimetoPlanoRefeicao::className(), ['id' => 'Alimeto_Plano_Refeicao_id'])->viaTable('alimento_has_alimeto_plano_refeicao', ['Alimento_id' => 'id']);
    }
}
