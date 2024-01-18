<?php

$layout = 'primary';
/**
 * @var \App\Core\LinkGenerator $link
 * @var Array $data
 */
?>

<link rel="stylesheet" href="/public/css/styl_buttons.css">
<link rel="stylesheet" href="/public/css/styl_shop.css">

<div class="carousel-container">
    <div id="carousel-container" class="carousel slide">
        <div class="carousel-inner">
            <?php
            $pizzas = $data['pizzas'];
            shuffle($pizzas);
            $pizzaSets = array_chunk($pizzas, 4);

            foreach ($pizzaSets as $setIndex => $pizzaSet): ?>
                <div class="carousel-item<?php echo $setIndex === 0 ? ' active' : ''; ?>">
                    <?php foreach ($pizzaSet as $pizza): ?>
                        <img src="<?= $pizza['image-path'] ?>" alt="">
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
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
    <?php if ($data['isAdmin'] > 0) : ?>
        <div class="card add-card" style="background-color: darkorange">
            <a href="<?= $link->url("shop.crudManagement", ["operation" => "insert"]) ?>"><img src="/public/images/icons/plus.png" alt=""></a>
        </div>
    <?php endif ?>

    <?php if (!empty($pizzas)) : ?>
        <?php foreach ($pizzas as $pizza): ?>
            <div class="card">
                <?php
                $id = $pizza['id'];
                $name = $pizza['name'];
                $description = $pizza['description'];
                $cost = $pizza['cost'];
                $imagePath = $pizza['image-path'];
                ?>

                <img src="<?= $imagePath ?>" alt="">
                <h5><?= $name ?></h5>
                <h6>Cost: <?= $cost ?> €</h6>

                <div class="action-buttons">
                    <?php if ($data['isAdmin']): ?>
                        <button type="button" class="btn btn-primary">
                            <a href="<?= $link->url("shop.crudManagement", ["operation" => "update", "id" => $id, "name" => $name, "description" => $description, "cost" => $cost]) ?>"
                            >o</a>
                        </button>
                    <?php endif; ?>

                    <button type="button" class="btn btn-success">
                        <a href="<?= $link->url("shop.cartManagement", ["operation" => "add", "id" => $id, "name" => $name, "cost" => $cost]) ?>">ADD</a>
                    </button>

                    <?php if ($data['isAdmin']): ?>
                        <button type="button" class="btn btn-danger">
                            <a href="<?= $link->url("shop.crudManagement", ["operation" => "delete", "id" => $id, "name" => $name]) ?>">x</a>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif ?>
</div>

<script src="/public/js/script_shop.js"></script>
