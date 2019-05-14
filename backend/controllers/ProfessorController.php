<?php

namespace backend\controllers;

use Yii;
use backend\models\Professor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;

/**
 * ProfessorController implements the CRUD actions for Professor model.
 */
class ProfessorController extends Controller {

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
     * Lists all Professor models.
     * @return mixed
     */
    public function actionIndex() {
        $professores = Professor::find();
        $pages = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $professores->count()
        ]);
        
        $model = $professores
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', [
                    'professores' => $model,
                    'pages' => $pages
        ]);
    }

    /**
     * Displays a single Professor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Professor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Professor();
        $model->scenario = Professor::SCENARIO_FILE;
        $file = UploadedFile::getInstance($model, 'Foto');

        if ($model->load(Yii::$app->request->post())) {
            $model->Foto = $file->name;
            if ($model->validate()) {
                $filenameStripped = preg_replace("/[^a-zA-Z0-9]/", "_", $file->basename);
                $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                $model->Foto = $filename . '_' . time() . '.' . $file->extension;
                $model->DataNascimento = strtotime($model->DataNascimento);
                if ($model->save()) {
                    $fullPath = "professores";
                    $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->Foto));
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Professor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $file = UploadedFile::getInstance($model, 'Foto');
        $model->DataNascimento = date('m/d/Y', $model->DataNascimento);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if (!empty($file)) {
                    $filenameStripped = preg_replace("/[^a-zA-Z0-9.]/", "_", $file->basename);
                    $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                    $model->Foto = $filename . '_' . time() . '.' . $file->extension;
                    if ($model->save()) {
                        $fullPath = "professores";
                        $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->Foto));
                    }
                } else {
                    $model->DataNascimento = strtotime($model->DataNascimento);
                    $model->Foto = $model->oldAttributes['Foto'];
                    $model->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Professor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Este professor não pode ser apagado!'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Professor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Professor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Professor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
