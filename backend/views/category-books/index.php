<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryBooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категория Книг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-books-index panel panel-info" style="padding:10px;">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'parent_id',
            
			'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
