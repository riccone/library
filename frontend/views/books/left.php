<?php

use backend\models\Authors;
use frontend\models\CategoryBooks;
use frontend\models\Tags;
use yii\helpers\Url;

$authors = Authors::find()->orderBy('RAND()')->limit(5)->all();
$categories = CategoryBooks::getAll();
$tags = Tags::getTen();
?>

<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
    <div class="shop__sidebar">
        <aside class="wedget__categories poroduct--cat">
            <h3 class="wedget__title">Kitob toifalari</h3>
            <ul>
                <?php foreach ($categories as $cat): ?>
                    <li><a href="<?= Url::toRoute(['books/category', 'id' => $cat->id]) ?>"><?= $cat->name ?>
                            <span>(<?= $cat->getBooksCountity(); ?>)</span></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <aside class="wedget__categories poroduct--cat">
            <h3 class="wedget__title">Shoir va yozuvchilar</h3>
            <ul>
                <?php foreach ($authors as $author): ?>
                    <li><a href="<?= Url::toRoute(['authors/view', 'id' => $author->id]) ?>"><?= $author->firstname.' '.$author->lastname; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <aside class="wedget__categories poroduct--tag">
            <h3 class="wedget__title">Heshteglar</h3>
            <ul>
                <?php foreach ($tags as $tag): ?>
                    <li><a href="<?= Url::toRoute(['books/tags', 'id' => $tag->id]) ?>"><?= $tag->name ?></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>
    </div>
</div>