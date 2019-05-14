<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categoriaalimento".
 *
 * @property integer $id
 * @property string $Nome
 *
 * @property Alimento[] $alimentos
 */
class Categoriaalimento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoriaalimento';
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
    public function getAlimentos()
    {
        return $this->hasMany(Alimento::className(), ['CategoriaAlimentos_id' => 'id']);
    }

    public static function getHierarchy() {
        $options = [];

        $parents = self::find()
                ->innerJoinWith('alimentos', false)
                ->all();

        foreach ($parents as $id => $p) {
            $children = Alimento::find()->where("CategoriaAlimentos_id=:c_id", [":c_id" => $p->id])->all();
            $child_options = [];
            foreach ($children as $child) {
                    $child_options[$child->id] = $child->Nome;
            }
            $options[$p->Nome] = $child_options;
        }
        return $options;
    }
}
