<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\PlanoDeTreino;
use yii\data\Pagination;
use yii\filters\AccessControl;
/**
 * PlanoController implements the CRUD actions for planodetreino model.
 */
class PlanoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all planodetreino models.
     * @return mixed
     */
    public function actionIndex() {
        $planosTreino = PlanoDeTreino::find()->orderBy('id ASC')->all();
        return $this->render('index', ['planosTreino' => $planosTreino]);
    }

    /**
     * Creates a new planodetreino model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $planoTreino = new PlanoDeTreino;
        if ($planoTreino->load(Yii::$app->request->post())) {
            if ($planoTreino->validate()) {
                if ($planoTreino->save()) {
                    
                }
            }
            return $this->redirect(['planoexercicio/create']);
        } else {
            return $this->render('create', [
                        'planoTreino' => $planoTreino,
            ]);
        }
    }

    /**
     * Updates an existing planodetreino model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $planoTreino = $this->findModel($id);

        if ($planoTreino->load(Yii::$app->request->post())) {
            if ($planoTreino->validate()) {
                if ($planoTreino->save()) {
                    
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'planoTreino' => $planoTreino,
            ]);
        }
    }

    protected function findModel($id) {
        if (($model = PlanoDeTreino::findOne($id)) !== null) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing planodetreino model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Este plano não pode ser apagado!'));
        }
        return $this->redirect(['index']);
    }

}
