<?php

use backend\models\Books;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
//var_dump($model = Books::findOne($dataProvider->id));
?>
<div class="books-index panel panel-info" style="padding:10px;">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Создать книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->status ? '<span class="text-success">Опубликовано</span>' : '<span class="text-danger">Не опубликовано</span>';
                }
            ],
            'name',
            //'description:ntext',
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function($data){
                    return Html::img($data->getImage(), ['width' => 50]);
                }

            ],
            'document',
            //'year',
            //'author',
            //'viewed',
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function($data){
                    return $data->category->name;
                }
            ],
            //'category_id',
            //'date_added',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
