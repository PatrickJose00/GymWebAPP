<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\Planodenutricao;
use yii\data\Pagination;
use yii\filters\AccessControl;

/**
 * PlanoController implements the CRUD actions for planosdenutricao model.
 */
class PlanonController extends Controller {

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
     * Lists all planosdenutricao models.
     * @return mixed
     */
    public function actionIndex() {
        $planosNutricao = Planodenutricao::find()->orderBy('id ASC')->all();
        return $this->render('index', ['planosNutricao' => $planosNutricao]);
    }

    /**
     * Creates a new planosdenutricao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $planoNutricao = new Planodenutricao;
        if ($planoNutricao->load(Yii::$app->request->post())) {
            if ($planoNutricao->validate()) {
                if ($planoNutricao->save()) {
                    
                }
            }
            return $this->redirect(['planonutricao/create']);
        } else {
            return $this->render('create', [
                        'planoNutricao' => $planoNutricao,
            ]);
        }
    }

    /**
     * Updates an existing planosdenutricao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $planoNutricao = $this->findModel($id);

        if ($planoNutricao->load(Yii::$app->request->post())) {
            if ($planoNutricao->validate()) {
                if ($planoNutricao->save()) {
                    
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'planoNutricao' => $planoNutricao,
            ]);
        }
    }

    protected function findModel($id) {
        if (($model = Planodenutricao::findOne($id)) !== null) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing planosdenutricao model.
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
