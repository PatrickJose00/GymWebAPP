<?php

use yii\helpers\Html;

$this->title = "Histórico de Planos de Exercícios";
$this->params['user'] = $user;
$this->params['mensalidadeAtual'] = $mensalidadeAtual;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <hr>
        <div>
            <p><label>Histórico Plano de Treino</label></p>
        </div>
        <hr>
        <div class="media">
            <div class="media-body">
                <div class="box">
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Plano de Treino</th>
                                <th>Data de Atribuição</th>
                                <th style="width: 150px" class="text-center">Visualizar</th>
                            </tr>
                            <?php
                            if (!empty($planoHistorico)):
                                $count = 1;
                                foreach ($planoHistorico as $plano):
                                    ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= $plano->planosDeTreino->Nome ?></td>
                                        <td><?= date('d-M-Y \à\s H:i\h', $plano->Data) ?></td>
                                        <td class="text-center"><?= Html::a('<span data-toggle="tooltip" title="Gerar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>', ['planoexercicio/criar-pdf', 'id' => $plano->Plano_de_Treino_id]) ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">-- Sem planos de Treino--</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>