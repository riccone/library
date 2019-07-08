<?php use yii\widgets\LinkPager;
use yii\helpers\Url;?>
<!-- Start Slider area -->
<div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
    <!-- Start Single Slide -->
    <div class="slide animation__style07 bg-image--1 fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <!--                            <h2>Kitobsiz <span>aql - </span>qanotsiz <span>qush </span></h2>-->
                            <h2><?=$maqollar[0]->name?></h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
    <!-- Start Single Slide -->
    <div class="slide animation__style06 bg-image--7 fullscreen align__center--left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider__content">
                        <div class="contentbox">
                            <!--                            <h2>Kitoblar <span>jonsiz,</span>  ammo sodiq <span>do'stlardir.</span></h2>-->
                            <h2><span><?=$maqollar[1]->name?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
</div>
<!-- Start Shop Page -->
<div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
    <div class="container">
        <div class="row">
            <?php include 'left.php';?>
            <div class="col-lg-9 col-12 order-1 order-lg-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                            <div class="shop__list nav justify-content-center" role="tablist">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
                            </div>
                            <?php $countity = sizeof($books); ?>
                            <p><?=$countity?> ta natijadan,  1 dan – <?=$countity <= 12 ? $countity : 12?> gacha ko`rsatilmoqda </p>

                        </div>
                    </div>
                    <div class="tab__container">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">

                                <?php foreach ($books as $book1):?>

                                    <!-- Start Single Product -->
                                    <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
                                        <div class="product__thumb">
                                            <a class="first__img" href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><img src="<?= $book1->getImage();?>" alt="product image"></a>
                                            <a class="second__img animation1" href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><img src="<?= $book1->getImage();?>" alt="product image"></a>
                                        </div>
                                        <div class="product__content content--center">
                                            <h4><a href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><?= $book1->name?></a></h4>
                                            <br><br>

                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li><a class="cart" title="O`qish" href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><i class="bi bi-article"></i></a></li>
                                                        <li><a class="cart" title="Ko`chirib olish" href="<?= $book1->getDoc();?>"><i class="fa fa-download"></i></a></li>
                                                        <!--                                                    <li><a data-toggle="modal" title="Kitob haqida" class="quickview modal-view detail-link" href="#productmodal"><i class="fa fa-info"></i></a></li>-->
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End Single Product -->
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                            <div class="list__view__wrapper">
                                <?php foreach ($books as $book1):?>
                                    <!-- Start Single Product -->
                                    <div class="list__view">
                                        <div class="thumb">
                                            <a class="first__img" href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><img src="<?= $book1->getImage();?>" alt="product images"></a>
                                        </div>
                                        <div class="content">
                                            <h2><a href="<?= Url::toRoute(['books/view', 'id' => $book1->id])?>"><?= $book1->name?></a></h2>
                                            <p><span style="color: darkred;"> Toifa : </span><?= $book1->category->name?>
                                                <br><span style="color: darkred;"> Muallif : </span><?= $book1->author?>
                                                <br><span style="color: darkred;"> Qo`shilgan vaqti : </span><?= $book1->date_added?>
                                                <br><span style="color: darkred;"> O`qilgan : </span><?= $book1->viewed?>
                                            </p>
                                            <p><?= $book1->description?></p>
                                        </div>
                                    </div>
                                    <!-- End Single Product -->
                                <?php endforeach;?>
                            </div>
                        </div>
                        <?php
                        // display pagination
                        try {
                            echo LinkPager::widget([
                                'pagination' => $pages,
                            ]);
                        } catch (Exception $e) {
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <h3 class='wedget__title'>Eng ko`p o`qilgan</h3>
        <div class="tab__container">
            <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                <div class="row">

                    <?php foreach ($best as $best1): ?>

                        <!-- Start Single Product -->
                        <div class="product product__style--3 col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="product__thumb">
                                <a class="first__img"
                                   href="<?= Url::toRoute(['books/view', 'id' => $best1->id]) ?>"><img
                                            src="<?= $best1->getImage(); ?>" alt="product image"></a>
                                <a class="second__img animation1"
                                   href="<?= Url::toRoute(['books/view', 'id' => $best1->id]) ?>"><img
                                            src="<?= $best1->getImage(); ?>" alt="product image"></a>
                            </div>
                            <div class="product__content content--center">
                                <h4>
                                    <a href="<?= Url::toRoute(['books/view', 'id' => $best1->id]) ?>"><?= $best1->name ?></a>
                                </h4>
                                <br><br>

                                <div class="action">
                                    <div class="actions_inner">
                                        <ul class="add_to_links">
                                            <li><a class="cart" title="O`qish"
                                                   href="<?= Url::toRoute(['books/view', 'id' => $best1->id]) ?>"><i
                                                            class="bi bi-article"></i></a></li>
                                            <li><a class="cart" title="Ko`chirib olish"
                                                   href="<?= $best1->getDoc(); ?>"><i
                                                            class="fa fa-download"></i></a></li>
                                            <!--                                                    <li><a data-toggle="modal" title="Kitob haqida" class="quickview modal-view detail-link" href="#productmodal"><i class="fa fa-info"></i></a></li>-->
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- End Single Product -->
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                <div class="list__view__wrapper">
                    <?php foreach ($best as $best1): ?>
                        <!-- Start Single Product -->
                        <div class="list__view">
                            <div class="thumb">
                                <a class="first__img"
                                   href="<?= Url::toRoute(['books/view', 'id' => $best1->id]) ?>"><img
                                            src="<?= $best1->getImage(); ?>" alt="product images"></a>
                            </div>
                            <div class="content">
                                <h2>
                                    <a href="<?= Url::toRoute(['books/view', 'id' => $best1->id]) ?>"><?= $best1->name ?></a>
                                </h2>
                                <p>
                                    <span style="color: darkred;"> Toifa : </span><?= $best1->category->name ?>
                                    <br><span
                                            style="color: darkred;"> Muallif : </span><?= $best1->author ?>
                                    <br><span
                                            style="color: darkred;"> Qo`shilgan vaqti : </span><?= $best1->date_added ?>
                                    <br><span
                                            style="color: darkred;"> O`qilgan : </span><?= $best1->viewed ?>
                                </p>
                                <p><?= $best1->description ?></p>
                            </div>
                        </div>
                        <!-- End Single Product -->
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header modal__header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="big images" src="/images/product/big-img/1.jpg">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1>Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span class="new-price">$17.20</span>
                                        <span class="old-price">$45.00</span>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                                </div>
                                <div class="select__color">
                                    <h2>Select color</h2>
                                    <ul class="color__list">
                                        <li class="red"><a title="Red" href="#">Red</a></li>
                                        <li class="gold"><a title="Gold" href="#">Gold</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                        <li class="orange"><a title="Orange" href="#">Orange</a></li>
                                    </ul>
                                </div>
                                <div class="select__size">
                                    <h2>Select size</h2>
                                    <ul class="color__list">
                                        <li class="l__size"><a title="L" href="#">L</a></li>
                                        <li class="m__size"><a title="M" href="#">M</a></li>
                                        <li class="s__size"><a title="S" href="#">S</a></li>
                                        <li class="xl__size"><a title="XL" href="#">XL</a></li>
                                        <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
                                    </ul>
                                </div>
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social__net social__net--2 d-flex justify-content-start">
                                            <li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                            <li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            <li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            <li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="addtocart-btn">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
