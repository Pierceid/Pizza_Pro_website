<?php
$layout = 'shop';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_message.css">

<div id="carousel-container" class="carousel slide">
    <div class="carousel-inner" style="width: 100%; margin: 10px">
        <div class="carousel-item active">
            <img class="carousel-img" src="/public/images/pizzas/neapolitan_pizza.png" alt="">
        </div>
        <div class="carousel-item">
            <img class="carousel-img" src="/public/images/pizzas/newyork_pizza.png" alt="">
        </div>
        <div class="carousel-item">
            <img class="carousel-img" src="/public/images/pizzas/california_pizza.png" alt="">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-container" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carousel-container" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<a href="#"><img class="banner" src="/public/images/others/banner.png" alt=""></a>

<div class="action-buttons">
    <div class="btn btn-secondary" style="background-color: purple">
        <a href="<?= $link->url("shop.add") ?>">Add</a>
    </div>
    <div class="btn btn-secondary" style="background-color: purple">
        <a href="<?= $link->url("shop.update") ?>">Update</a>
    </div>
    <div class="btn btn-secondary" style="background-color: purple">
        <a href="<?= $link->url("shop.remove") ?>">Remove</a>
    </div>
</div>

<script src="/public/js/script_shop.js"></script>