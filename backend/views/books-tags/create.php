<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BooksTags */

$this->title = 'Create Books Tags';
$this->params['breadcrumbs'][] = ['label' => 'Books Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
