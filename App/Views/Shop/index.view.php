<?php

$layout = 'shop';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_shop.css">

<div class="carousel-container">
    <div id="carousel-container" class="carousel slide" style="padding: 10px 0; background-color: #111">
        <div class="carousel-inner" style="text-align: center">
            <div class="carousel-item active">
                <img src="/public/images/pizzas/neapolitan-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px">
                <img src="/public/images/pizzas/new-york-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px; margin: 0 10px">
                <img src="/public/images/pizzas/california-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px">
            </div>
            <div class="carousel-item">
                <img src="/public/images/pizzas/greek-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px">
                <img src="/public/images/pizzas/roman-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px; margin: 0 10px">
                <img src="/public/images/pizzas/pepperoni-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px">
            </div>
            <div class="carousel-item">
                <img src="/public/images/pizzas/chicken-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px">
                <img src="/public/images/pizzas/veggie-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px; margin: 0 10px">
                <img src="/public/images/pizzas/supreme-pizza.png" alt=""
                     style="width: 25%; max-width: 250px; max-height: 200px">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-container" data-bs-slide="prev"
                style="justify-content: left; padding-left: 5px">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carousel-container" data-bs-slide="next"
                style="justify-content: right; padding-right: 5px">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

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

<div class="pizzas-container container-fluid row">
    <?php for ($i = 0; $i < count($data); $i++) { ?>
        <div class="card">
            <img style="max-height: 160px; padding-bottom: 10px" src="<?= $data[$i]['image-path'] ?>" alt="">
            <h3 style="color: red; font-weight: bold; text-decoration: underline"><?= $data[$i]['name'] ?></h3>
            <h5 style="color: black; font-weight: bold">Cost: <?= $data[$i]['cost'] ?> €</h5>
        </div>
    <?php } ?>
</div>

<script src="/public/js/script_shop.js"></script>