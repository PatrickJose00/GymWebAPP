<?php

namespace backend\controllers;

use Yii;
use backend\models\Galeriagym;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\filters\AccessControl;
/**
 * GaleriasuperiorController implements the CRUD actions for Galeriainicial model.
 */
class GaleriainferiorController extends Controller {

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
     * Lists all Galeriainicial models.
     * @return mixed
     */
    public function actionIndex() {
        $imagensGaleria = Galeriagym::find();
        $pages = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $imagensGaleria->count()
        ]);

        $model = $imagensGaleria
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', [
                    'imagensGaleria' => $model,
                    'pages' => $pages
        ]);
    }

    /**
     * Creates a new Galeriainicial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Galeriagym();
        $model->scenario = Galeriagym::SCENARIO_FILE;
        $file = UploadedFile::getInstance($model, 'Imagem');

        if ($model->load(Yii::$app->request->post())) {
            $model->Imagem = $file->name;
            if ($model->validate()) {
                $filenameStripped = preg_replace("/[^a-zA-Z0-9]/", "_", $file->basename);
                $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                $model->Imagem = $filename . '_' . time() . '.' . $file->extension;
                if ($model->save()) {
                    $fullPath = Yii::$app->urlManagerFrontend->baseUrl . "/gallery-inside";
                    $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->Imagem));
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
     * Updates an existing Galeriainicial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $file = UploadedFile::getInstance($model, 'Imagem');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (!empty($file)) {
                    $filenameStripped = preg_replace("/[^a-zA-Z0-9.]/", "_", $file->basename);
                    $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                    $model->Imagem = $filename . '_' . time() . '.' . $file->extension;
                    if ($model->save()) {
                        $fullPath = Yii::$app->urlManagerFrontend->baseUrl . "/gallery-top";
                        $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->Imagem));
                    }
                } else {
                    $model->Imagem = $model->oldAttributes['Imagem'];
                    $model->save();
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Galeriainicial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Esta imagem não pode ser apagada!'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Galeriainicial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Professor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Galeriagym::findOne($id)) !== null) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

}
