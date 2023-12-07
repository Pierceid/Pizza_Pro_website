<?php
$layout = 'eshop';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_CRUD.css">

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

<div class="container-fluid pizzas-container row">
    <div class="card col-md-4">
        <a href="#"><img src="/public/images/pizzas/neapolitan_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Neapolitan pizza</p>
            <p class="cost">Cost: 10,50 €</p>
            <div class="counter">
                <img src="/public/images/icons/plus.png" alt="">
                <span class="count">0</span>
                <img src="/public/images/icons/minus.png" alt="">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/public/images/pizzas/newyork_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">New York pizza</p>
            <p class="cost">Cost: 9,20 €</p>
            <div class="counter">
                <img src="/public/images/icons/plus.png" alt="">
                <span class="count">0</span>
                <img src="/public/images/icons/minus.png" alt="">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/public/images/pizzas/california_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">California pizza</p>
            <p class="cost">Cost: 9,50 €</p>
            <div class="counter">
                <img src="/public/images/icons/plus.png" alt="">
                <span class="count">0</span>
                <img src="/public/images/icons/minus.png" alt="">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/public/images/pizzas/greek_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Greek pizza</p>
            <p class="cost">Cost: 10,00 €</p>
            <div class="counter">
                <img src="/public/images/icons/plus.png" alt="">
                <span class="count">0</span>
                <img src="/public/images/icons/minus.png" alt="">
            </div>
        </div>
    </div>

    <div class="card col-md-4">
        <a href="#"><img src="/public/images/pizzas/roman_pizza.png" alt=""></a>

        <div class="content">
            <p class="name">Roman pizza</p>
            <p class="cost">Cost: 10,20 €</p>
            <div class="counter">
                <img src="/public/images/icons/plus.png" alt="">
                <span class="count">0</span>
                <img src="/public/images/icons/minus.png" alt="">
            </div>
        </div>
    </div>
</div>

<script src="/public/js/script_shop.js"></script>