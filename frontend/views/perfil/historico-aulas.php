<?php

use yii\helpers\Html;

$this->title = "Histórico de Aulas";
$this->params['user'] = $user;
$this->params['mensalidadeAtual'] = $mensalidadeAtual;
?>
<div class="panel panel-default">
    <div class="panel-body">
        <hr>
        <div>
            <p><label>Histórico de Aulas</label></p>
        </div>
        <hr>
        <div class="media">
            <div class="media-body">
                <div class="box">
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Pack</th>
                                <th>Preço</th>
                                <th style="width: 150px">Data Inscrição</th>
                            </tr>
                            <?php
                            if (!empty($registos)):
                                $count = 1;
                                foreach ($registos as $registo):
                                    if (!empty($registo->inscricaos)):
                                        foreach ($registo->inscricaos as $inscricao):
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= $inscricao->aula->Nome ?></td>
                                                <td><?= $inscricao->aula->Preco . '€' ?></td>
                                                <td><?= date('d-M-Y', $registo->Data) ?></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                endforeach;
                                ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">-- Sem mensalidades antigas--</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>