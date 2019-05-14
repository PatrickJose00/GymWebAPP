<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subcategoriaproduto".
 *
 * @property integer $id
 * @property string $Nome
 * @property integer $CategoriaProdutos_id
 *
 * @property Produto[] $produtos
 * @property Categoriaproduto $categoriaProdutos
 */
class Subcategoriaproduto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategoriaproduto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'CategoriaProdutos_id'], 'required'],
            [['CategoriaProdutos_id'], 'integer'],
            [['Nome'], 'string', 'max' => 45],
            [['CategoriaProdutos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoriaproduto::className(), 'targetAttribute' => ['CategoriaProdutos_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Nome' => Yii::t('app', 'Subcategoria'),
            'CategoriaProdutos_id' => Yii::t('app', 'Categoria Produto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['SubCategoriaProduto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaProdutos()
    {
        return $this->hasOne(Categoriaproduto::className(), ['id' => 'CategoriaProdutos_id']);
    }
}
