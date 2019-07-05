<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\models\Books;
use frontend\models\BooksSearch;
use frontend\models\CategoryBooks;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\ActiveForm;use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
$categories = CategoryBooks::getAll();
$modelsearch = new BooksSearch();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Moliya vazirligi kutubxonasi</title>
    <!--    --><?//= Html::encode($this->title) ?>

    <!-- Favicons -->
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">


    <script src="js/vendor/modernizr-3.5.0.min.js"></script>


    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Main wrapper -->
<div class="wrapper" id="wrapper">

    <!-- Header -->
    <header id="wn__header" class="oth-page header__area header__absolute sticky__header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-7 col-lg-2">
                    <div class="logo">
                        <a href="/">
                            <img src="/images/logo/logo-head2.png" alt="logo images">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <nav class="mainmenu__nav">
                        <ul class="meninmenu d-flex justify-content-start">
                            <li class="drop with--one--item"><a href="/">Asosiy sahifa</a></li>
                            <li class="drop"><a href="">Kitoblar</a>
                                <div class="megamenu mega03">
                                    <ul class="item item03">
                                        <li class="title">Toifalar</li>
                                        <?php foreach ($categories as $cat):?>
                                            <li><a href="<?= Url::toRoute(['books/category', 'id' => $cat->id])?>"><?= $cat->name?></a></li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="\site\about">Bog`lanish</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-8 col-sm-8 col-5 col-lg-2">
                    <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
                        <li class="shop_search"><a class="search__active" href="#"></a></li>
                    </ul>
                </div>
            </div>
            <!-- Start Mobile Menu -->
            <div class="row d-none">
                <div class="col-lg-12 d-none">
                    <nav class="mobilemenu__nav">
                        <ul class="meninmenu">
                            <li><a href="/">Asosiy sahifa</a></li>
                            <li><a href="\site\about">Bog`lanish</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End Mobile Menu -->
            <div class="mobile-menu d-block d-lg-none">
            </div>
            <!-- Mobile Menu -->
        </div>
    </header>
    <!-- //Header -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <!--        --><?php //$form = ActiveForm::begin() ?>
        <form id="search_mini_form" class="minisearch" action="#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <!--                --><?//= $form->field($modelsearch, 'name')->textInput()->label('') ?>
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <!--        --><?php //$form = ActiveForm::end() ?>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>
    <!-- End Search Popup -->


    <?= $content ?>

    <!-- Footer Area -->
    <footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
        <div class="footer-static-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer__widget footer__menu">
                            <div class="ft__logo">
                                <a href="/">
                                    <img src="/images/logo/logo-foot.png" alt="logo">
                                </a>
                                <p>Saytdan olingan ma'lumotlardan foydalanilganda O'zbekiston Respublikasi Moliya vazirligining rasmiy veb sayti www.mf.uz ko‘rsatilishi shart. Saytni ishlab chiqish va qo'llab-quvvatlash Moliya vazirligi AHM tomonidan amalga oshiriladi</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="copyright">
                            <div class="copy__right__inner text-left">
                                <p>Copyright <i class="fa fa-copyright"></i> <a href="https://www.mf.uz/">2019 O'zbekiston Respublikasi Moliya vazirligi. Barcha huquqlar himoyalangan. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
