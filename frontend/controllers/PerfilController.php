<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use backend\models\Registo;
use backend\models\Cliente;
use backend\models\PlanoTreinoCliente;
use backend\models\PlanosNutricaoCliente;
use backend\models\Morada;

/**
 * Site controller
 */
class PerfilController extends Controller {

    /**
     * @inheritdoc
     */
    public $layout = "perfil";
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['logout', 'signup', 'index', 'historico-mensalidades', 'historico-aulas', 'historico-plano-exercicios', 'historico-plano-nutricao', 'definicoes-conta'],
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

    public function actionIndex() {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/index']);
        } elseif (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $user = User::findOne($user_id);
            $mensalidadeAtual = $this->mensalidadeAtual($user_id);
        } else {
            return $this->redirect('site/index');
        }
        return $this->render('index', [
                    'user' => $user,
                    'mensalidadeAtual' => $mensalidadeAtual
        ]);
    }

    public function actionHistoricoMensalidades() {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/index']);
        } elseif (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $user = User::findOne($user_id);
            $registos = $this->obterRegistos($user_id);
            $mensalidadeAtual = $this->mensalidadeAtual($user_id);
        } else {
            return $this->redirect('site/index');
        }
        return $this->render('historico-mensalidades', [
                    'user' => $user,
                    'registos' => $registos,
                    'mensalidadeAtual' => $mensalidadeAtual
        ]);
    }

    public function actionHistoricoAulas() {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/index']);
        } elseif (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $user = User::findOne($user_id);
            $registos = $this->obterRegistos($user_id);
            $mensalidadeAtual = $this->mensalidadeAtual($user_id);
        } else {
            return $this->redirect('site/index');
        }
        return $this->render('historico-aulas', [
                    'user' => $user,
                    'registos' => $registos,
                    'mensalidadeAtual' => $mensalidadeAtual
        ]);
    }

    public function actionHistoricoPlanoExercicios() {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/index']);
        } elseif (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $user = User::findOne($user_id);
            $planoHistorico = $this->planoClienteExercicio($user_id);
            $mensalidadeAtual = $this->mensalidadeAtual($user_id);
        } else {
            return $this->redirect('site/index');
        }
        return $this->render('historico-plano-exercicio', [
                    'user' => $user,
                    'planoHistorico' => $planoHistorico,
                    'mensalidadeAtual' => $mensalidadeAtual
        ]);
    }

    public function actionHistoricoPlanoNutricao() {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/index']);
        } elseif (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $user = User::findOne($user_id);
            $planoNutricao = $this->planoClienteNutricao($user_id);
            $mensalidadeAtual = $this->mensalidadeAtual($user_id);
        } else {
            return $this->redirect('site/index');
        }
        return $this->render('historico-plano-nutricao', [
                    'user' => $user,
                    'planoNutricao' => $planoNutricao,
                    'mensalidadeAtual' => $mensalidadeAtual
        ]);
    }

    public function actionDefinicoesConta() {
        if (User::isAdmin(Yii::$app->user->identity->username)) {
            return $this->redirect(['site/index']);
        } elseif (!Yii::$app->user->isGuest) {
            $user_id = Yii::$app->user->id;
            $mensalidadeAtual = $this->mensalidadeAtual($user_id);
            $user = User::findOne($user_id);
            $cliente = Cliente::findOne(['User_id' => $user_id]);
            $morada = Morada::find()->where(['id' => $cliente->Morada_id])->one();
            $lat = $morada->Latitude;
            $long = $morada->Longitude;
            $cliente->DataNascimento = date('d-M-Y', $cliente->DataNascimento);
            if ($user->load(Yii::$app->request->post()) && $userFinal = $user->save() && $user->validate()) {
                if ($user->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post()) && $morada->load(Yii::$app->request->post())) {
                    if (!empty($user->novaPassword && $user->confirmarPassword)) {
                        $hash = Yii::$app->getSecurity()->generatePasswordHash($user->novaPassword);
                        $user->password_hash = $hash;
                        $user->save(false);
                    }
                    if ($userFinal) {
                        if ($morada->save()) {
                            $cliente->User_id = $user->id;
                            $cliente->Morada_id = $morada->id;
                            $cliente->DataNascimento = strtotime($cliente->DataNascimento);
                            $cliente->save();
                            $cliente->DataNascimento = date('d-M-Y', $cliente->DataNascimento);
                            Yii::$app->session->setFlash('success', 'Alterações efetuadas com sucesso!');
                        }
                    }
                }
            }
        } else {
            return $this->redirect('site/index');
        }
        return $this->render('definicoes-conta', [
                    'user' => $user,
                    'mensalidadeAtual' => $mensalidadeAtual,
                    'morada' => $morada, 'cliente' => $cliente,
                    'user' => $user,
                    'lat' => $lat,
                    'long' => $long
        ]);
    }

    public function planoClienteExercicio($user_id) {
        $cliente = Cliente::find()->where(['User_id' => $user_id])->one();
        if ($cliente !== null) {
            $planoHistorico = PlanoTreinoCliente::find()->where(['Clientes_id' => $cliente->id])->orderBy('Data DESC')->all();
            return $planoHistorico;
        } else {
            return null;
        }
    }

    public function planoClienteNutricao($user_id) {
        $cliente = Cliente::find()->where(['User_id' => $user_id])->one();
        if ($cliente !== null) {
            $planoHistorico = PlanosNutricaoCliente::find()->where(['Clientes_id' => $cliente->id])->orderBy('Data DESC')->all();
            return $planoHistorico;
        } else {
            return null;
        }
    }

    public function obterRegistos($user_id) {
        $cliente = Cliente::find()->where(['User_id' => $user_id])->one();
        if ($cliente !== null) {
            $registo = Registo::find()->where(['Cliente_id' => $cliente->id])->andWhere(['Estado' => 0])->all();
            return $registo;
        } else {
            return null;
        }
    }

    public function mensalidadeAtual($user_id) {
        $cliente = Cliente::find()->where(['User_id' => $user_id])->one();
        $registo = Registo::find()->where(['Cliente_id' => $cliente->id])->andWhere(['Estado' => 1])->all();

        return $registo;
    }

}
