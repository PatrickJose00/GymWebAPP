<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property integer $id
 * @property string $Nome
 * @property string $Descricao
 * @property double $Preco
 * @property string $Imagem
 * @property integer $SubCategoriaProduto_id
 *
 * @property Subcategoriaproduto $subCategoriaProduto
 */
class Produto extends \yii\db\ActiveRecord
{
    const SCENARIO_IMAGEM = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['Imagem', 'required', 'on' => self::SCENARIO_IMAGEM],
            [['Nome', 'Descricao', 'Preco', 'SubCategoriaProduto_id'], 'required'],
            [['Descricao'], 'string'],
            [['Preco'], 'number'],
            [['SubCategoriaProduto_id'], 'integer'],
            [['Nome'], 'string', 'max' => 45],
            [['Imagem'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['SubCategoriaProduto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategoriaproduto::className(), 'targetAttribute' => ['SubCategoriaProduto_id' => 'id']],
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
            'Descricao' => Yii::t('app', 'Descrição'),
            'Preco' => Yii::t('app', 'Preço'),
            'Imagem' => Yii::t('app', 'Imagem'),
            'SubCategoriaProduto_id' => Yii::t('app', 'Subcategoria Produto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriaProduto()
    {
        return $this->hasOne(Subcategoriaproduto::className(), ['id' => 'SubCategoriaProduto_id']);
    }
}
