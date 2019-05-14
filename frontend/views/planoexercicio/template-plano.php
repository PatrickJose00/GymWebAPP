<?php

use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    </head>
    <body>
        <table class="content">
            <thead>
                <tr>
                    <td>
                        <p><b>Dia</b></p>
                    </td>
                    <td>
                        <p><b>Músculo</b></p>
                    </td>
                    <td>
                        <p><b>Exercício</b></p>
                    </td>
                    <td>
                        <p><b>Séries</b></p>
                    </td>
                    <td>
                        <p><b>Carga</b></p>
                    </td>
                    <td>
                        <p><b>Repetição</b></p>
                    </td>
                    <td>
                        <p><b>Pausa</b></p>
                    </td>
                </tr>
            </thead>
            <?php foreach ($musculos as $key => $musculo): ?>
                <?php
                $writeName = false;
                $countInside = 0;
                $totalExercicios = 0;
                foreach ($musculo as $total) {
                    $totalExercicios += count($total);
                }
                ?>
                <tr>
                    <?php
                    switch ($key):
                        case "1":
                            $key = "Segunda";
                            break;
                        case "2":
                            $key = "Terça";
                            break;
                        case "3":
                            $key = "Quarta";
                            break;
                        case "4":
                            $key = "Quinta";
                            break;
                        case "5":
                            $key = "Sexta";
                            break;
                        case "6":
                            $key = "Sábado";
                            break;
                        case "7":
                            $key = "Domingo";
                            break;
                    endswitch;
                    ?>
                    <td text-rotate="90" rowspan="<?= $totalExercicios ?>" class="color-bg">
                        <p><b><?= $key ?></b></p>
                    </td>
                    <?php foreach ($musculo as $keyy => $musculoEspecifico): ?>
                        <?php
                        $totalExcercicioEspecifico = count($musculoEspecifico);
                        ?>
                        <?php foreach ($musculoEspecifico as $value): ?>
                            <?php
                            if (isset($musculoAntigo)) {
                                if ($musculoAntigo != $keyy) {
                                    $writeName = true;
                                }
                            }
                            $musculoAntigo = $keyy;
                            ?>
                            <?php if ($countInside == 0): ?>
                                <td rowspan="<?= $totalExcercicioEspecifico ?>">
                                    <p><b><?= $keyy ?></b></p>
                                </td>
                                <td>
                                    <span><?= Html::img(Yii::getAlias('@web') . '/exercicios/' . $value->exercicios->Foto, ['class' => 'img-exercicios']) ?></span>
                                    <span class="exercicio-nome"><?= $value->exercicios->Nome ?></span>
                                </td>
                                <td><?= $value->Series . 'x' ?></td>
                                <td><?= $value->Carga . 'kg' ?></td>
                                <td><?= $value->Repeticoes . 'x' ?></td>
                                <td><?= $value->Pausa . ' Seg' ?></td>
                            </tr>
                            <?php $countInside++; ?>
                        <?php else: ?>
                            <tr>
                                <?php if ($writeName): ?>
                                    <td><b><?= $keyy ?></b></td>
                                <?php endif; ?>
                                <td>
                                    <span><?= Html::img(Yii::getAlias('@web') . '/exercicios/' . $value->exercicios->Foto, ['class' => 'img-exercicios']) ?></span>
                                    <p class="exercicio-nome"><?= $value->exercicios->Nome ?></p>
                                </td>
                                <td><?= $value->Series . 'x' ?></td>
                                <td><?= $value->Carga . 'kg' ?></td>
                                <td><?= $value->Repeticoes . 'x' ?></td>
                                <td><?= $value->Pausa . ' Seg' ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    </body>
</html>