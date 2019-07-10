<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use denar90\waveSurferAudio\WaveSurferAudioWidget;
/* @var $this yii\web\View */
/* @var $model frontend\models\Books */

$this->title = $model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$key = 'book'.$model->id;
$_SESSION[$key] = 123;
use yii\helpers\Url;
?>
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title"><?= $model->firstname.' '.$model->lastname; ?></h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="/">Asosiy</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active"><?= $model->firstname.' '.$model->lastname; ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start main Content -->
<div class="maincontent bg--white pt--80 pb--55">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="wn__single__product">
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <div class="product__thumb">
                                <img src="<?= $model->getImage()?>" alt="product image">
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="product__info__main">
                                <h1><?= $model->firstname.' '.$model->lastname; ?></h1>
                                <div class="product__overview">
                                    <p><?= $model->bio?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End main Content -->
<!-- Start Search Popup -->
<div class="box-search-content search_active block-bg close__top">
    <form id="search_mini_form--2" class="minisearch" action="#">
        <div class="field__search">
            <input type="text" placeholder="Search entire store here...">
            <div class="action">
                <a href="#"><i class="zmdi zmdi-search"></i></a>
            </div>
        </div>
    </form>
    <div class="close__wrap">
        <span>close</span>
    </div>
</div>

