<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categoriaproduto".
 *
 * @property integer $id
 * @property string $Nome
 *
 * @property Subcategoriaproduto[] $subcategoriaprodutos
 */
class Categoriaproduto extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'categoriaproduto';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Nome'], 'required'],
            [['Nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'Nome' => Yii::t('app', 'Categoria'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoriaprodutos() {
        return $this->hasMany(Subcategoriaproduto::className(), ['CategoriaProdutos_id' => 'id']);
    }

    public static function getHierarchy() {
        $options = [];

        $parents = self::find()
                ->innerJoinWith('subcategoriaprodutos', false)
                ->all();
        foreach ($parents as $id => $p) {
            $children = Subcategoriaproduto::find()->where("CategoriaProdutos_id=:c_id", [":c_id" => $p->id])->all();
            $child_options = [];
            foreach ($children as $child) {
                $child_options[$child->id] = $child->Nome;
            }
            $options[$p->Nome] = $child_options;
        }
        return $options;
    }

}
