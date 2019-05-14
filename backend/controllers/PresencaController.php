<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\Presenca;
use backend\models\Pack;
use backend\models\Mensalidade;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class PresencaController extends Controller {

    const MAX_PRESENCAS_AULAS = 6;

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['adicionar-presenca'],
                'rules' => [
                    // deny all POST requests
                    [
                        'allow' => true,
                        'verbs' => ['POST']
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    public function actionAdicionarPresenca($idRegisto) {
        if (Yii::$app->request->isAjax && !Yii::$app->user->isGuest) {
            $mensalidade = Mensalidade::find()
                    ->where(['Registo_id' => $idRegisto])
                    ->one();

            if ($mensalidade->NumeroEntradas != 0) { //não marca presencas nos packs sem limite de entrada
                if ($this->totalPresencas($mensalidade->id) < $mensalidade->NumeroEntradas) {
                    $addPresenca = new Presenca();
                    $addPresenca->Data_Hora = time();
                    $addPresenca->Mensalidade_id = $mensalidade->id;
                    $addPresenca->save();
                }
            }
            return $this->totalPresencas($mensalidade->id);
        } else {
            return $this->redirect(['index']);
        }
    }
    
    /*Marca presenca em aulas */

//    public function actionAdicionarPresencaAula($idRegisto) {
//        if (Yii::$app->request->isAjax && !Yii::$app->user->isGuest) {
//            if ($this->totalPresencas($idRegisto) < SELF::MAX_PRESENCAS_AULAS) {
//                $addPresenca = new Presenca();
//                $addPresenca->Data_Hora = time();
//                $addPresenca->Registo_id = $idRegisto;
//                $addPresenca->save();
//            }
//            return $this->totalPresencas($idRegisto);
//        } else {
//            return $this->redirect(['index']);
//        }
//    }

    protected function totalPresencas($idRegisto) {
        $total = Presenca::find()->where(['Mensalidade_id' => $idRegisto])->count();
        return $total;
    }

}
