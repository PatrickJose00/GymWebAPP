<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "aula".
 *
 * @property integer $id
 * @property string $Nome
 * @property string $Descricao
 * @property string $ImageFile
 * @property string $Preco
 * @property integer $Professor_id
 *
 * @property Professor $professor
 * @property Inscricao[] $inscricaos
 * @property Sessao[] $sessaos
 */
class Aula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'aula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['ImageFile', 'required', 'on' => 'create'],
            [['Nome', 'Descricao', 'Preco'], 'required'],
            [['ImageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['Preco'], 'number'],
            [['Nome'], 'string', 'max' => 45],
            [['Professor_id'], 'integer'],
            [['Descricao'], 'string', 'max' => 500],
            [['Professor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Professor::className(), 'targetAttribute' => ['Professor_id' => 'id']],
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
            'ImageFile' => Yii::t('app', 'Imagem'),
            'Preco' => Yii::t('app', 'Preço'),
            'Professor_id' => Yii::t('app', 'Professor'),
        ];
    }

    public function upload($file)
    {
        if ($this->validate()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfessor()
    {
        return $this->hasOne(Professor::className(), ['id' => 'Professor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInscricaos()
    {
        return $this->hasMany(Inscricao::className(), ['Aula_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessaos()
    {
        return $this->hasMany(Sessao::className(), ['Aula_id' => 'id']);
    }
}
