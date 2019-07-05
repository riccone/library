<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use denar90\waveSurferAudio\WaveSurferAudioWidget;
/* @var $this yii\web\View */
/* @var $model frontend\models\Books */

$this->title = $book->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$key = 'book'.$book->id;
$_SESSION[$key] = 123;
use yii\helpers\Url;
?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title"><?= $book->name?></h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="/">Asosiy</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active"><?= $book->name?></span>
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
                                <img src="<?= $book->getImage()?>" alt="product image">
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="product__info__main">
                                <h1><?= $book->name?></h1>
                                <div class="product__overview">
                                    <p><?= $book->description?></p>
                                    <p><span style="color: darkred;"> Toifa : </span><a href="<?= Url::toRoute(['books/category', 'id' => $book->id])?>"><?= $book->category->name?></a>
                                        <br><span style="color: darkred;"> Muallif : </span><?= $book->author?>
                                        <br><span style="color: darkred;"> Qo`shilgan vaqti : </span><?= $book->date_added?>
                                        <br><span style="color: darkred;"> O`qilgan : </span><?= $book->viewed?>
                                    </p>
                                    <a class="btn btn-success" href="<?= $book->getDoc()?>" role="button">Ko`chirib olish</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-lg-12 col-12">
                        <? if ($book->category_id != 14) {?>
                        <?= \yii2assets\pdfjs\PdfJs::widget([
                            'width'=>'100%',
                            'height'=> '800px',
                            'url'=> Url::base().$book->getDoc()
                        ]); ?>
                        <? } else {?>
                            <audio id="player" controls>
                                <source src='<?=$book->document?>' type="audio/mp3" />
                                <source src='<?=$book->document?>' type="audio/ogg" />
                            </audio>
                        <? }?>
                    </div>
                    </div>
                </div>

                <div class="wn__related__product pt--80 pb--50">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">O`xshash kitoblar</h2>
                    </div>
                    <div class="row mt--60">
                        <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                            <?php foreach ($books as $book1):?>
                                <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product__thumb">
                                        <a class="first__img" href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><img src="<?= $book1->getImage();?>" alt="product image"></a>
                                    </div>
                                    <div class="product__content content--center">
                                        <h4><a href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><?=$book1->name?></a></h4>
                                    </div>
                                </div>
                            <?php endforeach;?>
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
