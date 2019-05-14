<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Exercicio;
use backend\models\ExercicioPlano;
use kartik\mpdf\Pdf;
use backend\models\PlanoDeTreino;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\filters\AccessControl;
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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'lista', 'mostrar-imagem', 'criar-pdf'],
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
        $planosTreino = PlanoDeTreino::find();

        $pages = new Pagination([
            'defaultPageSize' => 4,
            'totalCount' => $planosTreino->count()
        ]);

        $model = $planosTreino
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', ['planosTreino' => $model, 'pages' => $pages]);
    }

    /**
     * Displays a single planodetreino model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $planoTreino = ExercicioPlano::findOne($id);

        return $this->render('view', [
                    'model' => $planoTreino,
        ]);
    }

    /**
     * Creates a new planodetreino model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $exercicio = new Exercicio;
        $exercicioPlano = new ExercicioPlano;
        if ($exercicioPlano->load(Yii::$app->request->post())) {
            if ($exercicioPlano->validate()) {
                if ($exercicioPlano->save()) {
                    
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'exercicio' => $exercicio,
                        'exercicioPlano' => $exercicioPlano,
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
        $exercicioPlano = $this->findExercicioPlano($id);
        $exercicio = $this->findCategoriaExercicio($exercicioPlano->Exercicios_id);

        if ($exercicioPlano->load(Yii::$app->request->post())) {
            if ($exercicioPlano->validate()) {
                if ($exercicioPlano->save()) {
                    
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                        'exercicio' => $exercicio,
                        'exercicioPlano' => $exercicioPlano,
            ]);
        }
    }

    /*
     * Retornar todas as informacoes de um determinado plano
     */

    public function findExercicioPlano($id) {
        if (($model = ExercicioPlano::findOne($id)) !== null) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

    /*
     * Retornar a categoria de um exercicio em específico
     */

    public function findCategoriaExercicio($exercicioId) {
        if (($model = Exercicio::findOne($exercicioId)) !== null) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionLista($id = null) {
        if (Yii::$app->request->isAjax && !Yii::$app->user->isGuest) {
            $exercicios = Exercicio::find()->where(['CategoriaExercicio_id' => $id])->all();
            if (!empty($exercicios)) {
                foreach ($exercicios as $exercicio):
                    ?>
                    <option value="<?= $exercicio->id ?>"><?= $exercicio->Nome ?></option>
                    <?php
                endforeach;
            } else {
                echo '<option value="">-- Selecione o Exercício --</option>';
            }
        } else {
            return $this->redirect(['planoexercicio/create']);
        }
    }

    public function actionMostrarImagem($id = null) {
        if (Yii::$app->request->isAjax && !Yii::$app->user->isGuest) {
            $exercicio = Exercicio::findOne($id);
            if ($exercicio !== null) {
                return Html::img(Yii::getAlias('@web') . '/exercicios/' . $exercicio->Foto, ['height' => '300', 'width' => '300', 'title' => $exercicio->Nome, 'alt' => $exercicio->Nome]);
            }
        } else {
            return $this->redirect(['planoexercicio/create']);
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
            $this->findExercicioPlano($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Este exercícios não pode ser apagado!'));
        }
        return $this->redirect(['index']);
    }

    public function actionCriarPdf($id) {
        $info = $this->getInformacao($id);

        //criar pasta para quando a destination => Pdf::DEST_FILE
//        if (!is_dir('pdf/' . $id . '/')) {
//            $dir = mkdir('pdf/' . $id . '/', 0777);
//        }

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
            //guardar o ficheiro quando a destination => Pdf::DEST_FILE
            //'filename' => Yii::getAlias('@webroot') . '/pdf/' . $id . '/' . Yii::t('app', 'Plano de Treino') . ' - ' . iconv("UTF-8", "ISO-8859-9//TRANSLIT", 'teste') . '.pdf',
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

        $pdf->render();
        return $this->redirect(['planoexercicio/index']);
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
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'A página não existe.'));
        }
    }

}
