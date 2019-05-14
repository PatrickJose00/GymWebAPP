<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\PlanoTreinoCliente;
use kartik\mpdf\Pdf;
use backend\models\PlanoDeTreino;
use backend\models\Cliente;
use yii\data\Pagination;
use yii\helpers\Html;

/**
 * PlanoexercicioController implements the CRUD actions for planodetreino model.
 */
class PlanoexercicioController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['criar-pdf'],
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

    public function actionCriarPdf($id) {
        $info = $this->getInformacao($id);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'orientation' => 'P',
            'format' => [216, 279.5],
            'content' => $this->renderConteudo($id),
            'marginTop' => 30,
            'marginLeft' => 25,
            'marginRight' => 25,
            'marginHeader' => 16,
            'marginFooter' => 14,
            'cssFile' => Yii::getAlias('@webroot') . '/css/template-plano.css',
            'filename' => Yii::t('app', 'Plano de Treino') . '-' . $info->Nome . '.pdf',
            'destination' => Pdf::DEST_DOWNLOAD,
            'options' => [
                'defaultheaderline' => 0,
                'defaultfooterline' => 0,
                'title' => 'Plano de Treino',
                'subject' => 'Plano de Treino',
                'defaultheaderfontstyle' => 'B',
                'defaultfooterfontstyle' => '',
                'defaultheaderfontsize' => 10,
                'defaultfooterfontsize' => 10,
            ],
            'methods' => [
                'SetHeader' => ['<span style="color: #959595;">' . Yii::t('app', 'Plano de Treino') . '</span>||'],
                'SetFooter' => ['||{PAGENO}'],
            ]
        ]);

        try {
            $pdf->render();
            return $this->redirect(['perfil/historico-plano-exercicios']);
        } catch (\Exception $e) {
            return $this->redirect(['perfil/historico-plano-exercicios']);
        }
    }

    public function renderConteudo($id) {
        $model = $this->getInformacao($id);
        $musculos = [];
        if ($model !== null) {
            foreach ($model->exercicioPlanos as $exPlanos) {
                $musculos[$exPlanos->Dia][$exPlanos->exercicios->categoriaExercicio->Nome][] = $exPlanos;
            }
            if (!empty($musculos)) {
                if ($model !== null) {
                    $content = $this->renderPartial('template-plano', ['musculos' => $musculos]);
                }
                return $content;
            }
        }
        return null;
    }

    public function getInformacao($id) {
        if (($model = PlanoDeTreino::find()->WHERE(['Id' => $id])->one()) !== null) {
            $user = $this->checkUser($model);
            if ($user) {
                return $model;
            } else {
                throw new NotFoundHttpException(Yii::t('app', 'A página não existe.'));
            }
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'A página não existe.'));
        }
    }

    public function checkUser($model) {
        if (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $cliente = Cliente::find()->where(['User_id' => $user_id])->one();
            if ($cliente !== null) {
                $checkPlano = PlanoTreinoCliente::find()->where(['Clientes_id' => $cliente->id])->all();
                foreach ($checkPlano as $check) {
                    if ($model->id == $check->Plano_de_Treino_id) {
                        return true;
                    }
                }
                return false;
            }
        }
    }

}
