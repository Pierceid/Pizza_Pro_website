<?php

$layout = 'pizza-pro';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_shop.css">

<div class="carousel-container">
    <div id="carousel-container" class="carousel slide" style="width: 100%; padding: 10px 0; background-color: #111">
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

<div class="pizzas-container row">
    <div class="card" style="justify-content: center; width: 150px; height: 150px; margin: 85px 50px;
    border: 5px solid black; border-radius: 50%; background-color: darkorange">
        <a href="<?= $link->url("shop.add") ?>"><img src="/public/images/icons/plus.png" alt=""></a>
    </div>

    <?php if (count($data) > 0) : ?>
        <?php for ($i = 0; $i < count($data); $i++) { ?>
            <div class="card" style="width: 230px; height: 300px; margin: 10px">
                <?= $id = $data[$i]['id']; ?>

                <img style="max-height: 150px; padding-bottom: 10px" src="<?= $data[$i]['image-path'] ?>" alt="">
                <h4 style="color: red; font-weight: bold; text-decoration: underline"><?= $data[$i]['name'] ?></h4>
                <h6 style="color: black; font-weight: bold">Cost: <?= $data[$i]['cost'] ?> €</h6>
                <div class="action-buttons">
                    <button type="button" class="btn btn-primary" style="border: 2px solid black; font-weight: bold">
                        <a href="<?= $link->url("shop.update", ["update_id" => $id]) ?>" style="text-decoration: none; color: white">Edit</a>
                    </button>
                    <button type="button" class="btn btn-success" style="border: 2px solid black; font-weight: bold">
                        <a href="<?= $link->url("shop.cart", ["add_id" => $id]) ?>" style="text-decoration: none; color: white">Add</a>
                    </button>
                    <button type="button" class="btn btn-dark" style="border: 2px solid black; font-weight: bold">
                        <a href="<?= $link->url("shop.remove", ["remove_id" => $id]) ?>" style="text-decoration: none; color: white">Delete</a>
                    </button>
                </div>
            </div>
        <?php } ?>
    <?php endif ?>
</div>

<script src="/public/js/script_shop.js"></script>
