<?php
/* @var $this yii\web\View */

use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\controllers\SiteController;

$this->title = 'Painel Administrativo';
?>
<section class="content-header">
    
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= Yii::t('app', 'Página Inicial'); ?></a></li>
    </ol>
</section>
<section class="content">
    
    <div class="row">
        <div class="col-md-12">
            <img src="<?= Yii::getAlias('@web') . '/images/logo_agon_gym.png' ?>" class="img-responsive center-block" style="margin-top: 5%;" />
        </div>
    </div>
</section>