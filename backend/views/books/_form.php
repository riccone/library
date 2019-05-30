<?php

use backend\models\CategoryBooks;
use backend\models\Tags;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<?
$district = CategoryBooks::find()->where(['!=', 'status', 0])->andWhere(['!=', 'id', 0])->All();
$items3 = ArrayHelper::map($district,'id','name');

$selectedTags = $model->getSelectedTags() ? $model->getSelectedTags() : 0;
$tags = ArrayHelper::map(Tags::find()->all(), 'id','name');

?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'category_id')->widget(Select2::classname(), [
        'data' => $items3,
        'options' => ['placeholder' => 'Выберите категорию'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>

    <?= Html::dropDownList('tags', $selectedTags, $tags, ['class' => 'form-control', 'multiple' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
