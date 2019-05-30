<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Teg', ['set-tags', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php if ($model->status != 1){?>
        <?= Html::a('Опубликовать', ['publish', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php }?>
        <?php if ($model->status == 1){?>
        <?= Html::a('Не опубликовать', ['unpublish', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        <?php }?>
        <?= Html::a('Загрузить изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Загрузить документ', ['set-document', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'image',
            'document',
            'year',
            'author',
            'viewed',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->status ? '<span class="text-success">Опубликовано</span>' : '<span class="text-danger">Не опубликовано</span>';
                }
            ],
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => $model->category->name,
            ],
            'date_added',
        ],
    ]) ?>

</div>
