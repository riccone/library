<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoryBooks */

$this->title = 'Create Category Books';
$this->params['breadcrumbs'][] = ['label' => 'Category Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-books-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
