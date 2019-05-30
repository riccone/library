<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Maqol */

$this->title = 'Create Maqol';
$this->params['breadcrumbs'][] = ['label' => 'Maqols', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maqol-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
