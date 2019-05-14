<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Sessao;
use backend\models\SessaoSearch;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class SessaoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['adicionar', 'listar-sessoes', 'delete'],
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

    /**
     * Displays a single Cliente model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id) {
//        return $this->render('view', [
//                    'model' => $this->findModel($id),
//        ]);
//    }

    public function actionAdicionar() {
        $sessao = new Sessao;
        if ($sessao->load(Yii::$app->request->post()) && $sessao->validate()) {
            $milisenconds = $sessao->convertHoursToSeconds();
            $primeiraSessao = strtotime($sessao->PrimeiraSessao);
            $segundaSessao = strtotime($sessao->SegundaSessao);
            $sessao->PrimeiraSessao = $primeiraSessao;
            $sessao->SegundaSessao = $segundaSessao;
            $sessao->Duracao = $milisenconds;
            $sessao->save();
            return $this->redirect(['cliente/index']);
        }

        return $this->render('adicionar', [
                    'sessao' => $sessao
        ]);
    }

    public function actionListarSessoes() {
        $sessoes = Sessao::find()->orderBy(['PrimeiraSessao' => SORT_ASC])->all();
        return $this->render('listar-sessoes', [
                    'sessoes' => $sessoes,
        ]);
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id) {
//        $cliente = $this->findModel($id);
//
//        if ($cliente->load(Yii::$app->request->post()) && $cliente->save()) {
//            return $this->redirect(['view', 'id' => $cliente->id]);
//        } else {
//            return $this->render('update', [
//                        'cliente' => $cliente,
//            ]);
//        }
//    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();

            Yii::$app->session->setFlash('success', Yii::t('app', 'Sessão apagada com sucesso!'));
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Esta sessão não pode ser apagada!'));
        }
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Sessao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('A página não foi encontrada.');
        }
    }

}
