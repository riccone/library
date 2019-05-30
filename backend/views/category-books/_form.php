<?php

use backend\models\CategoryBooks;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoryBooks */
/* @var $form yii\widgets\ActiveForm */

$district = CategoryBooks::find()->where(['!=', 'status', 0])->All();
$items3 = ArrayHelper::map($district,'id','name');
?>

<div class="category-books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => $items3,
        'options' => ['placeholder' => 'Выберите родительскую категорию'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>

    <?= $form->field($model, 'status')->dropDownList([
        '1' => 'Опубликовано',
        '0' => 'Не опубликовано',
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
