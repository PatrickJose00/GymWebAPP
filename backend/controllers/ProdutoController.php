<?php

namespace backend\controllers;

use Yii;
use backend\models\Produto;
use backend\models\Categoriaproduto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;

/**
 * ProdutoController implements the CRUD actions for Produto model.
 */
class ProdutoController extends Controller {

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
     * Lists all Produto models.
     * @return mixed
     */
    public function actionIndex($sub = null) {
        if (empty($sub)) {
            $produtos = Produto::find();
        } else {
            $produtos = Produto::find()->where(['SubCategoriaProduto_id' => $sub]);
        }

        $categorias = Categoriaproduto::find()->all();
        $pages = new Pagination([
            'defaultPageSize' => 8,
            'totalCount' => $produtos->count()
        ]);

        $model = $produtos
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', [
                    'produtos' => $model,
                    'categorias' => $categorias,
                    'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Produto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Produto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Produto();
        $model->scenario = Produto::SCENARIO_IMAGEM;
        $file = UploadedFile::getInstance($model, 'Imagem');
        if ($model->load(Yii::$app->request->post())) {
            $model->Imagem = $file->name;
            if ($model->validate()) {
                $filenameStripped = preg_replace("/[^a-zA-Z0-9]/", "_", $model->Nome);
                $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                $model->Imagem = $filename . '_' . time() . '.' . $file->extension;
                if ($model->save()) {
                    $fullPath = Yii::$app->urlManagerFrontend->baseUrl . "/produtos";
                    if (is_dir($fullPath)) {
                        $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->Imagem));
                    }
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
     * Updates an existing Produto model.
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
                    $filenameStripped = preg_replace("/[^a-zA-Z0-9.]/", "_", $model->Nome);
                    $filename = iconv("UTF-8", "ISO-8859-9//TRANSLIT", $filenameStripped);
                    $model->Imagem = $filename . '_' . time() . '.' . $file->extension;
                    if ($model->save()) {
                        $fullPath = Yii::$app->urlManagerFrontend->baseUrl . "/produtos";
                        $file->saveAs($fullPath . "/" . iconv("UTF-8", "ISO-8859-9//TRANSLIT", $model->Imagem));
                    }
                } else {
                    $model->Imagem = $model->oldAttributes['Imagem'];
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
     * Deletes an existing Produto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', Yii::t('app', 'Produto apagado com sucesso!'));
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Este produto não pode ser apagado!'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Produto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Produto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Produto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
