<?php

use frontend\models\CategoryBooks;
use frontend\models\Tags;
use yii\helpers\Url;

$categories = CategoryBooks::getAll();
$tags = Tags::getTen();
?>

<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
    <div class="shop__sidebar">
        <aside class="wedget__categories poroduct--cat">
            <h3 class="wedget__title">Kitob toifalari</h3>
            <ul>
                <?php foreach ($categories as $cat):?>
                    <li><a href="<?= Url::toRoute(['books/category', 'id' => $cat->id])?>"><?= $cat->name?> <span>(<?= $cat->getBooksCountity();?>)</span></a></li>
                <?php endforeach;?>
            </ul>
        </aside>
        <aside class="wedget__categories poroduct--tag">
            <h3 class="wedget__title">Heshteglar</h3>
            <ul>
                <?php foreach ($tags as $tag):?>
                    <li><a href="<?= Url::toRoute(['books/tags', 'id' => $tag->id])?>"><?= $tag->name?></a></li>
                <?php endforeach;?>
            </ul>
        </aside>
        <aside class="wedget__categories sidebar--banner">
            <h3 class="wedget__title">Eng ko`p o`qilgan</h3>
            <?php foreach ($best as $best1):?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div style="padding: 15px">
                        <a class="first__img" href="<?= Url::toRoute(['books/view', 'id' => $best1->id])?>"><img src="<?= $best1->getImage();?>" alt="product image"></a>
                    </div>
                </div>
            <?php endforeach;?>
        </aside>
    </div>
</div>