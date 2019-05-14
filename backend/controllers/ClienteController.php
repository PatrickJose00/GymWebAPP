<?php

namespace backend\controllers;

use Yii;
use backend\models\Cliente;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SignupFormClient;
use backend\models\Morada;
use backend\models\Seguro;
use backend\models\Registo;
use common\models\User;
use backend\models\PlanoDeTreino;
use backend\models\PlanoTreinoCliente;
use yii\data\Pagination;
use backend\models\PlanosNutricaoCliente;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\filters\AccessControl;
/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'historico-mensalidades', 'listar-presencas-aulas', 'listar-presencas-musculacao', 'marcar-presenca', 'atribuir-plano', 'atribuir-plano-nutricao', 'historico-planos', 'historico-planos-nutricao'
],
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
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex() {
        $clientes = Cliente::find()->all();
        $checkStatus = $this->verifyStatusLista($clientes);
        $clientes = Cliente::find();
        $request = Yii::$app->request;
        $valorDropMenu = $request->get('list');
        $valorPesquisa = $request->get('search');

        if ($valorDropMenu != null && $valorPesquisa != null) {
            if ($valorDropMenu == 'nome') {
                $clientes = Cliente::find()->where(['like', $valorDropMenu, $valorPesquisa]);
            } else {
                $valorDropMenu = $valorDropMenu == 'numero' ? 'username' : $valorDropMenu;
                $clientes = Cliente::find()->joinWith('user u', true, 'INNER JOIN')->where(['like', 'u.' . $valorDropMenu, $valorPesquisa]);
            }
        }

        $pages = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $clientes->count()
        ]);

        $model = $clientes
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        //$mensalidade = $this->mensalidadeAtiva();
        return $this->render('index', [
                    'clientes' => $model,
                    'pages' => $pages
        ]);
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

    protected function mensalidadeAtiva($id) {
        if (($mensalidade = Cliente::find()->where(['Cliente_id' => $id])->andWhere(['Estado' => 1])->all() !== null)) {
            return $mensalidade;
        } else {
            return null;
        }
    }

    public function actionCreate() {
        $user = new SignupFormClient();
        $cliente = new Cliente();
        $morada = new Morada();
        $seguro = new Seguro();
        $lat = 41.380559;
        $long = -7.994432;
        if ($user->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post()) && $morada->load(Yii::$app->request->post())) {
            if ($userFinal = $user->signupClient()) {
                $morada = $morada->signupMorada();
                if ($morada !== null) {
                    $cliente->User_id = $userFinal->id;
                    $cliente->Morada_id = $morada->id;
                    $cliente->DataNascimento = strtotime($cliente->DataNascimento);
                    if ($cliente->save()) {
                        $seguro->Cliente_id = $cliente->id;
                        $seguro->DataCriacao = time();
                        $seguro->save();
                        $email = $this->enviarEmail($cliente->id, $userFinal->password);
                        Yii::$app->session->setFlash('success', 'Cliente registado com sucesso');
                    }
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
                    'user' => $user,
                    'cliente' => $cliente,
                    'morada' => $morada,
                    'lat' => $lat,
                    'long' => $long
        ]);
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $cliente = Cliente::findOne($id);
        $user = User::find()->where(['id' => $cliente->User_id])->one();
        $morada = Morada::find()->where(['id' => $cliente->Morada_id])->one();
        $lat = $morada->Latitude;
        $long = $morada->Longitude;
        if ($user->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post()) && $morada->load(Yii::$app->request->post())) {
            if ($userFinal = $user->save()) {
                if ($morada->save()) {
                    $cliente->User_id = $user->id;
                    $cliente->Morada_id = $morada->id;
                    $cliente->save();
                }
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                        'user' => $user,
                        'cliente' => $cliente,
                        'morada' => $morada,
                        'lat' => $lat,
                        'long' => $long
            ]);
        }
    }

    public function actionHistoricoMensalidades($id) {
        if (!Yii::$app->user->isGuest) {
            $registos = $this->obterRegistos($id);
        } else {
            return $this->redirect('site/index');
        }
        return $this->render('historico-mensalidades', [
                    'registos' => $registos,
        ]);
    }

    public function obterRegistos($cliente_id) {
        $registo = Registo::find()->where(['Cliente_id' => $cliente_id])->andWhere(['Estado' => 0])->all();
        if (!empty($registo)) {
            return $registo;
        } else {
            return null;
        }
    }

    public function actionListarPresencasAulas($id) {
        $checkStatus = $this->verifyStatus($id);
        $presencas = $this->findModelPresencas($id);
        return $this->render('listar-presencas-aulas', ['presencas' => $presencas]);
    }

    public function actionListarPresencasMusculacao($id) {
        $checkStatus = $this->verifyStatus($id);
        $presencas = $this->findModelPresencas($id);
        return $this->render('listar-presencas-musculacao', ['presencas' => $presencas]);
    }

    public function actionMarcarPresenca($id) {
        $checkStatus = $this->verifyStatus($id);
        $registos = $this->findModelPresencas($id);
        $cliente = $this->findModelCliente($id);
        return $this->render('marcar-presenca', ['registos' => $registos, 'cliente' => $cliente]);
    }

    /*
     * Verifica se está no mês seguinte e se estiver, coloca o estado como 0, ou seja, significa que o registo expirou (já mudou de mês)
     * NOTA: Esta mesma função encontra-se no controlador inscrição
     */

    public function verifyStatus($cliente_id) {
        $currentStatus = Registo::find()->where(['Estado' => 1])->andWhere(['Cliente_id' => $cliente_id])->one();
        if ($currentStatus !== null) {
            $nextMonth = Registo::checkNextMonth($currentStatus->Data);
            if ($nextMonth) {
                $currentStatus->Estado = 0;
                $currentStatus->save(false);
            }
        }
    }

    /*
     * Verifica se está no mês seguinte e se estiver, coloca o estado como 0, ou seja, significa que o registo expirou (já mudou de mês)
     * Verifica para todos os clientes inscritos (usado no index)
     * NOTA: Esta mesma função encontra-se no controlador inscrição
     */

    public function verifyStatusLista($clientes) {
        foreach ($clientes as $cliente) {
            $currentStatus = Registo::find()->where(['Estado' => 1])->andWhere(['Cliente_id' => $cliente->id])->all();
            if ($currentStatus !== null) {
                foreach ($currentStatus as $status) {
                    $nextMonth = Registo::checkNextMonth($status->Data);
                    if ($nextMonth) {
                        if ($status !== null) {
                            $status->Estado = 0;
                            $status->save(false);
                        }
                    }
                }
            }
        }
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelPresencas($id) {
        if (($model = Registo::find()->where(['Cliente_id' => $id])->andwhere(['Estado' => 1])->all()) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    protected function enviarEmail($id, $password) {
        $cliente = $this->findModelCliente($id);
        $layout = 'inscricao/nova-inscricao';

        $value = Yii::$app->mailer->compose($layout, ['cliente' => $cliente, 'password' => $password])
                ->setFrom(['agongym@gmail.com' => 'Ginásio AgonGym'])
                ->setTo($cliente->user->email)
                ->setSubject(Yii::t('app', 'Inscrição Ginásio'))
                ->send();

        if ($value) {
            Yii::$app->session->setFlash('mail-success', Yii::t('app', 'E-mail enviado com sucesso'));
        } else {
            Yii::$app->session->setFlash('mail-error', Yii::t('app', 'Ocorreu um erro durante o envio do e-mail'));
        }
        return $this->redirect(['propose/index']);
    }

    protected function findModelCliente($idCliente) {
        if (($model = Cliente::findOne($idCliente)) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    public function actionAtribuirPlano($id) {
        $planoCliente = new PlanoTreinoCliente;
        $request = Yii::$app->request;
        $planoAtual = $this->verficarPlanoAtual($id);

        if (Yii::$app->request->isAjax && !Yii::$app->user->isGuest && $planoCliente->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($planoCliente);
        } else {
            if ($planoCliente->load($request->post())) {
                if ($planoCliente->validate()) {
                    $planoCliente->Clientes_id = $id;
                    $planoCliente->Data = time();
                    $planoCliente->save();
                }
                return $this->redirect(['index']);
            } elseif (!Yii::$app->request->isAjax) {
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('atribuir-plano', ['planoCliente' => $planoCliente, 'planoAtual' => $planoAtual, 'cliente_id' => $id]);
            }
        }
    }

    public function actionAtribuirPlanoNutricao($id) {
        $planoCliente = new PlanosNutricaoCliente;
        $request = Yii::$app->request;
        $planoAtual = $this->verficarPlanoAtualNutricao($id);

        if (Yii::$app->request->isAjax && !Yii::$app->user->isGuest && $planoCliente->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($planoCliente);
        } else {
            if ($planoCliente->load($request->post())) {
                if ($planoCliente->validate()) {
                    $planoCliente->Clientes_id = $id;
                    $planoCliente->Data = time();
                    $planoCliente->save();
                }
                return $this->redirect(['index']);
            } elseif (!Yii::$app->request->isAjax) {
                return $this->redirect(['index']);
            } else {
                return $this->renderAjax('atribuir-plano-nutricao', ['planoCliente' => $planoCliente, 'planoAtual' => $planoAtual, 'cliente_id' => $id]);
            }
        }
    }

    /*
     * Pagina para mostrar o historico de planos de treino de um determinado utilizador
     */

    public function actionHistoricoPlanos($id) {
        $planosTreinoCliente = $this->planoTreinoCliente($id);
        return $this->render('historico-planos', ['planosTreinoCliente' => $planosTreinoCliente]);
    }

    /*
     * Pagina para mostrar o historico de planos de nutricao de um determinado utilizador
     */

    public function actionHistoricoPlanosNutricao($id) {
        $planosNutricaoCliente = $this->planoNutricaoCliente($id);
        return $this->render('historico-planos-nutricao', ['planosNutricaoCliente' => $planosNutricaoCliente]);
    }

    /*
     * Verificar o plano atual de um determinado cliente para os planos de treino
     */

    public function verficarPlanoAtual($id) {
        $planosTreinoCliente = $this->planoTreinoCliente($id);

        if (!empty($planosTreinoCliente)) {
            $totalPlanos = count($planosTreinoCliente);
            $planoAtual = $planosTreinoCliente[$totalPlanos - 1];
            return $planoAtual;
        } else {
            return null;
        }
    }

    public function verficarPlanoAtualNutricao($id) {
        $planoNutricaoCliente = $this->planoNutricaoCliente($id);

        if (!empty($planoNutricaoCliente)) {
            $totalPlanos = count($planoNutricaoCliente);
            $planoAtual = $planoNutricaoCliente[$totalPlanos - 1];
            return $planoAtual;
        } else {
            return null;
        }
    }

    /*
     * Obter todos os planos de treino de um cliente específico
     */

    public function planoTreinoCliente($id) {
        $planosTreinoCliente = PlanoTreinoCliente::find()->where(['Clientes_id' => $id])->all();

        if (!empty($planosTreinoCliente)) {
            return $planosTreinoCliente;
        } else {
            return null;
        }
    }

    /*
     * Obter todos os planos de nutricao de um cliente específico
     */

    public function planoNutricaoCliente($id) {
        $planoNutricaoCliente = PlanosNutricaoCliente::find()->where(['Clientes_id' => $id])->all();

        if (!empty($planoNutricaoCliente)) {
            return $planoNutricaoCliente;
        } else {
            return null;
        }
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionDelete($id) {
//        try {
//            $cliente = $this->findModel($id);
//            User::findOne(['id' => $cliente->User_id])->delete();
//
//            Yii::$app->session->setFlash('success', Yii::t('app', 'Cliente apagado com sucesso!'));
//        } catch (\Exception $e) {
//            Yii::$app->session->setFlash('error', Yii::t('app', 'Este cliente não pode ser apagado!'));
//        }
//        return $this->redirect(['index']);
//    }
}
