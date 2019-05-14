<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Registo;
use backend\models\Mensalidade;
use backend\models\Inscricao;
use backend\models\Pack;
use backend\models\Sessao;
use backend\models\Aula;
use Exception;
use yii\filters\AccessControl;
/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class InscricaoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'musculacao', 'aulas'],
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
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionMusculacao($ri = null, $user = null) {
        $registo = new Registo();
        $mensalidade = new Mensalidade();
        $request = Yii::$app->request;
        $registo->scenario = Registo::SCENARIO_MODALIDADE;
        if ($registo->load(Yii::$app->request->post()) && $mensalidade->load(Yii::$app->request->post())) {
            $registo->Data = time();
            if ($registo->save()) {
                $packId = $request->post('pack');
                $pack = Pack::findOne($packId);
                $mensalidade->Pack_id = $packId;
                $mensalidade->Registo_id = $registo->id;
                $mensalidade->Preco = $pack->Preco;
                $mensalidade->NumeroEntradas = $pack->NumeroEntradas;
                $mensalidade->save();
                return $this->redirect(['cliente/index']);
            }
        }

        if ($request->get('ri')) {
            $ri = "Trata-se de uma nova renovacao";
        }
        if ($request->get('user')) {
            $registo->Cliente_id = $user;
        }

        return $this->render('musculacao', [
                    'registo' => $registo,
                    'mensalidade' => $mensalidade,
                    'renovacao' => $ri
        ]);
    }

    public function actionAulas($ri = null, $user = null) {
        $registo = new Registo();
        $inscricao = new Inscricao();
        $request = Yii::$app->request;
        $registo->scenario = Registo::SCENARIO_AULAS;
        if ($registo->load(Yii::$app->request->post()) && $registo->validate() && $inscricao->load(Yii::$app->request->post())) {
            $clientId = $registo->Cliente_id;
            $checkLotation = $this->verificarLocataoSala($inscricao);
            if ($checkLotation) {
                $registo->Data = time();
                if ($registo->save()) {
                    foreach ($inscricao->Aula_id as $insc) {
                        $precoAula = Aula::findOne($insc)->Preco;
                        $novaInscrição = new Inscricao;
                        $novaInscrição->Registo_id = $registo->id;
                        $novaInscrição->Aula_id = $insc;
                        $novaInscrição->Preco = $precoAula;
                        $novaInscrição->save();
                        unset($novaInscrição);
                    }
                    Yii::$app->session->setFlash('success', 'Inscrição efetuada com sucesso');
                }
            }
            return $this->redirect(['cliente/index']);
        }

        if ($request->get('ri')) {
            $ri = "Trata-se de uma nova inscrição";
        }
        if ($request->get('user')) {
            $registo->Cliente_id = $user;
        }

        return $this->render('aulas', [
                    'registo' => $registo,
                    'inscricao' => $inscricao,
                    'renovacao' => $ri
        ]);
    }

    /*
     * Verifica se o utilizador já se encontra com alguma modalidade ativa, caso esteja, não deixa o mesmo registar-se
     */

    public function verificarInscricaoMusculacao() {
        
    }

    /*
     * Verifica a lotação da(s) sala(s), caso ela(s) esteja(m) toda(s) preenchida(s) não vai deixar efetuar o registo
     */

    public function verificarLocataoSala($inscricao) {
        foreach ($inscricao->Aula_id as $aulaId) {
            $count = 0;
            $inscritos = Inscricao::find()->where(['Aula_id' => $aulaId])->all();
            try {
                $lotacaoSala = Sessao::findOne(['Aula_id' => $aulaId])->sala->Lotacao;
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro inesperado, verifique se as aulas têm sessões associadas!');
                return false;
            }

            foreach ($inscritos as $inscrito) {
                $registoAtivo = Registo::find()->where(['id' => $inscrito->Registo_id])->andWhere(['Estado' => 1])->one();
                if ($registoAtivo !== null) {
                    $checkStatus = $this->verifyStatus($registoAtivo->Cliente_id);
                    if (!$checkStatus) {
                        $count++;
                    }
                    if ($count >= $lotacaoSala) {
                        Yii::$app->session->setFlash('error', 'Não é possível efetuar a inscrição! <br> A sala de ' . $inscricao->aula->Nome . ' já se encontra lotada');
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /*
     * Verifica se está no mês seguinte e se estiver, coloca o estado como 0, ou seja, significa que o registo expirou (já mudou de mês)
     * NOTA: Esta mesma função encontra-se no controlador cliente
     */

    public function verifyStatus($cliente_id) {
        $currentStatus = Registo::find()->where(['Estado' => 1])->andWhere(['Cliente_id' => $cliente_id])->one();
        if ($currentStatus !== null) {
            $nextMonth = Registo::checkNextMonth($currentStatus->Data);
            if ($nextMonth) {
                if ($currentStatus !== null) {
                    $currentStatus->Estado = 0;
                    $currentStatus->save(false);
                }
            } else {
                return false;
            }
        }
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $cliente = $this->findModel($id);

        if ($cliente->load(Yii::$app->request->post()) && $cliente->save()) {
            return $this->redirect(['view', 'id' => $cliente->id]);
        } else {
            return $this->render('update', [
                        'cliente' => $cliente,
            ]);
        }
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

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
        if (($model = Registo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
