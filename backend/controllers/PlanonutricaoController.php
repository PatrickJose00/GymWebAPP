<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Refeicao;
use yii\filters\AccessControl;
use backend\models\AlimetoPlanoRefeicaoHasRefeicao;
use backend\models\Planodenutricao;
use backend\models\AlimentoHasAlimetoPlanoRefeicao;
use kartik\mpdf\Pdf;
use backend\models\AlimetoPlanoRefeicao;
use backend\models\Alimento;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\base\Model;

/**
 * PlanoexercicioController implements the CRUD actions for planodenutricao model.
 */
class PlanonutricaoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'lista', 'criar-pdf'],
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
     * Lists all planodenutricao models.
     * @return mixed
     */
    public function actionIndex() {
        $planoNutricao = Planodenutricao::find();

        $pages = new Pagination([
            'defaultPageSize' => 4,
            'totalCount' => $planoNutricao->count()
        ]);

        $model = $planoNutricao
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', ['planoNutricao' => $model, 'pages' => $pages]);
    }

    /**
     * Displays a single planodenutricao model.
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
     * Creates a new planodenutricao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $alimentoHasPlanoRefeicao = new AlimentoHasAlimetoPlanoRefeicao;
        $alimentoPlanoRefeicao = new AlimetoPlanoRefeicao;
        $planoHasRefeicao = new AlimetoPlanoRefeicaoHasRefeicao;

        if ($alimentoHasPlanoRefeicao->load(Yii::$app->request->post()) && $alimentoPlanoRefeicao->load(Yii::$app->request->post()) && $planoHasRefeicao->load(Yii::$app->request->post())) {
            if ($alimentoHasPlanoRefeicao->validarPeso()) {
                $pesos = explode(',', $alimentoHasPlanoRefeicao->Peso);
                $totalPesos = 0;

                foreach ($pesos as $peso) {
                    if (is_numeric($peso)) {
                        $totalPesos++;
                    }
                }
                if (isset($alimentoHasPlanoRefeicao['Alimento_id'])) {
                    $totalAlimentos = count($alimentoHasPlanoRefeicao['Alimento_id']);
                }

                if ($totalAlimentos == $totalPesos) {
                    if ($alimentoPlanoRefeicao->save()) {
                        if (isset($alimentoHasPlanoRefeicao['Alimento_id'])) {
                            foreach ($alimentoHasPlanoRefeicao['Alimento_id'] as $key => $alimento) {
                                $alimentoHasPlanoRefeicao = new AlimentoHasAlimetoPlanoRefeicao();
                                $alimentoHasPlanoRefeicao->Alimento_id = $alimento;
                                $alimentoHasPlanoRefeicao->Alimeto_Plano_Refeicao_id = $alimentoPlanoRefeicao->id;
                                $alimentoHasPlanoRefeicao->Peso = $pesos[$key];
                                $alimentoHasPlanoRefeicao->save();
                                unset($alimentoHasPlanoRefeicao);
                            }
                        }
                        if (isset($planoHasRefeicao['Refeicao_id'])) {

                            foreach ($planoHasRefeicao['Refeicao_id'] as $hora) {
                                $newplanoHasRefeicao = new AlimetoPlanoRefeicaoHasRefeicao();
                                $newplanoHasRefeicao->Refeicao_id = $hora;
                                $newplanoHasRefeicao->Alimeto_Plano_Refeicao_id = $alimentoPlanoRefeicao->id;
                                $newplanoHasRefeicao->save();
                                unset($newplanoHasRefeicao);
                            }
                        }
                        return $this->redirect(['index']);
                    }
                }
            }
        }
        return $this->render('create', [
                    'alimentoPlanoRefeicao' => $alimentoPlanoRefeicao,
                    'alimentoHasPlanoRefeicao' => $alimentoHasPlanoRefeicao,
                    'planoHasRefeicao' => $planoHasRefeicao
        ]);
    }

    /**
     * Updates an existing planodenutricao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $alimentoPlanoRefeicao = $this->findAlimentoPlanoRefeicao($id);
        $alimentoHasPlanoRefeicao = $this->findAlimentoHasAlimetoPlanoRefeicao($id);
        $planoHasRefeicao = $this->findAlimetoPlanoRefeicaoHasRefeicao($id);

        $alimentos = array_column($alimentoHasPlanoRefeicao, 'Alimento_id');
        $horarios = array_column($planoHasRefeicao, 'Refeicao_id');
        $totalInfoPesos = AlimentoHasAlimetoPlanoRefeicao::find()->where(['Alimeto_Plano_Refeicao_id' => $id])->all();

        //tranformar pesos numa string 
        $pesos = implode(",", array_column($totalInfoPesos, 'Peso'));
        //fim da transformacao

        if ($alimentoPlanoRefeicao->load(Yii::$app->request->post())) {
            $alimentoHasPlanoRefeicao = new AlimentoHasAlimetoPlanoRefeicao;
            $planoHasRefeicao = new AlimetoPlanoRefeicaoHasRefeicao;
            if ($alimentoPlanoRefeicao->load(Yii::$app->request->post()) && $alimentoHasPlanoRefeicao->load(Yii::$app->request->post())) {
                if ($alimentoHasPlanoRefeicao->validarPeso()) {
                    $pesos = explode(',', $alimentoHasPlanoRefeicao->Peso);
                    $totalPesos = 0;

                    foreach ($pesos as $peso) {
                        if (is_numeric($peso)) {
                            $totalPesos++;
                        }
                    }
                    if (isset($alimentoHasPlanoRefeicao['Alimento_id'])) {
                        $totalAlimentos = count($alimentoHasPlanoRefeicao['Alimento_id']);
                    }

                    if ($totalAlimentos == $totalPesos) {
                        if ($alimentoPlanoRefeicao->update()) {
                            if (isset($alimentoHasPlanoRefeicao['Alimento_id'])) {
                                foreach ($alimentoHasPlanoRefeicao['Alimento_id'] as $key => $alimento) {
                                    $alimentoHasPlanoRefeicao = new AlimentoHasAlimetoPlanoRefeicao();
                                    $alimentoHasPlanoRefeicao->Alimento_id = $alimento;
                                    $alimentoHasPlanoRefeicao->Alimeto_Plano_Refeicao_id = $alimentoPlanoRefeicao->id;
                                    $alimentoHasPlanoRefeicao->Peso = $pesos[$key];
                                    $alimentoHasPlanoRefeicao->update();
                                    unset($alimentoHasPlanoRefeicao);
                                }
                            }
                            if (isset($planoHasRefeicao['Refeicao_id'])) {
                                foreach ($planoHasRefeicao['Refeicao_id'] as $hora) {
                                    $newplanoHasRefeicao = new AlimetoPlanoRefeicaoHasRefeicao();
                                    $newplanoHasRefeicao->Refeicao_id = $hora;
                                    $newplanoHasRefeicao->Alimeto_Plano_Refeicao_id = $alimentoPlanoRefeicao->id;
                                    $newplanoHasRefeicao->update();
                                    unset($newplanoHasRefeicao);
                                }
                            }
                            return $this->redirect(['index']);
                        }
                    }
                }
            }
        }
        return $this->render('update', [
                    'alimentoPlanoRefeicao' => $alimentoPlanoRefeicao,
                    'alimentoHasPlanoRefeicao' => $alimentoHasPlanoRefeicao,
                    'planoHasRefeicao' => $planoHasRefeicao,
                    'alimentos' => $alimentos,
                    'horarios' => $horarios,
                    'pesos' => $pesos
        ]);
//        }
    }

    public function findAlimetoPlanoRefeicaoHasRefeicao($id) {
        $model = AlimetoPlanoRefeicaoHasRefeicao::find()->where(['Alimeto_Plano_Refeicao_id' => $id])->all();
        if (!empty($model)) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

    public function findAlimentoHasAlimetoPlanoRefeicao($id) {
        $model = AlimentoHasAlimetoPlanoRefeicao::find()->where(['Alimeto_Plano_Refeicao_id' => $id])->all();
        if (!empty($model)) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

    public function findAlimentoPlanoRefeicao($id) {
        if (($model = AlimetoPlanoRefeicao::findOne($id)) !== null) {
            return $model;
        } else {
            return $this->redirect(['index']);
        }
    }

    public function actionLista($id = null) {
        if (Yii::$app->request->isAjax && !Yii::$app->user->isGuest) {
            $alimentos = Alimento::find()->where(['CategoriaAlimentos_id' => $id])->all();
            if (!empty($alimentos)) {
                foreach ($alimentos as $alimento):
                    ?>
                    <option value="<?= $alimento->id ?>"><?= $alimento->Nome ?></option>
                    <?php
                endforeach;
            } else {
                echo '<option value="">-- Selecione o Alimento --</option>';
            }
        } else {
            return $this->redirect(['planonutricao/create']);
        }
    }

    /**
     * Deletes an existing planodenutricao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        try {
            $this->findAlimentoPlanoRefeicao($id)->delete();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Esta refeição não pode ser apagada!'));
        }
        return $this->redirect(['index']);
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
            'filename' => Yii::t('app', 'Plano de Nutrição') . '-' . $info->Nome . '.pdf',
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
                'SetHeader' => ['<span style="color: #959595;">' . Yii::t('app', 'Plano de Nutrição') . '</span>||'],
                'SetFooter' => ['||{PAGENO}'],
            ]
        ]);

        $pdf->render();
        return $this->redirect(['planonutricao/index']);
    }

    public function renderConteudo($id) {
        $model = $this->getInformacao($id);
        $refeicoes = [];
        if ($model !== null) {
            foreach ($model->alimetoPlanoRefeicaos as $exRefeicao) {
                foreach ($exRefeicao->alimetoPlanoRefeicaoHasRefeicaos as $refeicao) {
                    $refeicoes[$exRefeicao->Dia][$refeicao->refeicao->Hora][] = $exRefeicao;
                }
            }
            if (!empty($refeicoes)) {
                if ($model !== null) {
                    $content = $this->renderPartial('template-nutricao', ['refeicoes' => $refeicoes]);
                }
                return $content;
            }
        }
        return null;
    }

    public function getInformacao($id) {
        if (($model = Planodenutricao::find()->WHERE(['Id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'A página não existe.'));
        }
    }

}
