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
                        <p><b>Refeições</b></p>
                    </td>
                    <td>
                        <p><b>Alimentos</b></p>
                    </td>
                    <td>
                        <p><b>Proteína</b></p>
                    </td>
                    <td>
                        <p><b>Lípidos</b></p>
                    </td>
                    <td>
                        <p><b>CarboHidratos</b></p>
                    </td>
                    <td>
                        <p><b>Calorias</b></p>
                    </td>
                </tr>
            </thead>
            <?php foreach ($refeicoes as $key => $refeicao): //$key dia da semana ?>
                <?php
                $writeName = false;
                $countInside = 0;
                $totalExercicios = 0;
                foreach ($refeicao as $total) {
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
                    <?php
                    $proteinasTotal = 0;
                    $lipidosTotal = 0;
                    $carboHidratosTotal = 0;
                    $caloriasTotal = 0;
                    ?>
                    <?php foreach ($refeicao as $keyy => $refeicaoEspecifica): ?>
                        <?php
                        $proteinas = 0;
                        $lipidos = 0;
                        $carboHidratos = 0;
                        $calorias = 0;
                        $totalAlimentoEspecifico = count($refeicaoEspecifica);
                        ?>
                        <?php foreach ($refeicaoEspecifica as $value): ?>
                            <?php
                            if (isset($alimentoAntigo)) {
                                if ($alimentoAntigo != $keyy) {
                                    $writeName = true;
                                }
                            }
                            $alimentoAntigo = $keyy;
                            ?>
                            <?php if ($countInside == 0): ?>
                                <td rowspan="<?= $totalAlimentoEspecifico ?>">
                                    <p><b><?= $keyy ?>:00h</b></p>
                                </td>
                                <td>
                                    <?php $virgula = 0; ?>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php if ($virgula < count($value->alimentoHasAlimetoPlanoRefeicaos) - 1): ?>
                                            <span class="exercicio-nome"><?= $alimentos->Peso . 'g ' . $alimentos->alimento->Nome ?>,</span>
                                        <?php else: ?>
                                            <span class="exercicio-nome"><?= $alimentos->Peso . 'g ' . $alimentos->alimento->Nome ?></span>
                                        <?php endif; ?>
                                        <?php
                                        $virgula++;
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $proteinas += number_format(($alimentos->Peso * $alimentos->alimento->Proteinas) / 100, 2) ?>
                                        <?php $proteinasTotal += number_format(($alimentos->Peso * $alimentos->alimento->Proteinas) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $proteinas . 'g' ?>
                                </td>
                                <td>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $lipidos += number_format(($alimentos->Peso * $alimentos->alimento->Lipidos) / 100, 2) ?>
                                        <?php $lipidosTotal += number_format(($alimentos->Peso * $alimentos->alimento->Lipidos) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $lipidos . 'g' ?>
                                </td>
                                <td>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $carboHidratos += number_format(($alimentos->Peso * $alimentos->alimento->CarboHidratos) / 100, 2) ?>
                                        <?php $carboHidratosTotal += number_format(($alimentos->Peso * $alimentos->alimento->CarboHidratos) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $carboHidratos . 'g' ?>
                                </td>
                                <td>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $calorias += number_format(($alimentos->Peso * $alimentos->alimento->Calorias) / 100, 2) ?>
                                        <?php $caloriasTotal += number_format(($alimentos->Peso * $alimentos->alimento->Calorias) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $calorias ?>
                                </td>
                            </tr>
                            <?php $countInside++; ?>
                        <?php else: ?>
                            <tr>
                                <?php if ($writeName): ?>
                                    <td><b><?= $keyy ?>:00h</b></td>
                                <?php endif; ?>
                                <td>
                                    <?php $virgula = 0; ?>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php if ($virgula < count($value->alimentoHasAlimetoPlanoRefeicaos) - 1): ?>
                                            <span class="exercicio-nome"><?= $alimentos->Peso . 'g ' . $alimentos->alimento->Nome ?>,</span>
                                        <?php else: ?>
                                            <span class="exercicio-nome"><?= $alimentos->Peso . 'g ' . $alimentos->alimento->Nome ?></span>
                                        <?php endif; ?>
                                        <?php
                                        $virgula++;
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $proteinas += number_format(($alimentos->Peso * $alimentos->alimento->Proteinas) / 100, 2) ?>
                                        <?php $proteinasTotal += number_format(($alimentos->Peso * $alimentos->alimento->Proteinas) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $proteinas . 'g' ?>
                                </td>
                                <td>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $lipidos += number_format(($alimentos->Peso * $alimentos->alimento->Lipidos) / 100, 2) ?>
                                        <?php $lipidosTotal += number_format(($alimentos->Peso * $alimentos->alimento->Lipidos) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $lipidos . 'g' ?>
                                </td>
                                <td>
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $carboHidratos += number_format(($alimentos->Peso * $alimentos->alimento->CarboHidratos) / 100, 2) ?>
                                        <?php $carboHidratosTotal += number_format(($alimentos->Peso * $alimentos->alimento->CarboHidratos) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $carboHidratos . 'g' ?>
                                </td>
                                <td >
                                    <?php foreach ($value->alimentoHasAlimetoPlanoRefeicaos as $alimentos): ?>
                                        <?php $calorias += number_format(($alimentos->Peso * $alimentos->alimento->Calorias) / 100, 2) ?>
                                        <?php $caloriasTotal += number_format(($alimentos->Peso * $alimentos->alimento->Calorias) / 100, 2) ?>
                                        <?php
                                    endforeach;
                                    ?>
                                    <?= $calorias ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="color-bg-clean" style="text-align: right;"><b>Total</b></td>
                    <td><?= $proteinasTotal ?>g</td>
                    <td><?= $lipidosTotal ?>g</td>
                    <td><?= $carboHidratosTotal ?>g</td>
                    <td><?= $caloriasTotal ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>