<?php

use yii\helpers\Html;

$this->title = "Histórico de Planos de Nutrição";
$this->params['user'] = $user;
$this->params['mensalidadeAtual'] = $mensalidadeAtual;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <hr>
        <div>
            <p><label>Histórico Plano Nutrição</label></p>
        </div>
        <hr>
        <div class="media">
            <div class="media-body">
                <div class="box">
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Plano de Nutrição</th>
                                <th>Data de Atribuição</th>
                                <th style="width: 150px" class="text-center">Visualizar</th>
                            </tr>
                            <?php
                            if (!empty($planoNutricao)):
                                $count = 1;
                                foreach ($planoNutricao as $plano):
                                    ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= $plano->planosdeNutricao->Nome ?></td>
                                        <td><?= date('d-M-Y \à\s H:i\h', $plano->Data) ?></td>
                                        <td class="text-center"><?= Html::a('<span data-toggle="tooltip" title="Gerar Pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>', ['planonutricao/criar-pdf', 'id' => $plano->PlanosdeNutricao_id]) ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">-- Sem planos de exercício--</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>