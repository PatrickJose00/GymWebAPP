<?php

namespace backend\controllers;

use Yii;
use backend\models\aula;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * AulaController implements the CRUD actions for aula model.
 */
class AulaController extends Controller {

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
     * Lists all aula models.
     * @return mixed
     */
    public function actionIndex() {
        $aulas = Aula::find()->all();

        return $this->render('index', [
                    'aulas' => $aulas
        ]);
    }

    /**
     * Displays a single aula model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new aula model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new aula();
        $file = UploadedFile::getInstance($model, 'ImageFile');
        $model->scenario = "create";
        if ($model->load(Yii::$app->request->post())) {
            $model->ImageFile = $file->name;
            if ($model->validate()) {
                $filenameStripped = preg_replace("/[^a-zA-Z0-9.]/", "_", $file->basename);
                $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                $model->ImageFile = $filename . '_' . time() . '.' . $file->extension;

                if ($model->save()) {
                    $fullPath = "aulas";
                    $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->ImageFile));
                }

                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing aula model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $file = UploadedFile::getInstance($model, 'ImageFile');
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (!empty($file)) {
                    $filenameStripped = preg_replace("/[^a-zA-Z0-9.]/", "_", $file->basename);
                    $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                    $model->ImageFile = $filename . '_' . time() . '.' . $file->extension;
                } else {
                    $model->ImageFile = $model->oldAttributes['ImageFile'];
                }
                if ($model->save()) {
                    if (!empty($file)) {
                        $fullPath = "aulas";
                        $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->ImageFile));
                    }
                }
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing aula model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Esta sala não pode ser apagada!'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the aula model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return aula the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = aula::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'A página não existe.'));
        }
    }

}
